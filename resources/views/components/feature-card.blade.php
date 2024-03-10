<div class="bg-white rounded-xl">
    <div
        class=" flex flex-col justify-center items-center rounded-xl group bg-gradient-to-t from-white to-white {{ $containerClass }} py-16 gap-y-5 duration-500 h-full">
        <div
            class="flex items-center justify-center p-6 rounded-full bg-gradient-to-t {{ $childrenClass }} group-hover:from-white group-hover:to-white  aspect-square w-1/2">
            <img src="{{ $baseImage }}" alt="feature" class="w-full group-hover:hidden">
            <img src="{{ $hoverImage }}" alt="feature" class="w-full hidden group-hover:block">
        </div>
        <div class="text-center flex flex-col">
            <h2 class="text-xl font-bold text-center">{{ $title }}</h2>
            <p class="text-center px-5 font-medium">{{ $description }}</p>
        </div>
    </div>
</div>
