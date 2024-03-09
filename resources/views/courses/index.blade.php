<?php
    $courses = [
        [
            'title' => 'Python Programming ฉบับคนไม่เคยเขียนโปรแกรม',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti.',
            'author' => 'John Doe',
            'src' => 'https://www.udacity.com/blog/wp-content/uploads/2020/12/Python-Tutorial_Blog-scaled.jpeg',
            'progress' => 0.5,
            'href' => '1'
        ],
        [
            'title' => 'Python Programming ฉบับคนไม่เคยเขียนโปรแกรม',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti.',
            'author' => 'John Doe',
            'src' => 'https://www.udacity.com/blog/wp-content/uploads/2020/12/Python-Tutorial_Blog-scaled.jpeg',
            'progress' => 0.5,
            'href' => '1'
        ],
        [
            'title' => 'Python Programming ฉบับคนไม่เคยเขียนโปรแกรม',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti.',
            'author' => 'John Doe',
            'src' => 'https://www.udacity.com/blog/wp-content/uploads/2020/12/Python-Tutorial_Blog-scaled.jpeg',
            'progress' => 0.5,
            'href' => '1'
        ],
        [
            'title' => 'Python Programming ฉบับคนไม่เคยเขียนโปรแกรม',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti.',
            'author' => 'John Doe',
            'src' => 'https://www.udacity.com/blog/wp-content/uploads/2020/12/Python-Tutorial_Blog-scaled.jpeg',
            'progress' => 0.5,
            'href' => '1'
        ]
    ];

    $suggested = [
        [
            "title" => "Python Programming ฉบับคนไม่เคยเขียนโปรแกรม",
            "author" => "John Doe",
        ],[
            "title" => "Python Programming ฉบับคนไม่เคยเขียนโปรแกรม",
            "author" => "John Doe",
        ],[
            "title" => "Python Programming ฉบับคนไม่เคยเขียนโปรแกรม",
            "author" => "John Doe",
        ],[
            "title" => "Python Programming ฉบับคนไม่เคยเขียนโปรแกรม",
            "author" => "John Doe",
        ],[
            "title" => "Python Programming ฉบับคนไม่เคยเขียนโปรแกรม",
            "author" => "John Doe",
        ]

    ]
?>

@vite('resources/css/app.css')

<section class="grid grid-cols-4 rounded-xl bg-white">
    <div class="col-span-3 flex flex-col gap-y-6 px-12 py-16">
        <h1 class="text-5xl font-bold text-[#4369A2] font-noto-thai">
            คอร์สของฉัน
        </h1>
        <form class="space-y-4">
            <div class="w-auto h-auto relative overflow-hidden rounded-2xl">
                <input class="w-full rounded-2xl px-4 py-6 border-2 border-gray-200" type="text" placeholder="ค้นหา...">
                <buton>
                    <img src={{asset('images/icons/magnify.png')}} class="absolute top-1/2 right-4 transform -translate-y-1/2 w-6 h-6 z-10" alt="">
                </buton>
                <div class="w-20 from-[#00476C] to-[#235B9C] bg-gradient-to-b absolute -inset-y-24 -right-5 transform -rotate-45">
                </div>
                <div class="w-20 from-[#3D6EB3] to-[#B4C8E9] bg-gradient-to-t absolute -inset-y-24 -right-5 transform rotate-45 opacity-60">
                </div>
            </div>
            <div class="flex items-center gap-x-4">
                <span class="text-xl font-semibold text-[#6F7979]">filter by</span>
                <select class="rounded-full bg-[#E2EEFB] text-[#7F92B1] px-4 py-2 border-r-8 border-transparent" name="genere">
                    <option value="all">All</option>
                    <option value="programming">Programming</option>
                    <option value="design">Design</option>
                    <option value="marketing">Marketing</option>
                    <option value="business">Business</option>
                </select>
                <select class="rounded-full bg-[#E2EEFB] text-[#7F92B1] px-4 py-2 border-r-8 border-transparent" name="time">
                    <option value="latest">Latest</option>
                    <option value="oldest">Oldest</option>
                </select>
             </div>
        </form>
         <div class="flex flex-col gap-y-8">
            @foreach ($courses as $course)
                <x-CourseCard 
                    title="{{$course['title']}}"
                    description="{{$course['description']}}"
                    author="{{$course['author']}}"
                    src="{{$course['src']}}"
                    progress="{{$course['progress']}}"
                    href="{{$course['href']}}"
                />
            @endforeach
         </div>
    </div>
    <div class="rounded-xl shadow-lg px-8 py-16 font-noto-thai">
        <div class="flex items-baseline">
            <h2 class="text-xl font-bold text-[#4369A2] ">
                คอร์สน่าสนใจ
            </h2>
            <a class="ml-auto text-sm text-[#9CD0FD] font-semibold" href="#">
                ดูทั้งหมด
            </a>
        </div>
           <ul class="list-group flex flex-col gap-y-3 mt-6">
                @foreach ($suggested as $key=>$course)
                    <li class="flex gap-x-2 text-sm font-semibold text-[#6F7881]">
                        <div class="text-sm font-semibold text-[#6F7881]">
                            {{$key+1}}.
                        </div>
                        <div class="flex flex-col">
                            <h5>{{$course['title']}} </h5>
                            <span class="text-sm font-medium text-[#C1C7CE]">
                                สอนโดย {{$course['author']}}
                            </span>
                        </div>
                    </li>
                @endforeach
           </ul>
    </div>
</section>