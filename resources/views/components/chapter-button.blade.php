<div class="relative overflow-hidden flex items-center gap-x-6 px-9 py-5 rounded-3xl {{$done ? "text-white bg-[#6196C0]" : "text-black"}} border-[1px] border-[#DBE3EE]">
    @if ($done)
        <div class="absolute left-7 inset-y-0">
            <div class="absolute w-24 left-12 inset-y-0 bg-[#72A8CF] rotate-45 rounded-xl">
            </div>
            <div class="absolute w-24 left-4 inset-y-0 bg-[#6196C0] rotate-45 rounded-xl">
            </div>
            <div class="absolute w-24 -left-4 inset-y-0 bg-[#72A8CF] rotate-45 rounded-xl">
            </div>
            <div class="absolute w-24 -left-12 inset-y-0 bg-[#6196C0] rotate-45 rounded-xl">
            </div>
            <div class="absolute w-24 -left-20 inset-y-0 bg-[#72A8CF] rotate-45 rounded-xl">
            </div>
            <div class="absolute w-24 -left-28 inset-y-0 bg-[#6196C0] rotate-45 rounded-xl">
            </div>
        </div>
    @endif
    <img src={{ asset('/images/icons/book_color.png') }} class="w-14 h-14 z-10" />
    <span class="text-xl z-10">
        <span class="font-semibold">
            Chapter {{ $chapter }} :
        </span>
        {{
            $title
        }}
    </span>
    <div class="h-12 ml-auto">
        @if ($done)
            <div class="flex justify-center items-center gap-x-4 rounded-xl w-64 h-full bg-[#CBE6FF]/70">
                <img src="{{asset('/images/icons/blue-check.png')}}" alt="">
                <span class="text-sm font-bold">คุณเรียนบทนี้เสร็จสิ้นแล้ว!</span>
            </div>
        @else
           <div class="flex justify-center items-center gap-x-4 px-6 rounded-xl w-64 h-full bg-[#EBEEF3]">
                <x-heroicon-s-clock class="w-7 h-7" />
                <span class="text-sm font-medium text-nowrap">{{$durationInMinutes}} นาที</span>
           </div>
        @endif
    </div>
    <a href="{{asset('/learn/' . $courseId . "/" . $chapterId)}}">
        <x-zondicon-arrow-right  class="w-5 h-5" />
    </a>
</div>