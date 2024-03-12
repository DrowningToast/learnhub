<div class="font-noto-thai">
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" id="toast-error"
        class="font-noto-thai z-[999] top-5 left-1/2 transform -translate-x-1/2 fixed w-fit shadow-xl flex-row items-center justify-center bg-white drop-shadow-xl px-12 py-3 rounded-xl hidden">
        <div class=" font-semibold text-sm flex flex-row items-center gap-4 rounded-full">
            <img src="{{ asset('images/icons/error.png') }}" alt="" class="w-8 h-8">
            กรุณาเลือกคำตอบ
            <div onclick="handleClose()" class="font-semibold text-[#555] cursor-pointer">x</div>
        </div>
    </div>

    <div
        class="{{ app('request')->input('doquiz') == 'true' ? 'flex' : 'hidden' }} h-screen w-full bg-black/50 top-0 left-0 z-50 fixed justify-center items-center">
        <div class="w-1/2 bg-white rounded-xl relative p-10">
            <a href="{{ url()->current() }}" class="absolute top-2 right-3 test-xl font-bold">X</a>
            <div class="flex flex-col gap-y-2 w-full    ">
                <p class="text-[#A3ACB6]">คำถามข้อที่ {{ app('request')->input('no') }}</p>
                <p class="text-xl font-medium">{{ $question }}</p>
                <p class="text-[#A3ACB6]">ตัวเลือก</p>
                <div class="flex flex-col gap-y-2 w-full">
                    <div class="w-full">
                        <input type="radio" name="choice" value="A" id="a" class="hidden peer" />
                        <label for="a"
                            class="rounded-xl px-5 py-3 peer-checked:bg-gradient-to-r peer-checked:from-[#2A638A] peer-checked:to-[#0B1A24] peer-checked:text-white text-xl w-full flex gap-x-3"><span
                                class="font-bold">ก.</span>{{ $choiceA }}</label>
                    </div>
                    <div class="w-full">
                        <input type="radio" name="choice" value="B" id="b" class="hidden peer" />
                        <label for="b"
                            class="rounded-xl px-5 py-3 peer-checked:bg-gradient-to-r peer-checked:from-[#2A638A] peer-checked:to-[#0B1A24] peer-checked:text-white text-xl w-full flex gap-x-3"><span
                                class="font-bold">ข.</span>{{ $choiceB }}</label>
                    </div>
                    <div class="w-full">
                        <input type="radio" name="choice" value="C" id="c" class="hidden peer" />
                        <label for="c"
                            class="rounded-xl px-5 py-3 peer-checked:bg-gradient-to-r peer-checked:from-[#2A638A] peer-checked:to-[#0B1A24] peer-checked:text-white text-xl w-full flex gap-x-3"><span
                                class="font-bold">ค.</span>{{ $choiceC }}</label>
                    </div>
                </div>
                {{-- <div>
                    <p>กรุณาเลือกคำตอบ </p>
                </div> --}}
                <div class="flex justify-center gap-x-3 w-full font-noto-thai mt-3">
                    @if (app('request')->input('no') == 1)
                        <a href="{{ url()->current() }}" onclick="localStorage.removeItem('answers')"
                            class="rounded-full text-[#2A638A] bg-[#E9F2FC] px-14 py-3">ยกเลิก</a>
                    @else
                        <a href="{{ url()->current() }}/?doquiz=true&no={{ (int) app('request')->input('no') - 1 }}"
                            class="rounded-full text-[#2A638A] bg-[#E9F2FC] px-14 py-3">ก่อนหน้า</a>
                    @endif

                    @if (app('request')->input('no') == 3)
                        <button onclick="submitQuiz()"
                            class="rounded-full bg-[#2A638A] text-white px-14 py-3">ส่งคำตอบ</button>
                    @else
                        <button onclick="nextQuestion({{ (int) app('request')->input('no') }})"
                            class="rounded-full bg-[#2A638A] text-white px-14 py-3">ถัดไป</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <form method="POST" id="form-quiz">
        @csrf
    </form>
</div>

<script>
    const ans = JSON.parse(localStorage.getItem('answers'))
    if (ans) {
        if (ans[{{ (int) app('request')->input('no') - 1 }}]) {
            const choice = ans[{{ (int) app('request')->input('no') - 1 }}]
            document.querySelector(`input[value="${choice}"]`).checked = true
        }
    }

    const nextQuestion = (qid) => {
        if (!document.querySelector('input[name="choice"]:checked')) {
            document.getElementById('toast-error').style.display = 'flex';
            return;
        }
        if (!localStorage.getItem('answers')) {
            localStorage.setItem('answers', JSON.stringify(new Array(3).fill('')));
        }
        const answers = JSON.parse(localStorage.getItem('answers'));

        answers[qid - 1] = document.querySelector('input[name="choice"]:checked').value;
        localStorage.setItem('answers', JSON.stringify(answers));

        window.location.href = "{{ url()->current() }}/?doquiz=true&no=" + (qid + 1);
    }

    const submitQuiz = () => {
        if (!document.querySelector('input[name="choice"]:checked')) {
            document.getElementById('toast-error').style.display = 'flex';
            return;
        }
        const answers = JSON.parse(localStorage.getItem('answers'));
        answers[2] = document.querySelector('input[name="choice"]:checked').value;

        const form = document.getElementById('form-quiz');
        form.action = '/learn/{{ $courseid }}/quiz/{{ $chapterid }}';

        answers.forEach((answer, i) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `q${i+1}`;
            input.value = answer;
            form.appendChild(input);
        });

        document.body.appendChild(form);

        // console.log(form)
        form.submit();
    }

    // const handleClose = () => {
    //     document.querySelector('.fixed').style.display = 'none';
    // }
</script>
