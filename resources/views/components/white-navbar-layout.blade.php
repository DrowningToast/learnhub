<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LearnHub</title>

    @vite('resources/css/app.css')
</head>

<body class="w-full min-h-screen font-noto-thai">
    <x-toast />

    <main>
        {{ $slot }}
    </main>
</body>

</html>
