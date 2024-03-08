<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-[#4369A2] to-[#00476C] min-h-screen p-4 pl-0 font-noto-thai">
    <div class="grid grid-cols-6 h-[96svh]">
        <div class="col-span-1 flex flex-col relative">
            <p class="text-3xl 2xl:text-4xl font-beth text-white text-center mt-6">LearnHub</p>

            <div class="flex flex-col gap-8 p-10 pl-12 mt-20">
                <a href="/courses/manage" class="flex flex-row items-center gap-4 text-lg "
                    style="text-decoration: none !important; color: black;">
                    <img src="{{ asset('images/icons/menu.png') }}" alt="Home" class="w-8">
                    <p class="text-white font-semibold">หน้าเเรก</p>
                </a>

                <a href="/courses/manage"
                    class="flex flex-row items-center gap-4 text-lg text-white opacity-50 hover:opacity-100"
                    style="text-decoration: none !important; color: black;">
                    <img src="{{ asset('images/icons/settings.png') }}" alt="Settings" class="w-8">
                    <p class="text-white font-semibold">ตั้งค่า</p>
                </a>

                <div class=" absolute bottom-6">
                    <a href="/logout"
                        class="mt-12 flex flex-row items-center gap-4 text-lg text-white opacity-50 hover:opacity-100"
                        style="text-decoration: none !important; color: black;">
                        <img src="{{ asset('images/icons/logout.png') }}" alt="Settings" class="w-8">
                        <p class="text-white font-semibold">ออกจากระบบ</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-span-5 bg-white rounded-xl w-full">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
