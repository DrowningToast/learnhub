<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Lab (Sila Pakdeewong)</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="p-6 bg-[#4369A2] text-white text-lg font-semibold flex h-screen
        relative">
        <div class="flex flex-col gap-y-10 justify-start">
            <div class="">
                <p class="">LearnHub</p>
            </div>

            <div class="flex flex-col font-sans-thai">
                <a href="">Home</a>
                <a href="">Setting</a>
            </div>

            <div class="flex flex-col justify-end font-sans-thai">
                <a href="">Sign Out</a>
            </div>
        </div>

        <x-toast />

        <main class="px-24 mt-12">
            {{ $slot }}
        </main>


    </div>
</body>

</html>
