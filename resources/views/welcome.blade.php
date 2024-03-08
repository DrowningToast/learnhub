<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LearnHub</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
    </style>
</head>

<body class="w-full min-h-screen font-noto-thai bg-[#F4F8FF]">
    {{-- navbar --}}
    <x-NavLanding />

    {{-- hero --}}
    <div
        class="bg-gradient-to-b from-[#7F92B1] from-10% to-[#FFF]/0 to-90% w-full min-h-screen flex justify-center items-center pt-14">
        <div class="grid grid-cols-2 w-3/4 gap-x-16">
            <div class="flex justify-center flex-col gap-y-5">
                <div class="flex flex-col gap-y-5">
                    <h1 class="text-6xl font-bold">Lorem ipsum dolor sit amet.</h1>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, hic?</p>
                </div>
                <div class="flex items-center gap-x-5 ">
                    <a href="#" class="bg-[#2A638A] text-white px-9 py-3 rounded-lg">Sign up</a>
                    <a href="#" class="text-[#060732] px-9 py-3 rounded-xl underline">Sign in</a>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <img src="/img/homework.webp" alt="hero-image" class="w-4/5">
            </div>
        </div>
    </div>

    {{-- section 2 --}}
    <div class="w-full min-h-screen flex justify-center items-center">
        <div class="bg-[#E2EEFB] rounded-xl w-11/12 py-24 px-16 flex flex-col gap-y-14">
            <div class="text-center flex flex-col gap-y-5">
                <p class="text-2xl font-medium">Lorem, ipsum.</p>
                <h1 class="text-5xl font-extrabold">Lorem, ipsum.</h1>
            </div>
            <div class="grid grid-cols-4 gap-x-10">
                <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                    hoverImage="/img/features/sparkles_hover.webp"
                    title="Lorem, ipsum." description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                    containerClass="hover:from-[#368DD2] hover:to-[#368DD2]/20"
                    childrenClass="from-[#368DD2] to-[#368DD2]/20"/>

                <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                    hoverImage="/img/features/sparkles_hover.webp"
                    title="Lorem, ipsum." description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                    containerClass="hover:from-[#CB3737] hover:to-[#CB3737]/20"
                    childrenClass="from-[#CB3737] to-[#CB3737]/20"/>

                <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                    hoverImage="/img/features/sparkles_hover.webp"
                    title="Lorem, ipsum." description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                    containerClass="hover:from-[#F5CC63] hover:to-[#F5CC63]/20"
                    childrenClass="from-[#F5CC63] to-[#F5CC63]/20"/>

                <x-FeatureCard baseImage="/img/features/sparkles_base.webp"
                    hoverImage="/img/features/sparkles_hover.webp"
                    title="Lorem, ipsum." description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, deleniti."
                    containerClass="hover:from-[#52B6B4] hover:to-[#52B6B4]/20"
                    childrenClass="from-[#52B6B4] to-[#52B6B4]/20"/>

            </div>
        </div>
    </div>
</body>

</html>
