<x-left_side_layout>
    <div class="flex flex-row items-center gap-2 text-2xl text-[#2A638A] mt-1">
        <div class="font-bold">แก้ไขบทเรียน: </div>
        <div>{{ $course->title }}</div>
    </div>

    <form method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-2 mt-10">
            <label for="title" class="text-[#1C1C1C] font-semibold">ชื่อบทเรียน</label>
            <input type="text" id="title"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="ใส่ชื่อบทเรียน" name="title" value="{{ $chapter->title }}" />

            @error('title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="description" class="text-[#1C1C1C] font-semibold">รายละเอียดบทเรียน</label>
            <textarea type="text" id="description" rows="8"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="รายละเอียดบทเรียน" name="description">{{ $chapter->description }}</textarea>

            @error('description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="video_src" class="text-[#1C1C1C] font-semibold">วิดีโอประกอบการเรียน</label>
            <input type="text" id="video_src"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="วิดีโอประกอบการเรียน (ID ของคลิปวิดีโอบท YouTube)" name="video_src"
                value="{{ $chapter->video_src }}" />

            @error('video_src')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="durationInMinutes" class="text-[#1C1C1C] font-semibold">ระยะเวลาของบทเรียน</label>
            <input type="number" id="durationInMinutes"
                class="w-full p-3 mt-1 border border-[#E0E3E8] rounded-xl focus:outline-none focus:border-[#000842]"
                placeholder="ระยะเวลาของบทเรียน (โดยประมาณ เช่น 5 นาที เป็นต้น) กรอกเเค่ตัวเลขหน่วยนาที"
                name="durationInMinutes" value="{{ $chapter->durationInMinutes }}" />

            @error('durationInMinutes')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-row items-center justify-between gap-6 mt-12">
            <div class="w-full">
                <input type="submit" value="ลบบทเรียน" name="delete"
                    class="w-[20%] bg-[#DE3730] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg cursor-pointer">
            </div>

            <div class="flex flex-row items-center justify-end gap-6 w-full">
                @if ($chapter->quizz)
                    <a href="/courses/{{ $course->id }}/chapters/{{ $chapter->id }}/quizzes/edit"
                        class="w-fit underline rounded-3xl font-bold focus:outline-none py-3 text-lg">แก้ไขแบบทดสอบ</a>
                @else
                    <a href="/courses/{{ $course->id }}/chapters/{{ $chapter->id }}/quizzes/create"
                        class="w-fit underline  rounded-3xl font-bold focus:outline-none py-3 text-lg">เพิ่มแบบทดสอบ</a>
                @endif

                <a class="w-[20%]  bg-[#E9F2FC] text-[#2A638A] rounded-3xl text-center font-bold focus:outline-none py-3 text-lg"
                    href="/learn/{{ $course->id }}">
                    ยกเลิก</a>

                <button type="submit"
                    class="w-[20%] bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-3 text-lg ">บันทึก</button>
            </div>
        </div>


    </form>
</x-left_side_layout>

<script lang="js">
    function handleUploadFileChange(event) {
        if (event.target.files.length <= 0) return;

        console.log(event.target.files)

        const uploadedFilesPreview = document.getElementById('uploadedFilesPreview');
        uploadedFilesPreview.innerHTML = '';

        let previews = "";

        for (let i = 0; i < event.target.files.length; i++) {
            const file = event.target.files[i];
            console.log(file);

            const url = URL.createObjectURL(file)

            if (i % 2 === 0) {
                let preview = `
                <div class="bg-[#4369A2] flex rounded-2xl min-w-[260px] h-auto p-6 relative">
        <div class="rounded-l-full absolute w-16 h-32 z-10 top-1/2 right-0 transform -translate-y-1/2 bg-[#8AB7DC]/50">
        </div>
        
        <div class="rounded-l-full absolute w-8 h-16 z-10 top-1/2 right-0 transform -translate-y-1/2 bg-white/20">
        </div>

        <div class="rounded-lg flex flex-col gap-y-3 w-full h-auto">

            <div class="rounded-full bg-[#8AB7DC] p-5 justify-start w-1/3">
                <x-bxs-file class="text-white w-full"/>
            </div>

            <div class="flex flex-col gap-y-2 text-xl min-h-20 pr-10">
                <p class=" text-white font-noto-thai">${file.name}</p>
            </div>

            <a class="inline-block w-full h-full" href='${url}'>
            <div class="h-full flex items-end ">
                <button type="button" class="bg-[#FFFFFF] text-[#2A638A] rounded-full w-full py-2 font-bold font-noto-thai text-xs">ดาวน์โหลด</button>
            </div>
        </a>
        </div>
    </div>
            `
                previews += preview;
            } else {
                preview = `
        <div class="bg-[#FFFFFF] flex rounded-2xl min-w-[260px] h-auto p-6 border-solid border border-[#C1C7CE]">
    <div class="rounded-lg flex flex-col gap-y-3 w-full h-auto">
        <div class="rounded-full bg-[#DBE3EE] p-5 justify-start w-1/3">
            <x-bxs-file class="text-white w-full"/>
        </div>
        <div class="flex flex-col gap-y-2 text-xl min-h-20 pr-10">
            <p class=" text-black font-noto-thai">${file.name}</p>
        </div>
        <a class="inline-block w-full h-full" href='${url}'>
            <div class="w-full h-full flex items-end ">
                <button type="button" class="bg-[#FFFFFF] text-xs rounded-full w-full py-2 font-bold border-solid border border-[#C1C7CE] font-noto-thai">ดาวน์โหลด</button>
            </div>
        </a>        
    </div>
</div>
            `
                previews += preview;
            }
        }

        uploadedFilesPreview.innerHTML = previews;
    }
</script>
