<x-left_side_layout>
    <main class="font-noto-thai  ">
        <form action="#" class="grid grid-cols-2 gap-x-12 gap-y-6" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex col-span-2">
                <h1 class="text-4xl font-bold text-[#4369A2] font-noto-thai">
                    แก้ไขโปรไฟล์
                </h1>
                <div class="w-28 h-28 rounded-full overflow-hidden ml-auto border-2 relative">
                    <label for="profile_image_src"
                        class="cursor-pointer absolute inset-0 opacity-0 hover:opacity-100 bg-black/70 grid place-items-center">
                        <span class="text-white text-xs text-center font-semibold">
                            อับโหลดรูปโปรไฟล์
                        </span>
                    </label>
                    <input onchange="handleImageChange(event)" class="hidden" type="file" name="profile_image_src"
                        id="profile_image_src" accept="">
                    <img id="previewImage"
                        src="{{ $user->profile_image_src ?? asset('images/icons/DefaultPortrait.jpg') }}"
                        alt="Profile portrait picture">
                    @error('profile_image_src')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col gap-y-1 col-span-2">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="email">อีเมล*</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="email" placeholder="john@doe.com"
                    value={{ old('email') ?? $user->email }}>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-y-1">
                <label class="font-semibold text-2xl text-[#1C1C1C]" for="first_name">ชื่อจริง</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="first_name" placeholder="สมชาย"
                    value="{{ old('first_name') ?? $user->first_name }}">
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-y-1">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="last_name">นามสกุล</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="last_name" placeholder="สมศรี"
                    value={{ old('last_name') ?? $user->last_name }}>
                @error('last_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-y-1 col-span-2">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="phone">เบอร์โทรศัพท์</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="phone" placeholder="0812345678"
                    value={{ old('phone') ?? $user->phone }}>
                @error('phone')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            @if ($user->role == \App\Enums\RoleEnum::Lecturer)
                <div class="flex flex-col gap-y-1">
                    <label class="font-semibold text-2xl text-[#1C1C1C]"for="bankName">ธนาคาร</label>
                    <input class="rounded-2xl border-2 p-3" type="text" name="bankName"
                        value={{ old('bankName') ?? $user->bankName }}>
                    @error('bankName')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-y-1">
                    <label class="font-semibold text-2xl text-[#1C1C1C]"for="accountNumber">หมายเลขบัญชีธนาคาร</label>
                    <input class="rounded-2xl border-2 p-3" type="text" name="accountNumber"
                        value={{ old('accountNumber') ?? $user->accountNumber }}>
                    @error('accountNumber')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="flex flex-col gap-y-1">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="year">ชั้นปี/ระดับการศึกษา</label>
                <input class="rounded-2xl border-2 p-3" type="number" name="year" placeholder="ชั้นปีที่ 1"
                    value={{ old('year') ?? $user->academicInfo->year }}>
                @error('year')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-y-1">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="institute">สถาบัน/มหาวิทยาลัย</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="institute"
                    value="{{ old('institute') ?? $user->academicInfo->institute }}">
                @error('institute')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-y-1">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="campus">วิทยาเขต</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="campus"
                    value={{ old('campus') ?? $user->academicInfo->campus }}>
                @error('campus')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-y-1">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="school">คณะ/ภาควิชา</label>
                <input class="rounded-2xl border-2 p-3" type="text" name="school"
                    value={{ old('school') ?? $user->academicInfo->school }}>
                @error('school')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="flex flex-col gap-y-1 col-span-2">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="password">รหัสผ่าน</label>
                <input class="rounded-2xl border-2 p-3" type="password" name="password">
        </div> --}}
            <div class="mt-6 space-x-2 w-full">
                <button class="text-[#FFFFFF] bg-[#DE3730] font-semibold rounded-2xl px-10 py-2"
                    type="submit">ระงับการใช้งาน</button>
                <a href="{{ url()->previous() }}"><button type="button"
                        class="text-[#2A638] bg-[#E9F2FC] font-semibold rounded-2xl px-10 py-2">ยกเลิก</button></a>
                <button class="text-[#FFFFFF] bg-[#2A638A] font-semibold rounded-2xl px-10 py-2"
                    type="submit">บันทึก</button>
                
            </div>
        </form>
    </main>

    <script>
        function handleImageChange(event) {
            var image = document.getElementById('previewImage');;
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</x-left_side_layout>
