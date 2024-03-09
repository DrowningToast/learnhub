<x-left_side_layout>
    <p class="text-[#2A638A] font-semibold text-4xl">สร้างคอร์สเรียน</p>

    <form action="/courses" method="post">
        <div class="flex flex-col gap-2 mt-10">
            <label for="title" class="text-[#1C1C1C] font-semibold">ชื่อคอร์สเรียน</label>
            <input type="text" id="title"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="ใส่ชื่อคอร์สเรียน" name="title" value="{{ old('title') }}" />

            @error('title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="description" class="text-[#1C1C1C] font-semibold">รายละเอียดคอร์สเรียน</label>
            <textarea type="text" id="description" rows="8"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="รายละเอียดคอร์สเรียน" name="description" value="{{ old('description') }}"></textarea>

            @error('description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-8">
            <div class="flex flex-row justify-between">
                <div class="flex flex-col gap-2">
                    <label for="description" class="text-[#1C1C1C] font-semibold">รูปภาพประกอบคอร์สเรียน</label>
                    <p>ขนาดรูปภาพแนะนำ 1920 x 1080</p>
                    <div class="mt-1">
                        <input type="file" name="courseImage" id="courseImage" onchange="handleImageChange(event)">
                    </div>
                </div>

                <img id="previewImage" class="w-[65%] rounded-xl hidden">
            </div>

            @error('courseImage')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-row items-center justify-between gap-12 mt-8">
            <div class="flex flex-col gap-2 w-full">
                <label for="price" class="text-[#1C1C1C] font-semibold">ราคา</label>
                <input type="number" id="price"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="ใส่ชื่อคอร์สเรียน" name="price" value="{{ old('price') }}" />

                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 w-full">
                <label for="discountPct" class="text-[#1C1C1C] font-semibold">ส่วนลด</label>
                <input type="text" id="discountPct"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="ใส่ชื่อคอร์สเรียน" name="discountPct" value="{{ old('discountPct') }}" />

                @error('discountPct')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex flex-row items-center justify-end gap-6">
            <button type="submit"
                class="w-[15%] bg-[#E9F2FC] text-[#2A638A] rounded-3xl font-bold focus:outline-none py-3 text-lg mt-12">ยกเลิก</button>

            <button type="submit"
                class="w-[15%] bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg mt-12">สร้างคอร์สเรียน</button>
        </div>
    </form>

    <script>
        function handleImageChange(event) {
            var image = document.getElementById('previewImage');
            image.classList.remove("hidden");
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</x-left_side_layout>
