<div class="border border-[#E0E2EA] flex flex-col p-5 rounded-md bg-white gap-y-5">
    <img src="/img/courseBanner.webp" alt="Course Banner" class="rounded-xl">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-x-3 w-fit">
            <img src="/img/sila.webp" alt="Lecturer Profile" class="w-3/12">
            <p class="text-[#6F7979]">ศิลา ภักดีวงศ์</p>
        </div>
        <div class="bg-[#D4E3FF] text-[#235B9C] font-bold text-base text-nowrap px-3 py-4 rounded-xl">เทคโนโลยีสารสนเทศ</div>
    </div>
    <div class="px-2">
        <p class="font-bold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt inventore animi cumque earum hic fuga.</p>
    </div>
    <div class="flex justify-between px-2">
        <div class="flex gap-x-1 items-center">
            <x-bi-clock class="text-blue-800 mb-1"/>
            <p class="text-[#6F7979]">8 ชั่วโมง 45 นาที</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <x-bi-book class="text-blue-800 mb-1"/>
            <p class="text-[#6F7979]">27 Lectures</p>
        </div>
    </div>
    <div class="bg-[#D4E3FF] flex justify-between items-center rounded-xl p-5 font-bold text-lg">
        <p>$500.00</p>
        <div class="flex gap-x-1 items-center">
            <p>1.00</p>
            <div class="flex gap-x-1 items-center mb-1">
                @php
                    $i = 0;
                @endphp
                @while ($i < 5)
                    @if ($i > 0 && $i < 1)
                        @if ($i > 0.5)
                        @endif
                        @endif
                        <x-heroicon-s-star class="bg-gradient-to-r from-yellow-400 from-50% to-white to-50% bg-clip-content text-transparent w-6" />
                    {{-- <x-heroicon-s-star class="text-yellow-400 w-6" /> --}}
                    @php
                        $i++;
                    @endphp
                @endwhile
            </div>
        </div>
    </div>
</div>
