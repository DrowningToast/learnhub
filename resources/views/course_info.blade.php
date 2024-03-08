@php
    $title = 'Python Programming ฉบับคนไม่เคยเขียนโปรแกรม';
    $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor';
    $rating = 1.5;
    $enrolled_count = 9999;
    $owned = false;
    $url = "https://www.youtube.com/embed/_uQrJ0TkZlc?si=R97Wf3dxJEVBTkgx";

    $selected_tab = $_GET['tab'] ?? "description"
@endphp

<html class="font-noto-thai">
    @vite('resources/css/app.css')
    
    <section class="p-14 grid grid-cols-2 gap-x-24 from-[#2A638A] to-[#0B1A24] bg-gradient-to-r">
        <div class="flex flex-col gap-y-6 text-white">
            <div class="space-y-1">
                <h1 class="text-4xl font-bold leading-relaxed whitespace-preline" >{{ $title }}</h1>
                <h3 class="text-xl font-bold text-[#D4E4F6]">
                    {{ $description }}
                </h3>
            </div>
            <div class="flex items-baseline gap-x-4">
                <span>{{$rating}}</span>
                <div class="flex items-baseline gap-x-1">
                    @for ($i = 0; $i < round($rating); $i++)
                        <img src="{{ asset('assets/star-2.png') }}" alt="star" class="w-4 h-4">
                    @endfor
                    @for ($i = 0; $i < 5- round($rating); $i++)
                        <img src="{{ asset('assets/star-1.png') }}" alt="star" class="w-4 h-4">                    
                    @endfor
                </div>
                <span>
                    ({{ $enrolled_count }} คนกำลังเรียนอยู่!)
                </span>
            </div>
            <div class="mt-6">
                <button class="bg-white rounded-2xl text-[#2A638A] font-bold px-24 py-3 text-xl">
                    ซื้อเลย
                </button>
            </div>
        </div>
        <div class="grid place-items-center"><iframe title="course preview" class="w-full h-full rounded-xl" src="{{$url}}" allowfullscreen></iframe></div>
    </section>
    
    <section class="p-14 grid grid-cols-3 gap-x-9">
        <article class="col-span-2">
            <div class="flex gap-x-6 text-xl font-semibold text-[#A3ACB6]">
                <a class="text-[#2A638A] border-b-4 border-[#2A638A] pb-2" href="#">
                    รายละเอียด
                </a>
                <a href="#">
                    สิ่งที่จะได้รับ
                </a>
                <a href="#">
                    ประกาศนียบัตร
                </a>
                <a href="#">
                    วิธีการชำระเงิน
                </a>
    
            </div>
            <div class="border-t-[1px] border-[#A3ACB6]">
                <h4>
                    
                </h4>
            </div>
        </article>
    </section>
</html>