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
            <a href="/courses/{{ $course->id }}/chapters/create" class="w-full h-[75px] text-5xl border-dashed border border-[#C6CBD3] text-[#C6CBD3] flex justify-center items-center rounded-xl">+</a>
        </div>
    </div>
</div>
<div class="mt-6">
    {{-- review --}}
    <h1>
        คะแนนและรีวิว
    </h1>
    <form action="/review" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col divide-y-2">

        </div>
    </form>
</div>
</x-left_side_layout>
