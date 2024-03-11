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
    <div class="bg-[#2A638A] full-h-screen flex p-5">
        <div class="bg-white w-full full-h-screen flex p-5 rounded-2xl gap-3 justify-between">
            <div class="flex gap-x-10 flex-col">
                
                <div class="felx font-noto-thai">
                    <div class="flex text-2xl gap-3 text-[#2A638A]">
                        {{-- <x-ri-arrow-left-wide-fill" class="text-black"/> --}}
                        <p class="font-bold">บทที่ 1:</p>
                        <p> ออกแบบเว็บด้วย HTML</p>
                    </div>

                    <div class="text-xs font-bold pl-10 text-[#C6CBD3]">
                        <p class="">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor"Lorem
                            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor"Lorem ipsum dolor
                            sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>

                </div>

                <div class="flex gap-10 justify-center">
                    <div class="flex flex-col">
                        <div>
                            <iframe width="100%" height="auto"
                                src="https://www.youtube.com/embed/ZEGpWo7ethQ?si=s3F9Kv3yIa91LFGJ"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
    
                        <div class="flex justify-center flex-col">
                            <p>Chapter 1</p>
                            <x-ri-arrow-down-wide-line class="w-4"/>
    
    
                        </div>
                    
    
                </div>

            </div>

            <div class="flex flex-col">
                <div class="bg-[#024B71] text-white font-noto-thai rounded-2xl flex">
                    <x-tabler-bulb-filled class="text-black" />
                    <p>Do Quiz Chapter 1</p>
                </div>

                <div class="rounded-2xl">
                    <img src="/img/ex1.webp" alt="" class="w-full">
                </div>
                <div class="rounded-2xl">
                    <img src="/img/ex1.webp" alt="" class="w-full">
                </div>
                <div class="rounded-2xl">
                    <img src="/img/ex1.webp" alt="" class="w-full">
                </div>
                <div class="rounded-2xl">
                    <img src="/img/ex1.webp" alt="" class="w-full">
                </div>
                <div class="rounded-2xl">
                    <img src="/img/ex1.webp" alt="" class="w-full">
                </div>

            </div>

            

        </div>




    </div>



</body>

</html>
