<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style>
<x-left_side_layout>
    <p class="text-[#2A638A] font-semibold text-4xl">สร้างคอร์สเรียน</p>

    <form action="/courses" method="POST" enctype="multipart/form-data">
        @csrf
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
                placeholder="รายละเอียดคอร์สเรียน" name="description">{{ old('description') }}</textarea>

            @error('description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-8">
            <div class="flex flex-row justify-between">
                <div class="flex flex-col gap-2">
                    <label for="cover_image_src" class="text-[#1C1C1C] font-semibold">รูปภาพประกอบคอร์สเรียน</label>
                    <p>ขนาดรูปภาพแนะนำ 1920 x 1080</p>
                    <div class="mt-1">
                        <input type="file" name="cover_image_src" id="cover_image_src"
                            onchange="handleImageChange(event)" value="{{ old('cover_image_src') }}">
                    </div>
                </div>

                <img id="previewImage" class="w-[65%] rounded-xl hidden">
            </div>

            <div class="mt-3">
                @error('cover_image_src')
                    <span class="text-red-500 ">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex flex-row  justify-between gap-12 mt-8">
            <div class="flex flex-col gap-2 w-full">
                <label for="buy_price" class="text-[#1C1C1C] font-semibold">ราคา</label>
                <input step="0.01" type="number" id="buy_price"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="ราคาคอร์สเรียนของคุณ (โปรดเว้นว่างหากเป็นคอร์สฟรี)" name="buy_price"
                    value="{{ old('buy_price') }}" />

                @error('buy_price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 w-full">
                <label for="discount_percent" class="text-[#1C1C1C] font-semibold">ส่วนลด</label>
                <input step="0.01" type="text" id="discount_percent"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="เปอร์เซนต์ส่วนลด (โปรดเว้นว่างหากไม่มีส่วนลด)" name="discount_percent"
                    value="{{ old('discount_percent') }}" />

            </div>
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="category_id" class="text-[#1C1C1C] font-semibold">หมวดหมู่คอร์สเรียน</label>
            <select name="category_id" id="category_id"
                class=" border p-3 rounded-xl focus:outline-none focus:border-[#000842] block w-full mt-1">
                <option selected>โปรดเลือกหมวดหมู่ของคอร์สเรียน</option>
                <option value="1">วิทยาศาสตร์</option>
                <option value="2">คณิตศาสตร์</option>
                <option value="3">ภาษาไทย</option>
                <option value="4">สังคมศึกษา</option>
                <option value="5">ภาษาอังกฤษ</option>
                <option value="6">เทคโนโลยีสารสนเทศ</option>
            </select>

            @error('category_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-row items-center justify-end gap-6">
            <button
                class="w-[15%] bg-[#E9F2FC] text-[#2A638A] rounded-3xl font-bold focus:outline-none py-3 text-lg mt-12"><a
                    href="/learn">ยกเลิก</a></button>

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
