<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Lab (Sila Pakdeewong)</title>

    @vite('resources/css/app.css')
</head>

<body>
    <nav class="p-6 bg-blue-300 text-black text-lg font-semibold flex items-center justify-between">
        LearnHub
    </nav>

    <main class="px-24 mt-12">
        {{ $slot }}
    </main>
</body>

</html>
