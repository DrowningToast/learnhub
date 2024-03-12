<div class="font-noto-thai">
    <div
        class="{{ app('request')->input('score') ? 'flex' : 'hidden' }} h-screen w-full bg-black/50 top-0 left-0 z-50 fixed justify-center items-center">
        <div class="relative min-h-[55%] aspect-square bg-white rounded-xl p-10"> 
            <img src="/img/score.png" alt="score" class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-3/5">
            <a href="{{ url()->current() }}" class="absolute top-2 right-3 test-xl font-bold" onclick="localStorage.removeItem('answers')">X</a>
            <div class="flex flex-col gap-y-2 w-full h-full justify-end">
                <div class="flex flex-col gap-y-3 mb-2">
                    <p class="text-[#A3ACB6] text-center">คุณได้คะแนน</p>
                    <p class="font-bold text-center text-7xl text-[#2A638A]">{{ number_format((float) app('request')->input('score')/3*100, 2) }} %</p>
                </div>
                <div class="flex justify-center gap-x-3 w-full font-noto-thai mt-3 flex-col gap-y-3">
                    <a href="{{ url()->current() }}/?doquiz=true&no=1" onclick="localStorage.removeItem('answers')"
                        class="rounded-full text-[#2A638A] bg-[#E9F2FC] px-14 py-3 w-full text-center">เริ่มทำใหม่</a>
                    <a href="{{ url()->current() }}/?doquiz=true&no=1" onclick="localStorage.removeItem('answers')"
                        class="rounded-full bg-[#2A638A] text-[#E9F2FC] px-14 py-3 w-full text-center font-bold">เรียนบทต่อไป !</a>
                </div>
            </div>
        </div>
    </div>
</div>
