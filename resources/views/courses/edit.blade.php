<x-left_side_layout>
    <p class="text-[#2A638A] font-semibold text-4xl">เเก้ไขคอร์สเรียน</p>

    <form action="/courses/{{ $course->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-2 mt-10">
            <label for="title" class="text-[#1C1C1C] font-semibold">ชื่อคอร์สเรียน</label>
            <input type="text" id="title"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="ใส่ชื่อคอร์สเรียน" name="title" value="{{ $course->title }}" />

            @error('title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="description" class="text-[#1C1C1C] font-semibold">รายละเอียดคอร์สเรียน</label>
            <textarea type="text" id="description" rows="8"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="รายละเอียดคอร์สเรียน" name="description">{{ $course->description }}</textarea>

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
                        <input accept="image/*" type="file" name="cover_image_src" id="cover_image_src"
                            onchange="handleImageChange(event)" value="{{ $course->cover_image_src }}">
                    </div>
                </div>

                @if ($course->cover_image_src)
                    <img id="previewImage" src="{{ asset($course->cover_image_src) }}" class="w-[65%] rounded-xl">
                @else
                    <img id="previewImage" class="w-[65%] rounded-xl hidden">
                @endif
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
                    value="{{ number_format($course->buy_price, 2) }}" />

                @error('buy_price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 w-full">
                <label for="discount_percent" class="text-[#1C1C1C] font-semibold">ส่วนลด</label>
                <input step="0.01" type="number" id="discount_percent"
                    class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                    placeholder="เปอร์เซนต์ส่วนลด (โปรดเว้นว่างหากไม่มีส่วนลด)" name="discount_percent"
                    value="{{ number_format($course->discount_percent, 2) }}" />

                @error('discount_percent')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="category_id" class="text-[#1C1C1C] font-semibold">หมวดหมู่คอร์สเรียน</label>
            <select name="category_id" id="category_id"
                class=" border p-3 rounded-xl focus:outline-none focus:border-[#000842] block w-full mt-1">
                <option>โปรดเลือกหมวดหมู่ของคอร์สเรียน</option>
                <option value="1" {{ $course->category_id == '1' ? 'selected' : '' }}>วิทยาศาสตร์</option>
                <option value="2" {{ $course->category_id == '2' ? 'selected' : '' }}>คณิตศาสตร์</option>
                <option value="3" {{ $course->category_id == '3' ? 'selected' : '' }}>ภาษาไทย</option>
                <option value="4" {{ $course->category_id == '4' ? 'selected' : '' }}>สังคมศึกษา</option>
                <option value="5" {{ $course->category_id == '5' ? 'selected' : '' }}>ภาษาอังกฤษ</option>
                <option value="6" {{ $course->category_id == '6' ? 'selected' : '' }}>เทคโนโลยีสารสนเทศ</option>
            </select>

            @error('category_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-row items-center justify-between gap-6 mt-12">
            <div class="w-full">
                <input type="submit" value="ลบคอร์สเรียน" name="delete"
                    class="w-[25%] bg-[#DE3730] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg cursor-pointer">
                {{-- <button
                    class="w-[25%] bg-[#DE3730] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg mt-12"><a
                        href="/courses">ลบคอร์สเรียน</a></button> --}}
            </div>

            <div class="w-full flex items-center justify-end gap-6 ">
                <input type="submit" value="ยกเลิก" name="back"
                    class="w-[25%] bg-[#E9F2FC] text-[#2A638A] rounded-3xl font-bold focus:outline-none py-3 text-lgcursor-pointer">

                <button type="submit"
                    class="w-[25%] bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg ">อัพเดทคอร์สเรียน</button>
            </div>
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
