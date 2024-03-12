<div
    class="flex flex-col rounded-2xl relative bg-cover">
    <img src="https://img.youtube.com/vi/{{$img}}/maxresdefault.jpg" alt="bg">
    <div class="gap-x-6 flex flex-col absolute top-[50%] left-[50%]  translate-x-[-50%] translate-y-[-50%] ">
        <div class="rounded-full p-2  justify-center items-center bg-[#181C20] w-10 h-10 z-10">
            <x-zondicon-play class="text-[#D9D9D9]" />
        </div>
    </div>

    <div class="flex absolute text-white font-noto-thai font-[14px] w-full justify-center top-[70%] left-1/2 transform -translate-x-1/2 bg-black/70 px-2 py-1 rounded-sm">
        <p class="font-bold"> Chapter {{ $chapter }} : {{ $title }}</p>
    </div>
</div>
