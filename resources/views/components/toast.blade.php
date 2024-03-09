<div class="absolute w-full flex flex-row justify-center rounded-xl">
    @if (session()->has('success_message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class=" z-50 fixed top-12 w-fit shadow-xl flex flex-row items-center justify-center bg-white drop-shadow-xl px-12 py-3 rounded-xl">
            <div class=" font-semibold text-sm flex flex-row items-center gap-4 rounded-full">
                <img src="{{ asset('images/icons/success.png') }}" alt="" class="w-8 h-8">
                {{ session('success_message') }}

                <div onclick="handleClose()" class="font-semibold text-[#555] cursor-pointer">x</div>
            </div>
        </div>
    @endif

    @if (session()->has('error_message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="z-50 top-12 fixed w-fit shadow-xl flex flex-row items-center justify-center bg-white drop-shadow-xl px-12 py-3 rounded-xl">
            <div class=" font-semibold text-sm flex flex-row items-center gap-4 rounded-full">
                <img src="{{ asset('images/icons/error.png') }}" alt="" class="w-8 h-8">
                {{ session('error_message') }}

                <div onclick="handleClose()" class="font-semibold text-[#555] cursor-pointer">x</div>
            </div>
        </div>
    @endif

    @if (session()->has('info_message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="z-50 top-12 fixed w-fit shadow-xl flex flex-row items-center justify-center bg-white drop-shadow-xl px-12 py-3 rounded-xl">
            <div class=" font-semibold text-sm flex flex-row items-center gap-4 rounded-full">
                <img src="{{ asset('images/icons/info.png') }}" alt="" class="w-8 h-8">
                {{ session('info_message') }}

                <div onclick="handleClose()" class="font-semibold text-[#555] cursor-pointer">x</div>
            </div>
        </div>
    @endif

    <script>
        const handleClose = () => {
            document.querySelector('.fixed').style.display = 'none';
        }
    </script>
</div>
