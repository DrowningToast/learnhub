<x-left_side_layout>
    <div class="flex flex-col gap-y-10">
        <h1 class="text-5xl text-[#4369A2] font-bold">ระบบจัดการเว็บไซต์</h1>

        <x-menu-card title="จัดการคอร์สเรียน"
            description="การจัดการคอร์สเรียนสำหรับผู้ดูแลระบบ เกี่ยวข้องกับการตรวจสอบข้อมูลและปรับปรุงเนื้อหาคอร์สเรียน"
            imgSrc="/img/moderator/com.webp" btnColor="bg-[#4369A2]" bgColor="bg-[#E2EEFB]" author=""
            shColor="hover:shadow-[#C1D9F2]" href="/moderator/course" />
        <x-menu-card title="จัดการผู้เรียน"
            description="การจัดการผู้สอนสำหรับผู้ดูแลระบบ เกี่ยวข้องกับการตรวจสอบข้อมูลและจัดการข้อมูลของผู้เรียน"
            imgSrc="/img/moderator/girl.webp" btnColor="bg-[#8B68B1]" bgColor="bg-[#F2E6FF]" author=""
            shColor="hover:shadow-[#CCB9E0]" href="/moderator/learner" />
        <x-menu-card title="จัดการผู้สอน"
            description="การจัดการผู้สอนสำหรับผู้ดูแลระบบ เกี่ยวข้องกับการตรวจสอบข้อมูลและจัดการข้อมูลของผู้เรียน"
            imgSrc="/img/moderator/boy.webp" btnColor="bg-[#C97D93]" bgColor="bg-[#FFEAF0]" author=""
            shColor="hover:shadow-[#EFC4D0]" href="/moderator/lecturer" />
        <x-menu-card title="จัดการธุรกรรม"
            description="การจัดการธุรกรรมสำหรับผู้ดูแลระบบ เกี่ยวข้องกับการจัดการข้อมูลการเงิน เช่น การอนุมัติคำขอการถอนเงิน"
            imgSrc="/img/moderator/Coin.png" btnColor="bg-[#4369A2]" bgColor="bg-[#E2EEFB]" author=""
            shColor="hover:shadow-[#C1D9F2]" href="/moderator/withdraw" />
    </div>
</x-left_side_layout>
