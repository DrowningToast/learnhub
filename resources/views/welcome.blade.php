<x-whiteNavBarLayout>
    <div class="w-full min-h-screen font-noto-thai bg-[#F4F8FF]">
        {{-- hero --}}
        <div
            class="bg-gradient-to-b from-[#7F92B1] from-10% to-[#FFF]/0 to-90% w-full min-h-screen flex justify-center items-center ">
            <div class="grid grid-cols-2 w-10/12 gap-x-16">
                <div class="flex justify-center flex-col gap-y-5">
                    <div class="flex flex-col gap-y-5">
                        <h1 class="text-5xl font-bold">ปลดล็อกศักยภาพการเรียนรู้ของคุณ กับ <span
                                class="font-normal font-beth text-[#2560B4]">LearnHub</span></h1>
                        <p class="text-2xl">เติมเต็มความรู้ พัฒนาทักษะ กับคอร์สเรียนที่หลากหลาย</p>
                    </div>
                    <div class="flex items-center gap-x-5 ">
                        <a href="/login"
                            class="bg-[#2A638A] text-white px-9 py-3 rounded-lg font-semibold">เข้าสู่ระบบ</a>
                        <a href="/register"
                            class="text-[#2A638A] px-9 py-3 rounded-xl underline font-semibold">ลงทะเบียน</a>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <img src="/img/homework.webp" alt="hero-image" class="w-3/5">
                </div>
            </div>
        </div>

        {{-- section 2 --}}
        <div class="w-full min-h-[75svh] flex justify-center items-center">
            <div class="bg-[#E2EEFB] rounded-xl w-11/12 py-24 px-16 flex flex-col gap-y-14">
                <div class="text-center flex flex-col gap-y-3">
                    <p class="text-2xl font-medium">จุดเด่นของเว็บไซต์</p>
                    <h1 class="text-5xl font-extrabold font-beth text-[#2560B4]">LearnHub</h1>
                </div>
                <div class="grid grid-cols-4 gap-x-10">
                    <x-FeatureCard baseImage="/img/features/book_base.webp" hoverImage="/img/features/book_hover.webp"
                        title="เนื้อหาครบครัน" description="คอร์สเรียนออนไลน์หลากหลาย ตอบโจทย์ทุกความต้องการ"
                        containerClass="hover:from-[#368DD2] hover:to-[#368DD2]/20"
                        childrenClass="from-[#368DD2] to-[#368DD2]/20" />

                    <x-FeatureCard baseImage="/img/features/com_base.webp" hoverImage="/img/features/com_hover.webp"
                        title="เรียนรู้ได้ทุกที่ทุกเวลา" description="เข้าถึงได้ผ่านอุปกรณ์ต่างๆ สะดวกทุกที่ทุกเวลา"
                        containerClass="hover:from-[#CB3737] hover:to-[#CB3737]/20"
                        childrenClass="from-[#CB3737] to-[#CB3737]/20" />

                    <x-FeatureCard baseImage="/img/features/teacher_base.webp"
                        hoverImage="/img/features/teacher_hover.webp" title="คุณภาพสูง"
                        description="คอร์สเรียนจากผู้เชี่ยวชาญ เนื้อหาเข้มข้น เข้าใจง่าย"
                        containerClass="hover:from-[#F5CC63] hover:to-[#F5CC63]/20"
                        childrenClass="from-[#F5CC63] to-[#F5CC63]/20" />

                    <x-FeatureCard baseImage="/img/features/money_base.webp" hoverImage="/img/features/money_hover.webp"
                        title="ราคาประหยัด"
                        description="คุ้มค่า ใช้งานง่าย เหมาะกับทุกคน จ่ายเงินเพียงครั้งเดียว เรียนได้ตลอดชีพ"
                        containerClass="hover:from-[#52B6B4] hover:to-[#52B6B4]/20"
                        childrenClass="from-[#52B6B4] to-[#52B6B4]/20" />

                </div>
            </div>
        </div>

        {{-- section 3 --}}
        <div class="w-full flex justify-center items-center mt-36 bg-gradient-to-b from-[#F4F8FF] from-80% to-white to-95% scroll-mt-24"
            id="all-course">
            <div class="rounded-xl w-11/12 flex flex-col gap-y-7">
                <form action="/#all-course" method="get" class="flex flex-col gap-y-7">
                    @csrf
                    <div class="flex justify-between">
                        <h1 class="text-5xl font-extrabold">คอร์สทั้งหมด</h1>
                        <div
                            class="flex items-center text-xl bg-white rounded-lg px-2 py-1 shadow-[inset_1px_1px_8px_4px_rgba(0,0,0,0.1)]">
                            <input type="text" name="search-course"
                                class="px-3 py-3 outline-none w-96 bg-transparent"
                                value="{{ app('request')->input('search-course') }}"
                                placeholder="ค้นหาคอร์สที่เหมาะกับคุณ">
                            <button type="submit" class="bg-[#D4E3FF] p-3 rounded-lg"><x-bi-search
                                    class="text-blue-800 text-2xl" /></button>
                        </div>
                    </div>
                    <div
                        class="flex justify-center items-center gap-x-8 bg-[#E2EEFB] px-8 py-5 rounded-lg overflow-x-auto">
                        <x-CourseButton rvalue="1"
                            checked="{{ app('request')->input('filter-course') }}">วิทยาศาสตร์</x-CourseButton>
                        <x-CourseButton rvalue="2"
                            checked="{{ app('request')->input('filter-course') }}">คณิตศาสตร์</x-CourseButton>
                        <x-CourseButton rvalue="3"
                            checked="{{ app('request')->input('filter-course') }}">ภาษาไทย</x-CourseButton>
                        <x-CourseButton rvalue="4"
                            checked="{{ app('request')->input('filter-course') }}">สังคมศึกษา</x-CourseButton>
                        <x-CourseButton rvalue="5"
                            checked="{{ app('request')->input('filter-course') }}">ภาษาอังกฤษ</x-CourseButton>
                        <x-CourseButton rvalue="6"
                            checked="{{ app('request')->input('filter-course') }}">เทคโนโลยีสารสนเทศ</x-CourseButton>
                    </div>
                </form>
                <div class="grid grid-cols-4 gap-x-12 gap-y-12 mt-6">
                    @foreach ($courses as $course)
                        <x-SellCourseCard banner="{{ $course->cover_image_src }}" courseId="{{ $course->id }}"
                            lecturer="{{ $course->lecturer->first_name . ' ' . $course->lecturer->last_name }}"
                            lecProfile="{{ $course->lecturer->profile_image_src }}"
                            category="{{ $course->category_id }}"
                            description="{{ strlen($course->title) >= 50 ? substr($course->title, 0, 50) . '...' : $course->title }}"
                            duration="{{ $course->duration }}" lectures="{{ count($course->chapters) }}"
                            price="{{ $course->buy_price }}" rating="{{ floatval($course->rating) }}" />
                    @endforeach
                </div>

                {{ $courses->links() }}
            </div>
        </div>
    </div>

    {{-- section 4 --}}
    <div class="bg-white w-full min-h-[75svh] flex justify-center items-center pt-14">
        <div class="grid grid-cols-2 w-10/12 gap-x-20">
            <div class="flex justify-center flex-col gap-y-5">
                <div class="flex flex-col gap-y-10">
                    <h1 class="text-5xl font-bold"><span
                            class="font-normal font-beth text-[#2560B4] leading-[100px]">LearnHub</span>
                        มอบประสบการณ์การเรียนรู้ที่ดีที่สุดแก่คุณ</h1>
                    <p class="text-2xl">การเรียนรู้ออนไลน์ช่วยให้คุณสามารถเรียนรู้ได้ทุกที่ ทุกเวลา
                        โดยไม่จำเป็นต้องเดินทางไปยังสถาบันการศึกษาหรือห้องเรียนคุณสามารถเรียนได้ตามความสะดวกของตัวเองและกำหนดเวลาที่เหมาะสมด้วยตนเอง
                    </p>
                </div>
            </div>
            <div class="flex justify-center items-center relative">
                <div
                    class="w-full aspect-square bg-[#D4E3FF]/80 blur-3xl rounded-full absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-0">
                </div>
                <img src="/img/light-bulb.webp" alt="hero-image" class="w-3/5 z-10">
            </div>
        </div>
    </div>

    {{-- section 5 --}}
    <div
        class="w-full h-[75svh] bg-gradient-to-b from-white from-30% to-[#7F92B1] flex flex-col justify-center items-center px-14 gap-y-14">
        <h1 class="text-6xl font-bold">รีวิวจากผู้เรียน</h1>
        <div class="flex w-full gap-x-10">
            <x-CommentCard className="scale-[0.85]" imgSrc="{{ $top_review[1]['user']['profile_image_src'] }}"
                name="{{ $top_review[1]['user']['first_name'] }} {{ $top_review[1]['user']['last_name'] }}"
                courseName="{{ $top_review[1]['course']['title'] }}" comment="{{ $top_review[1]['comment'] }}"
                rating="{{ $top_review[1]['rating'] }}" />
            <x-CommentCard className="" imgSrc="{{ $top_review[0]['user']['profile_image_src'] }}"
                name="{{ $top_review[0]['user']['first_name'] }} {{ $top_review[0]['user']['last_name'] }}"
                courseName="{{ $top_review[0]['course']['title'] }}" comment="{{ $top_review[0]['comment'] }}"
                rating="{{ $top_review[0]['rating'] }}" />
            <x-CommentCard className="scale-[0.85]" imgSrc="{{ $top_review[2]['user']['profile_image_src'] }}"
                name="{{ $top_review[2]['user']['first_name'] }} {{ $top_review[2]['user']['last_name'] }}"
                courseName="{{ $top_review[2]['course']['title'] }}" comment="{{ $top_review[2]['comment'] }}"
                rating="{{ $top_review[2]['rating'] }}" />
        </div>
    </div>

    {{-- footer --}}
    <x-Footer className="bg-[#7F92B1]" />
</x-whiteNavBarLayout>
