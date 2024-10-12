<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LearnHub</title>

    <link rel="stylesheet" href="http://34.143.197.151:5173/resources/css/app.css">
</head>

<body class="w-full min-h-screen font-noto-thai">
    <x-toast />

    <x-nav-landing />

    <main class="pt-14">
        {{ $slot }}
    </main>
</body>

</html>
