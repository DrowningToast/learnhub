<a href="/learn/{{$href}}">
    <div class="grid grid-cols-10 gap-x-8 rounded-2xl bg-[#E2EEFB] p-8">
        <div class="col-span-4">
            <img src={{$src}} alt={{$title . "preview video"}}>
        </div>
        <div class="col-span-6 flex flex-col justify-between">
            <h1 class="font-bold text-xl">
                {{$title}}
            </h1>
            <p class="font-semibold text-sm text-[#A8ACAC]">
                {{$description}}
            </p>
            <span class="font-bold text-sm text-[#A8ACAC]">
                Created by {{$author}}
            </span>
            <progress class="w-full rounded-lg" step="0.01" name="points" min="0" max="1" value={{$progress}}>
        </div>
    </div>
</a>