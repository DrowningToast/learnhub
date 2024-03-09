
<div class="bg-[#FFFFFF] flex rounded-2xl w-full p-6 border-solid border-2 border-[#C1C7CE]">

    <div class="rounded-lg flex flex-col gap-y-3 w-full">

        <div class="rounded-full bg-[#DBE3EE] p-5 justify-start w-1/3">
            <x-bxs-file class="text-white w-full"/>
        </div>

        <div class="flex flex-col gap-y-2 text-xl min-h-48 pr-10">
            <p class=" font-bold text-black font-noto-thai">Chapter {{$chapter}} :</p>
            <p class=" text-black font-noto-thai">{{$title}}</p>
        </div>

        <div class="h-full flex items-end ">
            <button type="button" class="bg-[#FFFFFF] text-black rounded-full w-full py-3 font-bold border-solid border-2 border-[#C1C7CE] font-noto-thai">ดาวน์โหลด</button>
        </div>
    </div>
</div>