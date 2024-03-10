<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ | LearnHub</title>

    @vite('resources/css/app.css')
</head>

@php
    $selectedRole = app('request')->input('role') ?? 'LEARNER';
@endphp

<body class="bg-white p-6 min-h-screen font-noto-thai">
    <div class="grid grid-cols-2 h-full">
        {{-- RIGHT SIDE --}}
        <div>
            <div class="flex flex-col justify-center min-h-full lg:px-28 2xl:px-36">
                <form action="/register" method="POST">
                    @csrf
                    <div>
                        <p class=" text-3xl font-bold mb-4">สมัครสมาชิก</p>
                        <p>มีบัญชีผู้ใช้เแล้ว ? <a class="text-[#4C5F7C] underline" href="/login">เข้าสู่ระบบ</a>
                        </p>
                    </div>

                    <div class="flex flex-row items-center justify-around mt-12 border rounded-xl p-2">
                        @if ($selectedRole == 'LEARNER')
                            <input type="text" class="hidden" name="role" value="LEARNER">
                            <a class="bg-[#2A638A] text-white p-2 px-12 rounded-lg w-1/2 text-center"
                                href="/register?role=LEARNER">ผู้เรียน</a>
                            <a class="w-1/2 text-center" href="/register?role=LECTURER">ผู้สอน</a>
                        @else
                            <input type="text" class="hidden" name="role" value="LECTURER">
                            <a class="w-1/2 text-center" href="/register?role=LEARNER">ผู้เรียน</a>
                            <a class="bg-[#2A638A] text-white p-2 px-12 rounded-lg w-1/2 text-center"
                                href="/register?role=LEARNER">ผู้สอน</a>
                        @endif
                    </div>

                    <div class="mt-12 flex flex-col gap-12">
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-[#999999] font-bold">อีเมล</label>
                            <div class="flex flex-row items-center gap-2 relative">
                                <img src="{{ asset('images/icons/message.png') }}" class=" absolute">
                                <input type="text" id="email"
                                    class="w-full p-2 border-b-2 border-b-[#999999]  focus:outline-none focus:border-b-[#000842] pl-8"
                                    placeholder="ใส่ชื่ออีเมลของคุณ" name="email" value="{{ old('email') }}" />
                            </div>

                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="username" class="text-[#999999] font-bold">ชื่อผู้ใช้</label>
                            <div class="flex flex-row items-center gap-2 relative">
                                <img src="{{ asset('images/icons/message.png') }}" class=" absolute">
                                <input type="text" id="username"
                                    class="w-full p-2 border-b-2 border-b-[#999999]  focus:outline-none focus:border-b-[#000842] pl-8"
                                    placeholder="ใส่ชื่อผู้ใช้ของคุณ" name="username" value="{{ old('username') }}" />
                            </div>

                            @error('username')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="username" class="text-[#999999] font-bold">รหัสผ่าน</label>
                            <div class="flex flex-row items-center gap-2 relative">
                                <img src="{{ asset('images/icons/lock.png') }}" class=" absolute">
                                <input type="password" id="password"
                                    class="w-full p-2 border-b-2 border-b-[#999999]  focus:outline-none focus:border-b-[#000842] pl-8"
                                    placeholder="ใส่รหัสผ่านของคุณ" name="password" value="{{ old('password') }}" />
                            </div>

                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="username" class="text-[#999999] font-bold">ยืนยันรหัสผ่าน</label>
                            <div class="flex flex-row items-center gap-2 relative">
                                <img src="{{ asset('images/icons/lock.png') }}" class=" absolute">
                                <input type="password" id="password_confirmation"
                                    class="w-full p-2 border-b-2 border-b-[#999999]  focus:outline-none focus:border-b-[#000842] pl-8"
                                    placeholder="ยืนยันรหัสผ่านของคุณ" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" />
                            </div>

                            @error('password_confirmation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-16">
                        <button type="submit"
                            class="w-full bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-5 text-lg">สมัครสมาชิก</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- LEFT SIDE --}}
        <div class="min-w-full min-h-full bg-gradient-to-b from-[#D4E3FF] to-[#B4C8E9] rounded-xl">
            <div class="flex flex-col items-start justify-start">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/vector/Saly-10.png') }}" class="w-[80%]" />
                </div>


                <div class="p-24 pt-18">
                    <p class=" font-noto-thai text-4xl text-white">สมัครสมาชิก
                        <span class="font-beth text-[#2560B4]">LearnHub</span>
                    </p>
                    <p class="font-poppins mt-3 text-lg text-white">Lorem Ipsum is simply</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
