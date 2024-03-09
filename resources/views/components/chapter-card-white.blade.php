
<div class="bg-[#FFFFFF] flex rounded-2xl  w-[260px] h-auto min-h-[290px] p-6 border-solid border border-[#C1C7CE]">

    <div class="rounded-lg flex flex-col gap-y-3 w-full">

        <div class="rounded-full bg-[#DBE3EE] p-5 justify-start w-1/3">
            <x-bxs-file class="text-white w-full"/>
        </div>

        <div class="flex flex-col gap-y-2 text-xl min-h-32 pr-10">
            <p class=" font-bold text-black font-noto-thai">Chapter {{$chapter}} :</p>
            <p class=" text-black font-noto-thai">{{$title}}</p>
        </div>

        <div class="h-full flex items-end ">
            <button type="button" class="bg-[#FFFFFF]  text-xs rounded-full w-full py-2 font-bold border-solid border border-[#C1C7CE] font-noto-thai">Dowload File</button>
        </div>
    </div>
</div>