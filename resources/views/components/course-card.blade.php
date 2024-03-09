<a href="/learn/{{$href}}">
    <div class="grid grid-cols-10 gap-x-8 rounded-2xl bg-[#E2EEFB] hover:bg-[#F2E6FF] p-8">
        <div class="col-span-4">
            <img class="rounded-md" src={{$src}} alt={{$title . "preview video"}}>
        </div>
        <div class="col-span-6 flex flex-col justify-between gap-y-4">
            <h1 class="font-bold text-xl">
                {{$title}}
            </h1>
            <p class="font-semibold text-sm text-[#A8ACAC]">
                {{$description}}
            </p>
            <span class="font-bold text-sm text-[#A8ACAC]">
                สอนโดย {{$author}}
            </span>
            <div class="flex items-center gap-x-4">
                <div class="flex w-4/5 h-3 bg-[#C7D3EB] rounded-full overflow-hidden" role="progressbar" aria-valuenow="{{$progress * 100}}" aria-valuemin="0" aria-valuemax="100">
                    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-[#47B2FF] text-xs text-white text-center whitespace-nowrap transition duration-500" style="width: {{$progress * 100}}%"></div>
                </div>
                <span class="text-[#A8ACAC]">
                    {{$progress * 100}}%
                </span>
            </div>
        </div>
    </div>
</a>