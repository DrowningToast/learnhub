<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <button class="btn" onclick="my_modal_1.showModal()">Do Quiz Chapter 1</button>
    <dialog id="my_modal_1" class="modal rounded-2xl p-10 w-[700px] h-[400px]">
        <div class="modal-box flex flex-col">
            <div class="flex flex-col gap-y-10">
                <div class="flex flex-col gap-y-2">
                    <p class="text-[#A3ACB6]">Question 1</p>
                    <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris</p>
                </div>
                <div class="flex flex-col gap-y-3">
                    <p class="text-[#A3ACB6]">Answer Options</p>
                    <div class="flex flex-col gap-y-4 rounded-2xl ">
                        <div class="flex gap-5 font-noto-thai font-[20px]">
                            <a href="" class="flex flex-col group max-w-xs mx-auto rounded-2xl p-2 bg-white">
                                <p class="font-bold">A</p>
                                <p class="text-black"> Lorem ipsum dolor sit amet, consectetur</p>

                            </a>

                        </div>
                        <div class="flex gap-5 font-noto-thai font-[20px]">
                            <p class="font-bold">A</p>
                            <p class="text-black"> Lorem ipsum dolor sit amet, consectetur</p>
                        </div>
                        <div class="flex gap-5 font-noto-thai font-[20px]">
                            <p class="font-bold">A</p>
                            <p class="text-black"> Lorem ipsum dolor sit amet, consectetur</p>
                        </div>
                    </div>
                </div>


            </div>
            {{-- <h3 class="font-bold text-lg">Hello!</h3>
            <p class="py-4">Press ESC key or click the button below to close</p> --}}
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</body>

</html>
