<a href="{{ $href }}">
    <div class="h-[290px] w-full {{ $bgColor }} {{ $shColor }} hover:shadow-xl rounded-xl px-14 py-10 flex justify-center gap-x-24 duration-200">
        <img src="{{{ $imgSrc }}}" alt="manage course" class="h-full">
        <div class="flex flex-col justify-center gap-y-4 w-full">
            <h1 class="font-bold text-4xl text-ellipsis line-clamp-2">{{ $title }}</h1>
            <p class="text-[#A8ACAC] text-ellipsis line-clamp-3 text-wrap">{{ $description }}</p>
            @if ($author != "")
                <p class="text-[#A8ACAC]">สร้างโดย {{ $author }}</p>
            @endif
        </div>
        <div class="flex h-full items-end">
            <div class="p-5 {{ $btnColor }} rounded-full w-[54px] h-[54px] flex justify-center items-center"><x-microns-right class="w-full text-white"/></div>
        </div>
    </div>
</a>
