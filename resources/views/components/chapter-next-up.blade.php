<div
    class="flex flex-col rounded-2xl relative bg-cover">
    <img src="https://img.youtube.com/vi/{{$img}}/maxresdefault.jpg" alt="bg">
    <div class="gap-x-6 flex flex-col absolute top-[50%] left-[50%]  translate-x-[-50%] translate-y-[-50%] ">
        <div class="rounded-full p-2  justify-center items-center bg-[#181C20] w-10 h-10 z-10">
            <x-zondicon-play class="text-[#D9D9D9]" />
        </div>
    </div>

    <div class="flex absolute text-white font-noto-thai font-[14px]  top-[70%] left-[10%]">
        <p class="font-bold"> Chapter {{ $chapter }} :</p>
        <p class="">{{ $title }}</p>
    </div>

</div>
