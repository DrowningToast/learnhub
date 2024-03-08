@php
    $title = 'Python Programming ฉบับคนไม่เคยเขียนโปรแกรม';
    $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor';
    $rating = 1.5;
    $enrolled_count = 9999;
    $review_count = 999;
    $owned = false;
    $url = "https://www.youtube.com/embed/_uQrJ0TkZlc?si=R97Wf3dxJEVBTkgx";

    $selected_tab = $_GET['view'] ?? "description";

    $chapters = [
        [
            "title" => "ออกแบบเว็บด้วย HTML",
            "duration" => "10"
        ],
        [
            "title" => "ออกแบบเว็บด้วย HTML",
            "duration" => "360"
        ],
        [
            "title" => "ออกแบบเว็บด้วย HTML",
            "duration" => "120"
        ],
        [
            "title" => "ออกแบบเว็บด้วย HTML",
            "duration" => "61"
        ]
    ];

    $reviews = [
        [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],      [
            "name" => "Supratouch S.",
            "date" => mktime(0, 0, 0, date("m")  , date("d"), date("Y")),
            "comment" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum assumenda doloribus officiis tempora rem totam fugiat minima autem nisi aperiam soluta et porro nam possimus, natus a culpa? Dolores, voluptas!",
            "rating" => 4.5
],     
    ]
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
                <a href="#">
                    <button class="bg-white rounded-2xl text-[#2A638A] font-bold px-24 py-3 text-xl">
                        ซื้อเลย
                    </button>
                </a>
            </div>
        </div>
        <div class="grid place-items-center"><iframe title="course preview" class="w-full h-full rounded-xl" src="{{$url}}" allowfullscreen></iframe></div>
    </section>

    <div class="p-14">
        <div class="grid grid-cols-3 gap-x-9 ">
            <div class="col-span-2 flex gap-x-8 text-xl font-semibold text-[#A3ACB6] border-b-[1px] border-[#A3ACB6]">
                <a href="?view=description"
                @if ($selected_tab == "description")
                    class="text-[#2A638A] pb-2 border-b-[2px] border-[#2A638A]"
                @endif
                >
                    รายละเอียด
                </a>
                <a href="?view=payment"
                @if ($selected_tab == "payment")
                    class="text-[#2A638A] pb-2 border-b-[2px] border-[#2A638A]"
                @endif
                >
                    วิธีการชำระเงิน
                </a>
            </div>
            <div class="flex gap-x-8 text-xl font-semibold text-[#A3ACB6] border-b-[1px] border-[#A3ACB6]">
                <span class="text-[#2A638A] pb-2">
                    ผู้สอน
                </span>
            </div>
        </div>
        <section class="grid grid-cols-3 gap-x-9">
            <article class="col-span-2">
                @if ($selected_tab == "description")
                <div class=" text-[#676767] py-6">
                    <h4 class="font-semibold">
                        คำอธิบายคอร์สออนไลน์
                    </h4>
                    <p>อุบัติเหตุต่าง ๆ ส่วนใหญ่มาจากความเสี่ยงและภัยอันตรายที่อยู่ภายในสถานประกอบการ หรือโรงงานอุตสาหกรรม หากหน่วยงานละเลยหรือไม่ให้ความสำคัญ ความเสี่ยงและภัยอันตรายเหล่านั้น จะเป็นต้นเหตุและทำให้เกิดอุบัติเหตุเกิดขึ้นได้ มาตรการการค้นหาสาเหตุโดยการใช้เครื่องมือการตรวจความปลอดภัย จะช่วยให้ทุกหน่วยงานรู้สาเหตุล่วงหน้า และนำมาหามาตรการแก้ไขและป้องกันได้ จึงเป็นแนวทางที่ดีที่สุดที่สถานประกอบการ หรือโรงงานอุตสาหกรรมต่าง ๆ ควรที่จะนำมาปรับใช้</p>
                    <br>
                    <h4 class="font-semibold">
                        ประโยชน์ที่ผู้เรียนรู้จะได้รับ
                    </h4>
                    <ul class="list-disc list-inside">
                        <li>มีความรู้พื้นฐาน หลักการ และขั้นตอนวิธีการตรวจความปลอดภัย</li>
                        <li>สามารถนำวิธีการตรวจความปลอดภัยในสถานประกอบการไปปฏิบัติได้อย่างถูกต้อง</li>
                    </ul>
                    <br>
                    <h4 class="font-semibold">
                        คอร์สนี้เหมาะสำหรับ
                    </h4>
                    <ul class="list-disc list-inside">
                        <li>เจ้าของกิจการ,ผู้บริหารทุกระดับ,หัวหน้างาน,พนักงาน</li>
                        <li>เจ้าหน้าที่ความปลอดภัยในการทำงานทุกระดับ</li>
                        <li>คณะกรรมการความปลอดภัยตามกฎหมาย</li>
                        <li>ผู้ที่ได้รับมอบหมายให้เป็นผู้ทำหน้าที่ในการตรวจความปลอดภัย</li>
                        <li>หรือผู้ที่สนใจทั่วไป สามารถเข้าอบรมเรียนรู้ในหลักสูตรนี้ได้</li>
                    </ul>
                    <br>
                </div>
                <div class="space-y-6">
                    <span class="font-semibold text-4xl text-[#2A638A]">เนื้อหาหลักสูตร</span>
                    <div class="flex flex-col">
                        @foreach ($chapters as $chapter)
                            <div class="flex gap-x-4 border-[1px] border-gray-300 px-6 py-4">
                                <img src="{{asset('assets/books.png')}}" alt="books icon" class="w-6 h-6">
                                <h5>
                                    {{ $chapter['title'] }}
                                </h5>
                                <span class="ml-auto">
                                    {{str_pad(floor($chapter['duration'] / 60), 2, "0", STR_PAD_LEFT)}}:{{str_pad($chapter['duration'] % 60, 2, "0", STR_PAD_LEFT)}} ชั่วโมง
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if ($selected_tab == "payment")
                <div class=" text-[#676767] py-6">
                    placeholdr ofr payment meyhods
                </div>
                @endif
            </article>
            <div class="col-span-3 mt-8">
                <article class="flex flex-col">
                    <div class="text-[#676767] py-6 flex items-stretch gap-x-2">
                        <img src="{{ asset('assets/star-2.png') }}" alt="star" class="w-6 h-6"> 
                        <span class="text-2xl font-bold text-[#2D2F31]">รีวิวจากผู้เรียน ({{ count($reviews) }} รีวิว)</span>
                    </div>
                    <div class="grid grid-cols-3 gap-x-6">
                        @foreach ($reviews as $review)
                        <div class="flex flex-col gap-y-4 border-t-[1px] border-[#D1D7DB] py-6">
                                <div class="flex gap-x-3">
                                    <div class="w-14 h-14 rounded-full bg-[#2D2F31] text-white text-xl font-bold grid place-items-center">
                                        <span>{{explode(" ", $review['name'])[0][0]}}{{explode(" ", $review['name'])[1][0]}}</span>
                                    </div>
                                    <div class="flex flex-col justify-evenly">
                                        <span class="font-semibold">{{explode(" ", $review['name'])[0]}} {{explode(" ", $review['name'])[1][0]}}.</span>
                                        <div class="flex gap-x-2 items-baseline">
                                            <div class="flex items-baseline gap-x-1">
                                                @for ($i = 0; $i < round($review['rating']); $i++)
                                                    <img src="{{ asset('assets/star-2.png') }}" alt="star" class="w-3 h-3">
                                                @endfor
                                                @for ($i = 0; $i < 5- round($review['rating']); $i++)
                                                    <img src="{{ asset('assets/star-1.png') }}" alt="star" class="w-3 h-3">                    
                                                @endfor
                                            </div>
                                            <span class="text-xs text-[#DB8383]">
                                                เมื่อวันที่ {{ date("Y-m-d", $review['date']) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm">{{$review['comment']}}</p>                            
                                </div>
                            </div>
                            @endforeach 
                    </div>
                </article>
            </div>
        </section>
    </div>
</html>