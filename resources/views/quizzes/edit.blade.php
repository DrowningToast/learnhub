<x-left_side_layout>
    <div class="flex flex-row items-center gap-2 text-2xl text-[#2A638A] mt-1">
        <div class="font-bold">แก้ไขแบบทดสอบ: </div>
        <div>บทเรียน {{ $chapter->title }}</div>
    </div>

    <form method="PUT" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="shadow p-8 rounded-xl border mt-10">
            <div class="flex flex-col gap-2 ">
                <label for="q1_question" class="text-[#A3ACB6] font-semibold text-xl">แบบทดสอบข้อที่ 1</label>
                <textarea type="text" id="q1_question" rows="3"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="คำถามแบบทดสอบข้อที่ 1" name="q1_question">{{ $quiz->q1->question }}</textarea>

                @error('q1_question')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="q1_choice_a" class="text-[#A3ACB6] font-semibold text-xl">ตัวเลือก</label>
                <div class="flex flex-row items-center gap-4">
                    <label for="q1_choice_a" class="w-fit font-semibold text-xl">ก</label>
                    <input type="text" id="q1_choice_a"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q1_choice_a" value="{{ $quiz->q1->choice_a }}" />
                </div>

                @error('q1_choice_a')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-4">
                <div class="flex flex-row items-center gap-4">
                    <label for="q1_choice_b" class="w-fit font-semibold text-xl">ข</label>
                    <input type="text" id="q1_choice_b"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q1_choice_b" value="{{ $quiz->q1->choice_b }}" />
                </div>

                @error('q1_choice_b')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-4">
                <div class="flex flex-row items-center gap-4">
                    <label for="q1_choice_c" class="w-fit font-semibold text-xl">ค</label>
                    <input type="text" id="q1_choice_c"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q1_choice_c" value="{{ $quiz->q1->choice_c }}" />
                </div>

                @error('q1_choice_c')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="q1_answer" class="text-[#A3ACB6] font-semibold text-xl">คำตอบที่ถูกต้อง</label>
                <select name="q1_answer" id="q1_answer"
                    class=" border p-3 rounded-xl focus:outline-none focus:border-[#000842] block w-full mt-1">
                    <option selected>โปรดเลือกคำตอบที่ถูกต้อง</option>
                    <option value="A" {{ $quiz->q1->answer === 'A' ? 'selected' : '' }}>ข้อ ก.</option>
                    <option value="B" {{ $quiz->q1->answer === 'B' ? 'selected' : '' }}>ข้อ ข.</option>
                    <option value="C" {{ $quiz->q1->answer === 'C' ? 'selected' : '' }}>ข้อ ค.</option>
                </select>

                @error('q1_answer')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="shadow p-8 rounded-xl border mt-10">
            <div class="flex flex-col gap-2 ">
                <label for="q2_question" class="text-[#A3ACB6] font-semibold text-xl">แบบทดสอบข้อที่ 2</label>
                <textarea type="text" id="q2_question" rows="3"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="คำถามแบบทดสอบข้อที่ 1" name="q2_question">{{ $quiz->q2->question }}</textarea>

                @error('q2_question')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="q2_choice_a" class="text-[#A3ACB6] font-semibold text-xl">ตัวเลือก</label>
                <div class="flex flex-row items-center gap-4">
                    <label for="q2_choice_a" class="w-fit font-semibold text-xl">ก</label>
                    <input type="text" id="q2_choice_a"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q2_choice_a" value="{{ $quiz->q2->choice_a }}" />
                </div>

                @error('q2_choice_a')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-4">
                <div class="flex flex-row items-center gap-4">
                    <label for="q2_choice_b" class="w-fit font-semibold text-xl">ข</label>
                    <input type="text" id="q2_choice_b"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q2_choice_b" value="{{ $quiz->q2->choice_b }}" />
                </div>

                @error('q2_choice_b')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-4">
                <div class="flex flex-row items-center gap-4">
                    <label for="q2_choice_c" class="w-fit font-semibold text-xl">ค</label>
                    <input type="text" id="q2_choice_c"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q2_choice_c" value="{{ $quiz->q2->choice_c }}" />
                </div>

                @error('q2_choice_c')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="q2_answer" class="text-[#A3ACB6] font-semibold text-xl">คำตอบที่ถูกต้อง</label>
                <select name="q2_answer" id="q2_answer"
                    class=" border p-3 rounded-xl focus:outline-none focus:border-[#000842] block w-full mt-1">
                    <option selected>โปรดเลือกคำตอบที่ถูกต้อง</option>
                    <option value="A" {{ $quiz->q2->answer === 'A' ? 'selected' : '' }}>ข้อ ก.</option>
                    <option value="B" {{ $quiz->q2->answer === 'B' ? 'selected' : '' }}>ข้อ ข.</option>
                    <option value="C" {{ $quiz->q2->answer === 'C' ? 'selected' : '' }}>ข้อ ค.</option>
                </select>

                @error('q2_answer')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="shadow p-8 rounded-xl border mt-10">
            <div class="flex flex-col gap-2 ">
                <label for="q3_question" class="text-[#A3ACB6] font-semibold text-xl">แบบทดสอบข้อที่ 3</label>
                <textarea type="text" id="q3_question" rows="3"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="คำถามแบบทดสอบข้อที่ 3" name="q3_question">{{ $quiz->q3->question }}</textarea>

                @error('q3_question')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="q3_choice_a" class="text-[#A3ACB6] font-semibold text-xl">ตัวเลือก</label>
                <div class="flex flex-row items-center gap-4">
                    <label for="q3_choice_a" class="w-fit font-semibold text-xl">ก</label>
                    <input type="text" id="q3_choice_a"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q3_choice_a" value="{{ $quiz->q3->choice_a }}" />
                </div>

                @error('q3_choice_a')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-4">
                <div class="flex flex-row items-center gap-4">
                    <label for="q3_choice_b" class="w-fit font-semibold text-xl">ข</label>
                    <input type="text" id="q3_choice_b"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q3_choice_b" value="{{ $quiz->q3->choice_b }}" />
                </div>

                @error('q3_choice_b')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-4">
                <div class="flex flex-row items-center gap-4">
                    <label for="q3_choice_c" class="w-fit font-semibold text-xl">ค</label>
                    <input type="text" id="q3_choice_c"
                        class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                        name="q3_choice_c" value="{{ $quiz->q3->choice_c }}" />
                </div>

                @error('q3_choice_c')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="flex flex-col gap-2 mt-6">
                    <label for="q3_answer" class="text-[#A3ACB6] font-semibold text-xl">คำตอบที่ถูกต้อง</label>
                    <select name="q3_answer" id="q3_answer"
                        class=" border p-3 rounded-xl focus:outline-none focus:border-[#000842] block w-full mt-1">
                        <option selected>โปรดเลือกคำตอบที่ถูกต้อง</option>
                        <option value="A" {{ $quiz->q3->answer === 'A' ? 'selected' : '' }}>ข้อ ก.</option>
                        <option value="B" {{ $quiz->q3->answer === 'B' ? 'selected' : '' }}>ข้อ ข.</option>
                        <option value="C" {{ $quiz->q3->answer === 'C' ? 'selected' : '' }}>ข้อ ค.</option>
                    </select>

                    @error('q3_answer')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex flex-row items-center justify-between gap-6 mt-12">
            <div class="flex flex-row items-center justify-end gap-6 w-full">
                <a class="w-[25%] bg-[#E9F2FC] text-[#2A638A] rounded-3xl text-center font-bold focus:outline-none py-3 text-lg"
                    href="/learn/{{ $course->id }}">
                    ยกเลิก</a>

                <button type="submit"
                    class="w-[25%] bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg ">บันทึก</button>
            </div>
        </div>


    </form>
</x-left_side_layout>

{{-- http://localhost:3000/courses/21/chapters/205/quizzes/create --}}
