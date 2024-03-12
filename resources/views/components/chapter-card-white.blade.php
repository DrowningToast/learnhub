<div class="bg-[#FFFFFF] flex rounded-2xl min-w-[260px] h-auto p-6 border-solid border border-[#C1C7CE]">
    <div class="rounded-lg flex flex-col gap-y-3 w-full h-auto">
        <div class="rounded-full bg-[#DBE3EE] p-5 justify-start w-1/4">
            <x-bxs-file class="text-white w-full" />
        </div>
        <div class="flex flex-col gap-y-2 text-lg min-h-20 pr-10 mt-2">
            <p class=" font-bold text-black font-noto-thai">บทที่ {{ $chapter }} :</p>
            <p class=" text-black font-noto-thai">{{ $title }}</p>
        </div>
        <a class="inline-block w-full h-full" href='{{ $href }}'>
            <div class="w-full h-full flex items-end ">
                <button type="button"
                    class="bg-[#FFFFFF] text-xs rounded-full w-full py-2 font-bold border-solid border border-[#C1C7CE] font-noto-thai">ดาวน์โหลด</button>
            </div>
        </a>
    </div>
</div>
