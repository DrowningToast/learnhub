<nav class="w-full flex justify-between items-center px-8 py-5 fixed top-0 bg-white drop-shadow-lg z-40">
    <div class="flex items-center">
        <a href="/" class="text-4xl font-bold font-beth text-[#2560B4] flex items-center -mt-1">LearnHub</a>
    </div>
    <div class="flex items-cetner gap-x-10 font-noto-thai">
        <a href="/" class="text-[#060732] flex items-center font-bold">หน้าหลัก</a>
        <a href="#all-course" class="text-[#565D6D] flex items-center">คอร์สทั้งหมด</a>
        @auth
            @if (auth()->user()->role->value == 'LEARNER')
                <a href="/learn" class="text-[#565D6D] flex items-center">คอร์สของฉัน</a>
            @elseif (auth()->user()->role->value == 'LECTURER')
                <a href="/learn" class="text-[#565D6D] flex items-center">จัดการคอร์ส</a>
            @elseif (auth()->user()->role->value == 'MODERATOR')
                <a href="/moderator" class="text-[#565D6D] flex items-center">หน้าจัดการสำหรับผู้ดูแล</a>
            @endif
        @endauth
        <div class="flex items-center gap-x-3 relative">
            @auth
                <img src="{{ auth()->user()->profile_image_src }}" alt="profile image" class="w-10 rounded-full">
                <p>|</p>
                <a href="/logout" class="text-[#2A638A] font-medium">ออกจากระบบ</a>
            @else
                <a href="/login" class="bg-[#2A638A] text-white px-8 py-2 rounded-lg">เข้าสู่ระบบ</a>
            @endauth
        </div>
    </div>
</nav>
