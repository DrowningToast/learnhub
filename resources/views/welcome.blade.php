<x-whiteNavBarLayout>
    <div class="w-full min-h-screen font-noto-thai bg-[#F4F8FF]">
        {{-- navbar --}}
        <x-NavLanding />

        {{-- hero --}}
        <div
            class="bg-gradient-to-b from-[#7F92B1] from-10% to-[#FFF]/0 to-90% w-full min-h-screen flex justify-center items-center pt-14">
            <div class="grid grid-cols-2 w-3/4 gap-x-16">
                <div class="flex justify-center flex-col gap-y-5">
                    <div class="flex flex-col gap-y-5">
                        <h1 class="text-6xl font-bold">Lorem ipsum dolor sit amet.</h1>
                        <p class="text-lg">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, hic?</p>
                    </div>
                    <div class="flex items-center gap-x-5 ">
                        <a href="/register" class="bg-[#2A638A] text-white px-9 py-3 rounded-lg">ลงทะเบียน</a>
                        <a href="/login" class="text-[#060732] px-9 py-3 rounded-xl underline">เข้าสู่ระบบ</a>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <img src="/img/homework.webp" alt="hero-image" class="w-4/5">
                </div>
            </div>
        </div>

        {{-- section 2 --}}
        <div class="w-full min-h-screen flex justify-center items-center">
            <div class="bg-[#E2EEFB] rounded-xl w-11/12 py-24 px-16 flex flex-col gap-y-14">
                <div class="text-center flex flex-col gap-y-5">
                    <p class="text-2xl font-medium">Lorem, ipsum.</p>
                    <h1 class="text-5xl font-extrabold">Lorem, ipsum.</h1>
                </div>
                <div class="grid grid-cols-4 gap-x-10">
                    <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                        hoverImage="/img/features/sparkles_hover.webp" title="Lorem, ipsum."
                        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                        containerClass="hover:from-[#368DD2] hover:to-[#368DD2]/20"
                        childrenClass="from-[#368DD2] to-[#368DD2]/20" />

                    <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                        hoverImage="/img/features/sparkles_hover.webp" title="Lorem, ipsum."
                        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                        containerClass="hover:from-[#CB3737] hover:to-[#CB3737]/20"
                        childrenClass="from-[#CB3737] to-[#CB3737]/20" />

                    <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                        hoverImage="/img/features/sparkles_hover.webp" title="Lorem, ipsum."
                        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                        containerClass="hover:from-[#F5CC63] hover:to-[#F5CC63]/20"
                        childrenClass="from-[#F5CC63] to-[#F5CC63]/20" />

                    <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                        hoverImage="/img/features/sparkles_hover.webp" title="Lorem, ipsum."
                        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                        containerClass="hover:from-[#52B6B4] hover:to-[#52B6B4]/20"
                        childrenClass="from-[#52B6B4] to-[#52B6B4]/20" />

                </div>
            </div>
        </div>

        {{-- section 3 --}}
        <div class="w-full flex justify-center items-center mt-20 ">
            <div class="rounded-xl w-11/12 flex flex-col gap-y-7">
                <div class="flex justify-between">
                    <h1 class="text-5xl font-extrabold">คอร์สทั้งหมด</h1>
                    <div class="flex items-center text-xl bg-white rounded-lg px-2 py-1 shadow-[inset_1px_1px_8px_4px_rgba(0,0,0,0.1)]">
                        <input type="text" class="px-3 py-3 outline-none w-96 bg-transparent" placeholder="ค้นหาคอร์สของคุณ">
                        <button class="bg-[#D4E3FF] p-3 rounded-lg"><x-bi-search class="text-blue-800 text-2xl" /></button>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-8 bg-[#E2EEFB] px-8 py-5 rounded-lg">
                    <x-CourseButton>วิทยาศาสตร์</x-CourseButton>
                    <x-CourseButton>คณิตศาสตร์</x-CourseButton>
                    <x-CourseButton>ภาษาไทย</x-CourseButton>
                    <x-CourseButton>สังคมศึกษา</x-CourseButton>
                    <x-CourseButton>ภาษาอังกฤษ</x-CourseButton>
                    <x-CourseButton>เทคโนโลยีสารสนเทศ</x-CourseButton>
                </div>
                <div class="grid grid-cols-3 gap-x-14 gap-y-10">
                    <x-courseCard />
                    <x-courseCard />
                    <x-courseCard />
                    <x-courseCard />
                </div>
            </div>
        </div>
    </div>
</x-whiteNavBarLayout>
