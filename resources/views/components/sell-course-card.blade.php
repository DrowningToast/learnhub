@php
    if ($category === 1) {
    $category = 'สุขภาพและการดูแลตนเอง';
    } elseif ($category === 2) {
        $category = 'ทักษะการใช้เทคโนโลยีพื้นฐาน';
    } elseif ($category === 3) {
        $category = 'การจัดการทางการเงิน';
    } elseif ($category === 4) {
        $category = 'งานอดิเรกและงานฝีมือ';
    } elseif ($category === 5) {
        $category = 'การสร้างความสัมพันธ์ทางสังคม';
    } elseif ($category === 6) {
        $category = 'สุขภาพจิตและความเป็นอยู่ที่ดี';
    } elseif ($category === 7) {
        $category = 'โภชนาการและการกินที่ถูกต้อง';
    }
@endphp

<a href="/courses/{{ $courseId }}">
    <div class="border border-[#E0E2EA] flex flex-col p-5 rounded-xl bg-white gap-y-5">
        <img src="{{ $banner }}" alt="Course Banner" class="rounded-xl h-60 object-cover w-auto">
        <div class="flex justify-between items-center gap-4">
            <div class="flex items-center gap-x-3 w-fit rounded-full">
                <img src="{{ $lecProfile }}" alt="Lecturer Profile" class=" w-14 h-14 rounded-full">
                <p class="text-[#6F7979] text-pretty">{{ $lecturer }}</p>
            </div>
            <div class="bg-[#D4E3FF] text-[#235B9C] font-bold text-base text-nowrap px-3 py-4 rounded-xl">
                {{ $category }}</div>
        </div>
        <div class="px-2 h-[8svh]">
            <p class="font-bold text-xl">{{ $description }}</p>
        </div>
        <div class="flex justify-between px-2">
            <div class="flex gap-x-1 items-center">
                <x-bi-clock class="text-blue-800 mb-1" />
                <p class="text-[#6F7979]">{{ $duration }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <x-bi-book class="text-blue-800 mb-1" />
                <p class="text-[#6F7979]">{{ $lectures }} บทเรียน</p>
            </div>
        </div>
        <div class="bg-[#D4E3FF] flex justify-between items-center rounded-xl p-5 font-bold text-lg">
            <p>&#3647; {{ $price }}</p>
            <x-star-rating rating="{{ $rating }}" />
        </div>
    </div>
</a>
