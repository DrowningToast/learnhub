@php
@endphp

<x-left_side_layout>
    <div class="flex flex-col gap-y-1 px-1 py-2">
        <h1 class="text-4xl text-[#2A638A] font-noto-thai font-bold">
            {{ $course->title }}
        </h1>
        <p class="text-xl text-[#676767]">
            {{ $course->description }}
        </p>
        <div class="mt-6 space-y-2">
            <h2 class="text-2xl font-semibold">
                ไฟล์ประกอบการเรียนการสอน
            </h2>
            <div class="flex overflow-y-hidden overflow-x-auto w-auto gap-8 pb-4">
                @foreach ($course->chapters as $index=>$chapter)
                    @if ($index > count($progress))
                        <x-chapter-card-white
                            chapter="{{$index + 1}}"
                            title="{{$chapter->title}}"
                        />
                    @else
                        <x-chapter-card 
                            chapter="{{$index + 1}}"
                            title="{{$chapter->title}}"
                        />
                    @endif
                @endforeach
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-2xl font-semibold">
                บทเรียน
            </h2>
            <div class="flex flex-col gap-y-4">
                @foreach ($course->chapters as $index=>$chapter)
                    <x-chapter-button
                        chapter="{{$index + 1}}"
                        title="{{$chapter->title}}"
                        done="{{!($index > count($progress))}}"
                        durationInMinutes="{{$chapter->durationInMinutes}}"
                        courseId="{{$course->id}}"
                        chapterId="{{$chapter->id}}"
                    />
                @endforeach
            </div>
        </div>
    </div>
</x-left_side_layout>