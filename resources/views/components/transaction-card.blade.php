<div
    class="h-24 w-full rounded-2xl border border-[#DBE3EE] flex items-center justify-between px-10 py-3 hover:shadow-xl duration-200">
    <div class="h-full flex gap-x-4 items-center">
        <img src="{{ $imgSrc }}" alt="user-profile" class="h-full rounded-full aspect-square">
        <p class="font-semibold text-xl"><span class="text-[#2A638A] font-bold">{{ $name }}</span> ถอน /
            โอนเงินจำนวน <span class="text-[#2A638A] font-bold">{{ number_format($money, 2) }}</span> บาทไปที่บัญชี
            {{ $bankName }} {{ $accountNumber }} </p>
    </div>
    <div class="h-full flex gap-x-4 items-center">
        @if ($status == 1)
            <form action="" method="post">
                @csrf
                @method('PUT')
                <button type="submit" formaction="/moderator/withdraw/reject" class="p-3 bg-[#C1C7CE] rounded-md"><img
                        src="/images/icons/close.png" alt="no-accept" class="w-6"></button>
                <button type="submit" formaction="/moderator/withdraw/approve" class="p-3 bg-[#CBE6FF] rounded-md"><img
                        src="/images/icons/correct.png" alt="accept" class="w-6"></button>
            </form>
        @elseif ($status == 2)
            <div class="flex gap-x-2 items-center bg-[#ECF3EB] rounded-md p-4">
                <img src="/images/icons/correct-fill.png" alt="accept" class="w-6">
                <p class="font-semibold">การทำธุรกรรมสำเร็จ</p>
            </div>
        @elseif ($status == 3)
            <div class="flex gap-x-2 items-center bg-[#FFDAD6] rounded-md p-4">
                <img src="/images/icons/close-fill.png" alt="no-accept" class="w-6">
                <p class="font-semibold">การทำธุรกรรมไม่สำเร็จ</p>
            </div>
        @endif
    </div>
</div>
