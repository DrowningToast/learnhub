@vite('resources/css/app.css')
<main class="font-noto-thai p-12 px-14">

    
    <form method="POST" class="grid grid-cols-2 gap-x-12 gap-y-4">
        @csrf
        <div class="flex col-span-2">
            <h1 class="text-5xl font-semibold text-[#2A638A]">
                Edit Profile
            </h1>
            <div class="w-28 h-28 rounded-full overflow-hidden ml-auto border-2">
                <img src="{{$user->profile_image_src}}" alt="Profile portrait picture">
            </div>
        </div>
        <div class="flex flex-col gap-y-1">
            <label class="font-semibold text-2xl text-[#1C1C1C]" for="first_name">ชื่อจริง</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="first_name" placeholder="สมชาย">
        </div>
       <div class="flex flex-col gap-y-1">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="last_name">นามสกุล</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="last_name" placeholder="สมศรี">
       </div>
        <div class="flex flex-col gap-y-1 col-span-2">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="email">อีเมล</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="email" placeholder="john@doe.com">
        </div>
       <div class="flex flex-col gap-y-1 col-span-2">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="phone">เบอร์โทรศัพท์</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="phone" placeholder="0812345678">
       </div>
       <div class="flex flex-col gap-y-1">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="year">ชั้นปี/ระดับการศึกษา</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="year" placeholder="ปีที่ 2">
       </div>
        <div class="flex flex-col gap-y-1">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="institute">สถาบัน/มหาวิทยาลัย</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="institute">
        </div>
        <div class="flex flex-col gap-y-1">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="campus">วิทยาเขต</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="วิทยาเขต">
        </div>
       <div class="flex flex-col gap-y-1">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="school">สถานศึกษา</label>
            <input class="rounded-2xl border-2 p-3" type="text" name="school">
       </div>
       {{-- <div class="flex flex-col gap-y-1 col-span-2">
            <label class="font-semibold text-2xl text-[#1C1C1C]"for="password">รหัสผ่าน</label>
            <input class="rounded-2xl border-2 p-3" type="password" name="password">
       </div> --}}
        <div class="mt-2 space-x-2">
            <a href="{{url()->previous()}}"><button type="button" class="text-[#2A638] bg-[#E9F2FC] font-semibold rounded-2xl px-10 py-2">ยกเลิก</button></a>
            <button class="text-[#FFFFFF] bg-[#2A638A] font-semibold rounded-2xl px-10 py-2" type="submit">บันทึก</button>
        </div>
    </form>
</main>