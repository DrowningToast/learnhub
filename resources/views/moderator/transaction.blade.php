<?php
$lecturer = [
    [
        'id' => 1,
        'imgSrc' => '/img/sila.webp',
        'name' => 'ศิลา ภักดีวงศ์',
        'money' => 5000,
        'bankName' => 'SCB',
        'accountNumber' => '123-4-56789-0',
        'status' => 'SUCCESS',
    ],
    [
        'id' => 2,
        'name' => 'ศิลา ภักดีวงศ์',
        'imgSrc' => '/img/sila.webp',
        'money' => 5000,
        'bankName' => 'SCB',
        'accountNumber' => '123-4-56789-0',
        'status' => 'WAITING',
    ],
    [
        'id' => 2,
        'name' => 'ศิลา ภักดีวงศ์',
        'imgSrc' => '/img/sila.webp',
        'money' => 5000,
        'bankName' => 'SCB',
        'accountNumber' => '123-4-56789-0',
        'status' => 'CANCEL',
    ],
];
?>

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
                จัดการคำขอถอนเงิน
            </h1>
            <form class="space-y-4 w-full">
                <div class=" max-h-16 relative overflow-hidden rounded-2xl w-full focus-within:shadow-lg duration-200">
                    <input class="w-full rounded-2xl px-4 py-3 border-2 border-gray-200 h-16 outline-none text-lg"
                        type="text" placeholder="ค้นหาผู้สอน..." name="name" value="{{ $oldInputValue }}">
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
                    <span class="text-xl font-semibold text-[#6F7979]">จัดเรียงตาม: </span>
                    <select class="select-blue" name="statusId">
                        <option value="ALL" {{ app('request')->input('statusId') === 'ALL' ? 'selected' : '' }}>
                            ทั้งหมด
                        </option>
                        <option value="1" {{ app('request')->input('statusId') === '1' ? 'selected' : '' }}>
                            กำลังดำเนินการ</option>
                        <option value="2" {{ app('request')->input('statusId') === '2' ? 'selected' : '' }}>สำเร็จ
                        </option>
                        <option value="3" {{ app('request')->input('statusId') === '3' ? 'selected' : '' }}>
                            ไม่สำเร็จ</option>
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
                @foreach ($transactions as $l)
                    <x-transaction-card pid="{{ $l->id }}"
                        imgSrc="{{ $l->user->profile_image_src ? $l->user->profile_image_src : asset('images/icons/DefaultPortrait.jpg') }}"
                        name="{{ $l->user->first_name . ' ' . $l->user->last_name }}" money="{{ $l->amount }}"
                        bankName="{{ $l->user->bankName }}" accountNumber="{{ $l->user->accountNumber }}"
                        status="{{ $l->status_id }}" />
                @endforeach
            </div>
        </div>
    </section>
</x-left_side_layout>
