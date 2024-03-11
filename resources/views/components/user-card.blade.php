<div class="h-24 w-full rounded-2xl border border-[#DBE3EE] flex items-center justify-between px-10 py-3 hover:shadow-xl duration-200">
   <div class="h-full flex gap-x-4 items-center">
        <img src="{{ $imgSrc }}" alt="user-profile" class="h-full rounded-full aspect-square">
        <p class="font-semibold text-xl">{{ $name }}</p>
   </div>
   <div class="h-full flex gap-x-4 items-center">
        <a href="#">
            <button class="bg-[#EBEEF3] px-5 py-4 flex rounded-lg gap-x-2">
                <x-fas-book class="w-4 text-black mt-[2px]"/>
                <p>{{ $course }} Course</p>
            </button>
        </a>
        <a href="/moderator/user/edit/{{ $pid }}">
            <x-fas-arrow-right class="w-6 text-gray-500"/>
        </a>
   </div>
</div>
