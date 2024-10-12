<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="http://34.143.197.151:5173/resources/css/app.css">
</head>

@php
    $isLecturer = auth()->user()->role->value === 'LECTURER';
    $isModerator = auth()->user()->role->value === 'MODERATOR';
@endphp

<body class="bg-gradient-to-b from-[#4369A2] to-[#00476C] h-screen p-4 pl-0 font-noto-thai relative">
    <x-toast />
    <div class="grid grid-cols-6 h-full relative">
        <div class="col-span-1 flex flex-col">
            <p class="text-3xl 2xl:text-4xl font-beth text-white text-center mt-8"><a href="/">LearnHub</a></p>

            <div class="flex flex-col gap-8 p-10 pl-12 mt-20">
                <x-menu-item title="หน้าเเรก" url="{{ $isModerator ? '/moderator' : '/learn' }}"
                    iconSrc="images/icons/menu.png"
                    isSelected="{{ Request::is('learn') || Request::is('moderator') }}" />

                @if ($isLecturer)
                    <x-menu-item title="ถอนเงิน" url="/lecturer/withdraw"
                        iconSrc="images/icons/lecturer/transaction/dollar.png"
                        isSelected="{{ Request::is('lecturer/withdraw') }}" />
                @endif

                @if ($isModerator)
                    <x-menu-item title="คำขอถอนเงิน" url="/moderator/withdraw"
                        iconSrc="images/icons/lecturer/transaction/dollar.png"
                        isSelected="{{ Request::is('moderator/withdraw') }}" />

                    <x-menu-item title="จัดการคอร์สเรียน" url="/moderator/course" iconSrc="images/icons/settings.png"
                        isSelected="{{ str_contains(Request::path(), 'course') }}" />

                    <x-menu-item title="จัดการผู้เรียน" url="/moderator/learner" iconSrc="images/icons/settings.png"
                        isSelected="{{ str_contains(Request::path(), 'learner') || str_contains(Request::path(), 'user') }}" />

                    <x-menu-item title="จัดการผู้สอน" url="/moderator/lecturer" iconSrc="images/icons/settings.png"
                        isSelected="{{ Request::is('moderator/lecturer') || str_contains(Request::path(), 'lecturer') }}" />
                @endif

                <x-menu-item title="ตั้งค่า" url="/profile" iconSrc="images/icons/settings.png"
                    isSelected="{{ Request::is('profile') }}" />

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

        <div class="col-span-5 bg-white rounded-xl w-full min-h-full p-10 overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
