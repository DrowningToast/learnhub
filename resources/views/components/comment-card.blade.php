<div class="bg-white py-8 px-10 aspect-video rounded-xl flex flex-col gap-y-5 w-full {{ $className }}">
    <div class="flex gap-x-4 items-center">
        <img src="{{ $imgSrc }}" alt="profile" class="w-20 h-20 rounded-full" />
        <div class="flex flex-col leading-5 gap-y-2">
            <p class="font-bold text-lg">{{ $name }}</p>
            <p class=" leading-normal">{{ $courseName }}</p>
            <x-star-rating rating="{{ $rating }}" />
        </div>
    </div>
    <div>{{ $comment }}</div>
</div>
