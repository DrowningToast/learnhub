@php
    $colors = ['bg-[#E2EEFB]', 'bg-[#F2E6FF]', 'bg-[#FFEAF0]'];
    $primaryColor = ['bg-[#4369A2]', 'bg-[#8B68B1]', 'bg-[#C97D93]'];
    $shadowColor = ['hover:shadow-[#C1D9F2]', 'hover:shadow-[#CCB9E0]', 'hover:shadow-[#EFC4D0]'];
    $counter = 0;
@endphp

<x-left_side_layout>
    <section class=" gap-12 rounded-xl bg-white relative w-full">
        <div class="col-span-9 flex flex-col gap-y-6 w-full">
            <h1 class="text-5xl font-bold text-[#4369A2] font-noto-thai">
                จัดการคอร์สเรียน
            </h1>
            <form class="space-y-4 w-full">
                <div class=" max-h-16 relative overflow-hidden rounded-2xl w-full focus-within:shadow-lg duration-200">
                    <input class="w-full rounded-2xl px-4 py-3 border-2 border-gray-200 h-16 outline-none text-lg"
                        type="text" placeholder="ค้นหาโดยใช้ชื่อคอร์ส..." name="title" value="{{ $oldInputValue }}">
                    <button>
                        <img src={{ asset('images/icons/magnify.png') }}
                            class="absolute top-1/2 right-4 transform -translate-y-1/2 w-6 h-6 z-10" alt="">
                    </button>
                    <div
                        class="w-20 from-[#00476C] to-[#235B9C] bg-gradient-to-b absolute -inset-y-24 -right-5 transform -rotate-45">
                    </div>
                    <div
                        class="w-20 from-[#3D6EB3] to-[#B4C8E9] bg-gradient-to-t absolute -inset-y-24 -right-5 transform rotate-45 opacity-60">
                    </div>
                </div>
                <div class="flex items-center gap-x-4">
                    <span class="text-xl font-semibold text-[#6F7979]">จัดเรียงตาม</span>
                    <select class="select-blue" name="categoryId">
                        <option>ทั้งหมด</option>
                        <option value="1" {{ app('request')->input('categoryId') === '1' ? 'selected' : '' }}>
                            สุขภาพและการดูแลตนเอง</option>
                        <option value="2" {{ app('request')->input('categoryId') === '2' ? 'selected' : '' }}>
                            ทักษะการใช้เทคโนโลยีพื้นฐาน</option>
                        <option value="3" {{ app('request')->input('categoryId') === '3' ? 'selected' : '' }}>
                            การจัดการทางการเงิน</option>
                        <option value="4" {{ app('request')->input('categoryId') === '4' ? 'selected' : '' }}>
                            งานอดิเรกและงานฝีมือ</option>
                        <option value="5" {{ app('request')->input('categoryId') === '5' ? 'selected' : '' }}>
                            การสร้างความสัมพันธ์ทางสังคม</option>
                        <option value="6" {{ app('request')->input('categoryId') === '6' ? 'selected' : '' }}>
                            สุขภาพจิตและความเป็นอยู่ที่ดี</option>
                        <option value="7" {{ app('request')->input('categoryId') === '7' ? 'selected' : '' }}>
                            โภชนาการและการกินที่ถูกต้อง</option>
                    </select>
                    <select class="select-blue" name="orderBy">
                        <option value="latest" {{ app('request')->input('orderBy') === 'latest' ? 'selected' : '' }}>
                            ใหม่สุด-เก่าสุด</option>
                        <option value="oldest" {{ app('request')->input('orderBy') === 'oldest' ? 'selected' : '' }}>
                            เก่าสุด-ใหม่สุด</option>
                    </select>
                </div>
            </form>
            <div class="flex flex-col gap-y-8">
                @foreach ($courses as $course)
                    <x-menu-card title="{{ $course['title'] }}" description="{{ $course['description'] }}"
                        author="{{ $course['lecturer']['first_name'] }} {{ $course['lecturer']['last_name'] }}"
                        imgSrc="{{ $course['cover_image_src'] }}" href="/courses/{{ $course['id'] }}/edit"
                        bgColor="{{ $colors[$loop->index % 3] }}" btnColor="{{ $primaryColor[$loop->index % 3] }}"
                        shColor="{{ $shadowColor[$loop->index % 3] }}" />
                @endforeach
            </div>
        </div>
    </section>
</x-left_side_layout>
