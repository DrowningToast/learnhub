<a href="/learn/{{ $id }}">
    <div class="grid grid-cols-10 gap-x-8 rounded-2xl {{ $color }} p-8 {{ $shadowColor }} hover:shadow-xl">
        <div class="col-span-4">
            <img class="rounded-md" src={{ $src }} alt={{ $title . 'preview video' }}>
        </div>
        <div class="col-span-6 flex flex-col justify-between gap-y-4">
            <h1 class="font-bold text-xl">
                {{ $title }}
            </h1>
            <p class="font-semibold text-sm text-[#A8ACAC]">
                {{ strlen($description) > 750 ? substr($description, 0, 750) . '...' : $description }}
            </p>
            <span class="font-bold text-sm text-[#A8ACAC]">
                สอนโดย {{ $author }}
            </span>

            <div class="flex items-center gap-x-4">
                <div class="flex w-4/5 h-3 bg-[#C7D3EB] rounded-full overflow-hidden" role="progressbar"
                    aria-valuenow="{{ intval($progress * 100) }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="flex flex-col justify-center rounded-full overflow-hidden {{ $primaryColor }} text-xs text-white text-center whitespace-nowrap transition duration-500"
                        style="width: {{ intval($progress * 100) }}%"></div>
                </div>
                <span class="text-[#A8ACAC]">
                    {{ intval($progress * 100) }}%
                </span>

                <div class="{{ $primaryColor }} p-3 rounded-full flex items-center justify-center m-0">
                    <img src="{{ asset('images/icons/arrow.png') }}" alt="next" class="">
                </div>
            </div>


        </div>
    </div>
</a>
