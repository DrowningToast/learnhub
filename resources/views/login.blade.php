<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ | LearnHub</title>

    @vite('resources/css/app.css')
</head>

<body class="p-6 min-h-screen font-noto-thai relative bg-white grid place-items-center">

    <x-toast />

    <div class="grid grid-cols-2 h-full">
        {{-- RIGHT SIDE --}}
        <div>
            <div class="flex flex-col justify-center min-h-full lg:px-28 2xl:px-36">
                <form action="/login" method="POST">
                    @csrf
                    <div>
                        <p class=" text-3xl font-bold mb-4">เข้าสู่ระบบ</p>
                        <p>ยังไม่มีบัญชีผู้ใช้ ?
                            <a class="text-[#4C5F7C] underline" href="/register?role=LEARNER">สมัครสมาชิก</a>
                        </p>
                    </div>

                    <div class="mt-16 flex flex-col gap-12">
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
                    </div>

                    <div class=" mt-8 flex flex-row justify-between">
                        <div class="flex flex-row items-center gap-2">
                            <input type="checkbox" id="saveSession" name="saveSession" value="saveSession"
                                class="h-5 w-5">
                            <label for="saveSession" class="text-[#000000]"> จดจำการเข้าสู่ระบบ</label><br>
                        </div>

                        <div>
                            <p class="text-[#4D4D4D] font-light">
                                <a href="">
                                    ลืมรหัสผ่าน ?
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="mt-16">
                        <button type="submit"
                            class="w-full bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-5 text-lg">เข้าสู่ระบบ</button>
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
                    <p class=" font-noto-thai text-4xl text-white">เข้าสู่ระบบ
                        <span class="font-beth text-[#2560B4]">LearnHub</span>
                    </p>
                    <p class=" mt-3 text-xl text-white">เติมเต็มความรู้ พัฒนาทักษะ</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
