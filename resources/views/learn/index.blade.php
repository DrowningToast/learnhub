<?php
$username = 'Supratouch Suwatno';
$affiliation = 'โรงเรียนอนุบาลหมีน้อย';

$avg_progress =
    count($enrolledCourses) <= 0
        ? 0
        : $enrolledCourses->reduce(function ($carry, $item) {
                return $carry + $item['progress'] / 100;
            }) / count($enrolledCourses);
?>

@php
    $colors = ['bg-[#E2EEFB]', 'bg-[#F2E6FF]', 'bg-[#FFEAF0]'];
    $primaryColor = ['bg-[#4369A2]', 'bg-[#8B68B1]', 'bg-[#C97D93]'];
    $shadowColor = ['hover:shadow-[#C1D9F2]', 'hover:shadow-[#CCB9E0]', 'hover:shadow-[#EFC4D0]'];
    $counter = 0;
@endphp

<x-left_side_layout>
    <section class="grid grid-cols-12 gap-12 rounded-xl bg-white relative">
        <div class="col-span-9 flex flex-col gap-y-6">
            @if ($isLecturer)
                <h1 class="text-4xl font-bold text-[#4369A2] font-noto-thai">
                    จัดการคอร์สเรียน
                </h1>
            @else
                <h1 class="text-4xl font-bold text-[#4369A2] font-noto-thai">
                    คอร์สของฉัน
                </h1>
            @endif

            <form class="space-y-6">
                <div class=" max-h-16 relative overflow-hidden rounded-2xl w-full focus-within:shadow-lg duration-200">
                    <input class="w-full rounded-2xl px-4 py-3 border-2 border-gray-200 h-16 outline-none text-lg"
                        type="text" placeholder="ค้นหา..." name="title" value="{{ $oldInputValue }}">
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
                <div class="flex flex-row items-center justify-between">
                    <div class="flex items-center gap-x-4">
                        <span class="text-xl font-semibold text-[#6F7979]">จัดเรียงตาม</span>
                        <select class="rounded-full bg-[#E2EEFB] text-[#7F92B1] px-4 py-2 border-r-8 border-transparent"
                            name="categoryId">
                            <option value="ALL"
                                {{ app('request')->input('categoryId') === 'ALL' ? 'selected' : '' }}>หมวดหมู่ทั้งหมด
                            </option>
                            <option value="1" {{ app('request')->input('categoryId') === '1' ? 'selected' : '' }}>
                                วิทยาศาสตร์</option>
                            <option value="2" {{ app('request')->input('categoryId') === '2' ? 'selected' : '' }}>
                                คณิตศาสตร์</option>
                            <option value="3" {{ app('request')->input('categoryId') === '3' ? 'selected' : '' }}>
                                ภาษาไทย</option>
                            <option value="4" {{ app('request')->input('categoryId') === '4' ? 'selected' : '' }}>
                                สังคมศึกษา</option>
                            <option value="5" {{ app('request')->input('categoryId') === '5' ? 'selected' : '' }}>
                                ภาษาอังกฤษ</option>
                            <option value="6" {{ app('request')->input('categoryId') === '6' ? 'selected' : '' }}>
                                เทคโนโลยีสารสนเทศ</option>
                        </select>
                        <select class="rounded-full bg-[#E2EEFB] text-[#7F92B1] px-4 py-2 border-r-8 border-transparent"
                            name="time">
                            <option value="latest" {{ app('request')->input('time') === 'latest' ? 'selected' : '' }}>
                                ใหม่สุด-เก่าสุด
                            </option>
                            <option value="oldest" {{ app('request')->input('time') === 'oldest' ? 'selected' : '' }}>
                                เก่าสุด-ใหม่สุด
                            </option>
                        </select>
                    </div>

                    @if ($isLecturer)
                        <a href="/courses/create">
                            <div class="flex flex-row items-center gap-2 p-3 px-4 border rounded-xl cursor-pointer">
                                <img src="{{ asset('images/icons/lecturer/plus.png') }}" alt="">
                                สร้างคอร์สใหม่
                            </div>
                        </a>
                    @endif
                </div>
            </form>
            <div class="flex flex-col gap-y-8">
                @if ($isLecturer)
                    @foreach ($managedCourses as $course)
                        <x-course-card id="{{ $course->id }}" title="{{ $course['title'] }}"
                            description="{{ $course->description }}"
                            author="{{ $course->lecturer->first_name . ' ' . $course->lecturer->last_name }}"
                            progress="{{ 0.0 }}" src="{{ $course['cover_image_src'] }}"
                            href="{{ $course['href'] }}" color="{{ $colors[$loop->index % 3] }}"
                            primaryColor="{{ $primaryColor[$loop->index % 3] }}"
                            shadowColor="{{ $shadowColor[$loop->index % 3] }}" />
                    @endforeach
                @else
                    <div class="flex flex-col gap-y-8">
                        @foreach ($enrolledCourses as $course)
                            <x-course-card id="{{ $course['id'] }}" title="{{ $course['title'] }}"
                                description="{{ $course['description'] }}" author="{{ $course['author'] }}"
                                src="{{ $course['cover_image_src'] }}" progress="{{ $course['progress'] / 100 }}"
                                href="{{ $course['href'] }}" color="{{ $colors[$loop->index % 3] }}"
                                primaryColor="{{ $primaryColor[$loop->index % 3] }}"
                                shadowColor="{{ $shadowColor[$loop->index % 3] }}" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="fixed col-span-3 2xl:max-w-xs  max-w-64 right-12">
            <div class=" font-noto-thai relative ">
                <div class="max-w-full h-fit shadow-lg py-12 border-l-2 rounded-xl">
                    <div class="flex items-baseline px-8">
                        <h2 class="text-xl font-bold text-[#4369A2] ">
                            คอร์สน่าสนใจ
                        </h2>
                        <a class="ml-auto text-sm text-[#9CD0FD] font-semibold" href="/#all-course">
                            ดูทั้งหมด
                        </a>
                    </div>
                    <ul class="list-group flex flex-col gap-y-3 mt-6 pb-10 border-b-2 px-8">
                        @foreach ($popularCourses as $key => $course)
                            <li class="flex gap-x-2 text-sm font-semibold text-[#6F7881] ">
                                <div class="text-sm font-semibold text-[#6F7881]">
                                    {{ $key + 1 }}.
                                </div>
                                <a href="/learn/{{ $course['href'] }}">
                                    <div class="flex flex-col">
                                        <h5>{{ $course['title'] }} </h5>
                                        <span class="text-sm font-medium text-[#C1C7CE]">
                                            สอนโดย
                                            {{ $course->lecturer->first_name . ' ' . $course->lecturer->last_name }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="px-8 py-6 space-y-6 ">
                        <div class="flex flex-col items-center gap-y-1">
                            <h3 class="font-semibold text-[#2A638A]">
                                โปรไฟล์
                            </h3>
                            <div class="w-28 h-28 mt-4 rounded-full overflow-hidden"><img class="object-fill"
                                    src="{{ $user->profile_image_src ? $user->profile_image_src : asset('images/icons/DefaultPortrait.jpg') }}"
                                    alt="profile portriat"></div>
                            <h3 class="font-semibold text-[#2A638A] mt-2">
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </h3>
                            <span class="text-[#B8C8D9] text-xs text-center">
                                {{ $user->academicInfo->institute }}
                            </span>
                            <span class="text-[#B8C8D9] text-xs text-center">
                                {{ $user->academicInfo->school }}
                            </span>

                            <span class="text-[#B8C8D9] text-xs font-semibold text-center mt-2">
                                แต้มสะสม: {{ number_format($user->points) }} แต้ม
                            </span>
                        </div>

                        @if (!$isLecturer)
                            <div class="w-full">
                                <span class="text-[#B8C8D9] text-xs">
                                    ความคืบหน้า
                                </span>
                                <div class="flex items-center gap-x-4">
                                    <div class="flex w-4/5 h-3 bg-[#C7D3EB] rounded-full overflow-hidden"
                                        role="progressbar" aria-valuenow="{{ $avg_progress * 100 }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-[#47B2FF] text-xs text-white text-center whitespace-nowrap transition duration-500"
                                            style="width: {{ $avg_progress * 100 }}%"></div>
                                    </div>
                                    <span class="text-[#A8ACAC]">
                                        {{ $avg_progress * 100 }}%
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-left_side_layout>
