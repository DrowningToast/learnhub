@php
    $selected_tab = $_GET['view'] ?? 'description';
@endphp

<x-white-navbar-layout>
    <div>
        <section
            class="p-14 py-20 px:24 2xl:px-36 grid grid-cols-2 gap-x-24 from-[#2A638A] to-[#0B1A24] bg-gradient-to-r items-center">
            <div class="flex flex-col gap-y-6 text-white justify-center">
                <div class="space-y-1">
                    <h1 class="text-4xl font-bold leading-relaxed whitespace-preline">{{ $title }}</h1>
                    <h3 class="text-xl font-bold text-[#D4E4F6]">
                        {{ strlen($description) >= 750 ? substr($description, 0, 750) . '...' : $description }}
                    </h3>
                </div>
                <div class="flex items-baseline gap-x-4">
                    <span>{{ $rating }}</span>
                    <div class="flex items-baseline gap-x-1">
                        @for ($i = 0; $i < round($rating); $i++)
                            <img src="{{ asset('assets/star-2.png') }}" alt="star" class="w-4 h-4">
                        @endfor
                        @for ($i = 0; $i < 5 - round($rating); $i++)
                            <img src="{{ asset('assets/star-1.png') }}" alt="star" class="w-4 h-4">
                        @endfor
                    </div>
                    <span>
                        ({{ $enrolled_count }} คนกำลังเรียนอยู่!)
                    </span>
                </div>
                <div class="mt-6">
                    @if ($already_owned)
                        <div class="flex flex-col gap-y-2">
                            <span class="text-white/60">คุณเป็นเจ้าของคอร์สนี้แล้ว</span>
                            <a href="#">
                                <button class="bg-green-600 rounded-2xl text-white font-bold px-24 py-3 text-xl">
                                    เข้าสู่คลาสเรียน
                                </button>
                            </a>
                        </div>
                    @else
                        <a href="#">
                            <button class="bg-white rounded-2xl text-[#2A638A] font-bold px-24 py-3 text-xl">
                                ซื้อเลย
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            <div class="grid place-items-end"><img title="course preview" class="w-[70%] h-auto object-cover rounded-xl"
                    src="{{ $cover_image_src }}"></div>
        </section>

        <div class="p-14 bg-white px:24 2xl:px-36">
            <div class="grid grid-cols-3 gap-x-24 2xl:gap-x-36 ">
                <div
                    class="col-span-2 flex gap-x-8 text-xl font-semibold text-[#A3ACB6] border-b-[1px] border-[#A3ACB6]">
                    <a href="?view=description"
                        @if ($selected_tab == 'description') class="text-[#2A638A] pb-2 border-b-[2px] border-[#2A638A]" @endif>
                        รายละเอียด
                    </a>
                    <a href="?view=payment"
                        @if ($selected_tab == 'payment') class="text-[#2A638A] pb-2 border-b-[2px] border-[#2A638A]" @endif>
                        วิธีการชำระเงิน
                    </a>
                </div>
                <div
                    class="flex gap-x-24 2xl:gap-x-36 text-xl font-semibold text-[#A3ACB6] border-b-[1px] border-[#A3ACB6]">
                    <span class="text-[#2A638A] pb-2">
                        ผู้สอน
                    </span>
                </div>
            </div>
            <section class="grid grid-cols-3 gap-x-24 2xl:gap-x-36">
                <article class="col-span-2">
                    @if ($selected_tab == 'description')
                        <div class=" text-[#676767] py-6">
                            <h4 class="font-semibold text-3xl text-[#2A638A] mb-4">
                                คำอธิบายคอร์สออนไลน์
                            </h4>
                            {{ $description }}
                            <br>
                        </div>
                        <div class="space-y-6 mt-6">
                            <span class="font-semibold text-3xl text-[#2A638A]">เนื้อหาหลักสูตร</span>
                            <div class="flex flex-col">
                                @foreach ($chapters as $chapter)
                                    <div class="flex gap-x-4 border-[1px] border-gray-300 px-6 py-4">
                                        <img src="{{ asset('assets/books.png') }}" alt="books icon" class="w-6 h-6">
                                        <h5>
                                            {{ $chapter['title'] }}
                                        </h5>
                                        <span class="ml-auto">
                                            {{ str_pad(floor($chapter['durationInMinutes'] / 60), 2, '0', STR_PAD_LEFT) }}:{{ str_pad($chapter['durationInMinutes'] % 60, 2, '0', STR_PAD_LEFT) }}
                                            ชั่วโมง
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($selected_tab == 'payment')
                        <div class=" text-[#676767] py-6">
                            [PH] Payment method demo
                        </div>
                    @endif
                </article>
                <article>
                    <div class="grid grid-cols-3 px-4 py-6 gap-x-4">
                        <img class="rounded-full aspect-square" src={{ $lecturer['profile_image_src'] }} />
                        <div class="col-span-2 flex flex-col justify-center gap-y-2">
                            <span class="text-xl font-semibold">{{ $lecturer['first_name'] }}
                                {{ $lecturer['last_name'] }}</span>
                            <div class="flex flex-col">
                                <span class="text-sm text-[#262323]">{{ $lecturer['affiliate'] }}</span>
                                <span class="text-sm text-[#555555]">เจ้าของ {{ $lecturer['courses'] }} คอร์ส</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mt-12 flex gap-x-8 text-xl font-semibold text-[#A3ACB6] border-b-[1px] border-[#A3ACB6]">
                        <span class="text-[#2A638A] pb-2">
                            คอร์สที่น่าสนใจอื่นๆ
                        </span>
                    </div>
                    <div class="flex flex-col gap-y-8 mt-6">
                        @foreach ($suggestions as $suggestion)
                            <a href={{ $suggestion['id'] }}>
                                <img src={{ $suggestion['cover_image_src'] }} alt="course image"
                                    class="w-full h-48 object-cover rounded-xl">
                                <div class="flex flex-col gap-y-2 mt-4">
                                    <span
                                        class="text-lg font-semibold text-[#2A638A]">{{ $suggestion['title'] }}</span>
                                    <span
                                        class="text-sm text-[#676767]">{{ $suggestion['lecturer']['first_name'] . ' ' . $suggestion['lecturer']['last_name'] }}</span>
                                </div>
                            </a>
                        @endforeach
                        <div>
                        </div>
                    </div>
                </article>
                <div class="col-span-3 mt-8 " id="reviews">
                    <article class="flex flex-col">
                        <div class="text-[#676767] py-6 flex items-stretch gap-x-2">
                            <img src="{{ asset('assets/star-2.png') }}" alt="star" class="w-6 h-6">
                            <span class="text-2xl font-bold text-[#2D2F31]">รีวิวจากผู้เรียน ({{ $reviews_count }}
                                รีวิว)</span>
                        </div>
                        <div class="grid grid-cols-3 gap-x-10">
                            @foreach ($reviews as $review)
                                <div class="flex flex-col gap-y-4 border-t-[1px] border-[#D1D7DB] py-6">
                                    <div class="flex gap-x-3">
                                        <div
                                            class="w-14 h-14 rounded-full bg-[#2D2F31] text-white text-xl font-bold grid place-items-center">
                                            <span>{{ $review['user']['first_name'][0] }}{{ $review['user']['last_name'][0] }}</span>
                                        </div>
                                        <div class="flex flex-col justify-evenly">
                                            <span class="font-semibold">{{ $review['user']['first_name'][0] }}
                                                {{ $review['user']['last_name'][0] }}.</span>
                                            <div class="flex gap-x-2 items-baseline">
                                                <div class="flex items-baseline gap-x-1">
                                                    @for ($i = 0; $i < round($review['rating']); $i++)
                                                        <img src="{{ asset('assets/star-2.png') }}" alt="star"
                                                            class="w-3 h-3">
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - round($review['rating']); $i++)
                                                        <img src="{{ asset('assets/star-1.png') }}" alt="star"
                                                            class="w-3 h-3">
                                                    @endfor
                                                </div>
                                                <span class="text-xs text-[#DB8383]">
                                                    เมื่อวันที่ {{ date('Y-m-d', $review['updatedAt']) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm">{{ $review['comment'] }}</p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="mt-4">
                            {{ $reviews->links() }}
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</x-white-navbar-layout>
