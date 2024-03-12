<div class="bg-[#4369A2] flex rounded-2xl min-w-[260px] h-auto p-6 relative">
    <div class="rounded-l-full absolute w-16 h-32 z-10 top-1/2 right-0 transform -translate-y-1/2 bg-[#8AB7DC]/50">
    </div>

    <div class="rounded-l-full absolute w-8 h-16 z-10 top-1/2 right-0 transform -translate-y-1/2 bg-white/20">
    </div>

    <div class="rounded-lg flex flex-col gap-y-3 w-full h-auto">

        <div class="rounded-full bg-[#8AB7DC] p-5 justify-start w-1/4">
            <x-bxs-file class="text-white w-full" />
        </div>

        <div class="flex flex-col gap-y-2 text-lg min-h-20 pr-10 mt-2">
            <p class=" font-bold text-white font-noto-thai">บทที่ {{ $chapter }} :</p>
            <p class=" text-white font-noto-thai">{{ $title }}</p>
        </div>

        <a class="inline-block w-full h-full" href='{{ $href }}'>
            <div class="h-full flex items-end ">
                <button type="button"
                    class="bg-[#FFFFFF] text-[#2A638A] rounded-full w-full py-2 font-bold font-noto-thai text-xs">ดาวน์โหลด</button>
            </div>
        </a>
    </div>
</div>
