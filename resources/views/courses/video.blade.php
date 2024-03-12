<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <title>Course Video</title>
</head>

<body>
    {{-- {{ dd($chapter) }} --}}
    @php
        preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $chapter['video_src'],
            $match,
        );
        $youtube_id = $match[1];
    @endphp
    <div class="flex p-10 bg-gradient-to-b from-[#2A638A] to-black w-full min-h-screen font-noto-thai">
        <x-toast />
        <div class="flex bg-white rounded-2xl w-full pb-10">
            <div class="grid grid-cols-4 gap-y-5">

                <div class="flex flex-col px-5 col-span-3">
                    <div
                        class=" flex font-noto-thai text-[40px] text-[#2A638A] gap-x-5 gap-y-5 pt-10 pb-5 items-center">
                        <a href="/learn/{{ $chapter['course_id'] }}"><x-ri-arrow-left-s-line
                                class="text-black w-10 cursor-pointer" /></a>
                        <p class="font-bold">{{ $chapter['title'] }}</p>
                    </div>
                    <div class="font-noto-thai text-[14px] text-[#A8ACAC] pl-10 pb-7">
                        <p class="indent-10 font-bold">{{ $chapter['description'] }}</p>
                    </div>
                </div>

                <div class="px-5 flex w-full items-end">
                    @if ($chapter['quizz'])
                    <div class="w-full">
                        <a href="{{ url()->current() }}/?doquiz=true&no=1"
                            class="flex rounded-2xl bg-[#024B71] w-full font-noto-thai items-center gap-x-3 justify-center py-3">
                            <x-tabler-bulb-filled class="text-white w-[32px] h-[32px]" />
                            <p class="font-[#20px] text-white font-bold">Do Quiz</p>
                        </a>
                    </div>
                    @else
                    <div class="w-full">
                        <a href="{{ url()->current() }}/?type=markasdone"
                            class="flex rounded-2xl bg-[#024B71] w-full font-noto-thai items-center gap-x-3 justify-center py-3">
                            <x-tabler-bulb-filled class="text-white w-[32px] h-[32px]" />
                            <p class="font-[#20px] text-white font-bold">Mark as done</p>
                        </a>
                    </div>
                    @endif
                    @if (app('request')->input('doquiz') == 'true')
                        @php
                            $no = 'q' . app('request')->input('no');
                            $q = json_decode($chapter['quizz']['quiz_data'])->$no;
                        @endphp
                        <x-quiz-popup question="{{ $q->question }}" choiceA="{{ $q->choice_a }}"
                            choiceB="{{ $q->choice_b }}" choiceC="{{ $q->choice_c }}"
                            courseid="{{ $chapter['course_id'] }}" chapterid="{{ $chapter['id'] }}" />
                    @endif
                    {{-- score popup --}}
                    <x-score-popup courseId="{{ $course['id'] }}" />
                </div>

                <div class="flex flex-col px-5 col-span-3">
                    <div class="pl-2 pb-12 h-full">
                        <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen width="100%" class="aspect-video w-full"></iframe>
                    </div>
                </div>

                <div class="flex flex-col px-5 gap-5 col-span-1">
                    <div class="overflow-y-auto ">
                        @foreach ($allChaps as $chap)
                            @php
                                preg_match(
                                    '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                                    $chap['video_src'],
                                    $childMatch,
                                );
                                $ytid = $childMatch[1];
                            @endphp
                            <div class="rounded-3xl pb-4">
                                <a href="/learn/{{ $chap['course_id'] }}/{{ $chap['id'] }}"><x-chapter-next-up chapter="{{ $chap['chapId'] }}"
                                        title="{{ $chap['title'] }}" img="{{ $ytid }}" /></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

</body>

</html>
