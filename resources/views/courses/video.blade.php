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
    <div class="flex p-10 bg-gradient-to-b from-[#2A638A] to-black w-full min-h-screen">
        <div class="flex bg-white rounded-2xl w-full pb-10">
            <div class="flex gap-y-10">
                <div class="flex flex-col px-5 ">
                    <div class=" flex font-noto-thai text-[40px] text-[#2A638A] gap-x-5 gap-y-5 pt-10 pb-5 items-center">
                        <a href="/courses/{{ $courseid }}"><x-ri-arrow-left-s-line class="text-black w-10 cursor-pointer"/></a>
                        <p class="font-bold">Chapter 1 : ออกแบบเว็บด้วย HTML</p>
                    </div>
                    <div class="font-noto-thai text-[14px] text-[#A8ACAC] pl-10 pb-7">
                        <p class="indent-10 font-bold">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor"Lorem
                            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="pl-2 pb-12 h-full">
                        <iframe src="https://www.youtube.com/embed/{{ $ytid }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen width="100%" class="aspect-video"></iframe>
                    </div>
                    <div class="flex items-center flex-col w-full ">
                        <p class="font-bold text-[16px] font-noto-thai text-[#0D1D29]">Chapter 2 : ออกแบบเว็บด้วย HTML
                        </p>
                        <a href=""><x-ri-arrow-down-s-line class="w-10 flex justify-center" /></a>

                    </div>
                </div>

                <div class="flex flex-col w-[560px] p-5 pt-[7%] gap-5">
                    {{-- do quiz button --}}
                    <x-quiz-popup courseid="{{ $courseid }}" chapterid="{{ $ytid }}" />
                    {{-- score popup --}}
                    <x-score-popup />
                    <div class="overflow-y-auto ">
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=1 title="ออกแบบเว็บด้วย HTML"
                                    img="y9kkXTucnLU" /></a>
                        </div>
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=2 title="ออกแบบเว็บด้วย css"
                                    img="1ScFEz7SiPQ" /></a>
                        </div>
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=3 title="ออกแบบเว็บด้วย js"
                                    img="YeAhmfUf0uY" /></a>
                        </div>
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=4 title="ออกแบบเว็บด้วย laravel"
                                    img="lCHrVoFNT2U" /></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

</body>

</html>
