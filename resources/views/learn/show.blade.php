<x-left_side_layout>
    <div class="flex flex-col gap-y-1">
        <div class="flex flex-row items-center justify-between">
            <h1 class="text-3xl text-[#2A638A] font-noto-thai font-bold">
                {{ $course->title }}
            </h1>

            @if (!$isLearner)
                <div class="flex flex-row items-center gap-2 p-3 px-4 border rounded-xl cursor-pointer">
                    <img src="{{ asset('images/icons/edit.png') }}" alt="">
                    <a href="/courses/{{ $course->id }}/edit">
                        แก้ไขคอร์ส
                    </a>
                </div>
            @endif
        </div>
        <p class="text-lg text-[#676767] mt-4">
            {{ $course->description }}
        </p>

        <div class="mt-6 space-y-2">
            <div class="flex overflow-y-hidden overflow-x-auto w-auto gap-8 pb-4">
                @foreach ($course->chapters as $index => $chapter)
                    @if ($chapter->files->count() <= 0)
                        <p class="text-[#C6CBD3] text-center">ไม่พบเอกสาร</p>
                    @break
                @endif
                @foreach ($chapter->files as $file)
                    @if ($index + 1 > count($progress))
                        <x-chapter-card-white chapter="{{ $index + 1 }}" title="{{ $file->file_name }}"
                            href="{{ $file->file_path }}" />
                    @else
                        <x-chapter-card chapter="{{ $index + 1 }}" title="{{ $file->file_name }}"
                            href="{{ $file->file_path }}" />
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="mt-8">
        <h2 class="text-2xl font-semibold">
            บทเรียน
        </h2>
        <div class="flex flex-col gap-y-4 mt-6">
            @foreach ($course->chapters as $index => $chapter)
                <x-chapter-button chapter="{{ $index + 1 }}" title="{{ $chapter->title }}"
                    done="{{ !($index + 1 > count($progress)) }}"
                    durationInMinutes="{{ $chapter->durationInMinutes }}" courseId="{{ $course->id }}"
                    chapterId="{{ $chapter->id }}" />
            @endforeach
            <a href="/courses/{{ $course->id }}/chapters/create"
                class="w-full h-[75px] text-5xl border-dashed border border-[#C6CBD3] text-[#C6CBD3] flex justify-center items-center rounded-xl">+</a>
        </div>
    </div>

    @if ($isLearner)
        <div class="mt-8 space-y-4">
            {{-- review --}}
            <h3 class="text-2xl font-semibold text-black">
                คะแนนและรีวิว
            </h3>
            <form class="flex flex-col gap-y-4" action="/learn/{{ $course->id }}/review" method="POST" disable>
                @csrf
                <div class="flex flex-col gap-y-4 border-[1px] border-[#DBE3EE] rounded-2xl p-6">
                    <div class="flex">
                        <h4 class="font-semibold text-xl text-black">
                            คะแนน
                        </h4>
                        <div class="ml-auto flex items-center gap-x-1">
                            @error('rating')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <label onclick="setRating(1)" for="rating-1">
                                <img class="w-6 h-6" id="star-1" src="{{ asset('/assets/star-1.png') }}"
                                    alt="score-1">
                            </label>
                            <input {{ old('rating') == '1' || $review['rating'] == 1 ? 'checked' : '' }}
                                type="radio" name="rating" id="rating-1" class="hidden" value="1">
                            <label onclick="setRating(2)" for="rating-2">
                                <img class="w-6 h-6" id="star-2" src="{{ asset('/assets/star-1.png') }}"
                                    alt="score-2">
                            </label>
                            <input {{ old('rating') == '2' || $review['rating'] == 2 ? 'checked' : '' }}
                                type="radio" name="rating" id="rating-2" class="hidden" value="2">
                            <label onclick="setRating(3)" for="rating-3">
                                <img class="w-6 h-6" id="star-3" src="{{ asset('/assets/star-1.png') }}"
                                    alt="score-3">
                            </label>
                            <input {{ old('rating') == '3' || $review['rating'] == 3 ? 'checked' : '' }}
                                type="radio" name="rating" id="rating-3" class="hidden" value="3">
                            <label onclick="setRating(4)" for="rating-4">
                                <img class="w-6 h-6" id="star-4" src="{{ asset('/assets/star-1.png') }}"
                                    alt="score-4">
                            </label>
                            <input {{ old('rating') == '4' || $review['rating'] == 4 ? 'checked' : '' }}
                                type="radio" name="rating" id="rating-4" class="hidden" value="4">
                            <label onclick="setRating(5)" for="rating-5">
                                <img class="w-6 h-6" id="star-5" src="{{ asset('/assets/star-1.png') }}"
                                    alt="score-5">
                            </label>
                            <input {{ old('rating') == '5' || $review['rating'] == 5 ? 'checked' : '' }}
                                type="radio" name="rating" id="rating-5" class="hidden" value="5">
                        </div>
                        <script defer>
                            rating = 0;

                            function setRating(score) {
                                rating = score;
                                for (let index = 1; index <= 5; index++) {
                                    if (rating < index) {
                                        document.getElementById(`star-${index}`).src = "{{ asset('/assets/star-1.png') }}";
                                    } else {
                                        document.getElementById(`star-${index}`).src = "{{ asset('/assets/star-2.png') }}";
                                    }
                                }
                            }

                            window.onload = function() {
                                setRating({{ old('rating') ?? $review['rating'] }});
                            }
                        </script>
                    </div>
                    <hr class="text-[#DBE3EE] bg-[#DBE3EE]">
                    @error('comment')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <textarea name="comment" id="" cols="30" rows="5"
                        placeholder="เขียนความคิดเห็นสำหรับคอร์สเรียนนี้ของคุณ..." class="bg-white text-lg rounded-md">{{ old('comment') ?? $review['comment'] }}</textarea>
                </div>
                <div class="ml-auto">
                    <button class="px-12 py-2 bg-[#2A638A] text-white font-semibold rounded-full">
                        ส่งความคิดเห็น
                    </button>
                </div>
            </form>
        </div>
    @endif
</x-left_side_layout>
