<x-left_side_layout>
    <main class="font-noto-thai">
        <form action="/profile" class="grid grid-cols-2 gap-x-12 gap-y-6" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">
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
                @error('first_name')
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
                    <select class="rounded-2xl border-2 p-3" name="bankName">
                        <option value="" selected>เลือกธนาคาร</option>
                        <option value="SCB" {{ $user->bankName == 'SCB' ? 'selected' : '' }}>ธนาคารไทยพาณิชย์
                        </option>
                        <option value="KBANK" {{ $user->bankName == 'KBANK' ? 'selected' : '' }}>ธนาคารกสิกรไทย
                        </option>
                        <option value="KTB" {{ $user->bankName == 'KTB' ? 'selected' : '' }}>ธนาคารกรุงไทย</option>
                        <option value="BBL" {{ $user->bankName == 'BBL' ? 'selected' : '' }}>ธนาคารกรุงเทพ</option>
                        <option value="PROMPTPAY" {{ $user->bankName == 'PROMPTPAY' ? 'selected' : '' }}>พร้อมเพย์
                        </option>
                    </select>

                    {{-- <input class="rounded-2xl border-2 p-3" type="text" name="bankName"
                        value={{ old('bankName') ?? $user->bankName }}> --}}
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
            {{-- <div class="flex flex-col gap-y-1 col-span-2">
                <label class="font-semibold text-2xl text-[#1C1C1C]"for="password">รหัสผ่าน</label>
                <input class="rounded-2xl border-2 p-3" type="password" name="password">
        </div> --}}
            <div class="mt-6 space-x-2 w-full">
                @if (auth()->user()->role->value == "MODERATOR")
                @if ($user->banned_at)
                <button class="text-[#FFFFFF] bg-[#DE3730] font-semibold rounded-2xl px-10 py-3"
                type="submit" name="type" value="unbanned">ยกเลิกระงับใช้งาน</button>
                @else
                <button class="text-[#FFFFFF] bg-[#DE3730] font-semibold rounded-2xl px-10 py-3"
                type="submit" name="type" value="banned">ระงับใช้งาน</button>
                @endif
                @endif
                <a href="{{ url()->previous() }}"><button type="button"
                        class="text-[#2A638] bg-[#E9F2FC] font-semibold rounded-2xl px-10 py-3">ยกเลิก</button></a>
                <button class="text-[#FFFFFF] bg-[#2A638A] font-semibold rounded-2xl px-10 py-3"
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
