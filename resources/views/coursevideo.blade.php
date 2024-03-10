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

    <div class="flex p-5 bg-gradient-to-b from-[#2A638A] to-black w-full h-screen">
        <div class="flex bg-white rounded-2xl w-full pb-10">
            <div class="flex gap-y-10">
                <div class="flex flex-col pl-1 ">
                    <div class=" flex font-noto-thai text-[40px] text-[#2A638A]  gap-x-5 gap-y-5 pt-10 pb-5">
                        <a class="pt-2" href=""><x-ri-arrow-left-s-line class="text-black w-10 flex" /></a>
                        <p class="font-bold">Chapter 1 : </p>
                        <p>ออกแบบเว็บด้วย HTML</p>
                    </div>
                    <div class="font-noto-thai text-[14px] text-[#A8ACAC] pl-10 pb-7">
                        <p class="indent-10 font-bold">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor"Lorem
                            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="h-full pl-2 pb-12 ">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/2mcQrL2sJew?si=MYOuO3eCNHmgvDqO"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            width="100%"
                            height="100%"></iframe>
                    </div>
                    <div class="flex items-center flex-col w-full ">
                        <p class="font-bold text-[16px] font-noto-thai text-[#0D1D29]">Chapter 2 : ออกแบบเว็บด้วย HTML
                        </p>
                        <a href=""><x-ri-arrow-down-s-line class="w-10 flex justify-center" /></a>
                        
                    </div>
                </div>

                <div class="flex flex-col w-[560px] p-5 pt-[7%] gap-5">
                    <div class="flex rounded-2xl bg-[#024B71] w-full font-noto-thai relative">
                        <div>
                            
                            <x-tabler-bulb-filled class="text-black  w-[32px] h-[32px] pl-2 top-[13%] left-[13%] absolute" />
                            <p class="font-[#20px] text-white py-3 pl-24 font-bold">Do Quiz Chapter 1</p>
                        </div>

                    </div>
                    <div class="overflow-y-auto ">
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=1 title="ออกแบบเว็บด้วย HTML" img="y9kkXTucnLU" /></a>
                        </div>
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=2 title="ออกแบบเว็บด้วย css" img="1ScFEz7SiPQ" /></a>
                        </div>
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=3 title="ออกแบบเว็บด้วย js" img="YeAhmfUf0uY" /></a>
                        </div>
                        <div class="rounded-3xl pb-4">
                            <a href=""><x-chapter-next-up chapter=4 title="ออกแบบเว็บด้วย laravel" img="lCHrVoFNT2U" /></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

</body>

</html>
