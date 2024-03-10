<div class="flex flex-row items-center justify-between border p-4 rounded-xl">
    <div>
        @if ($type == 'RECEIVE')
            <div class="flex flex-row items-center gap-4 text-lg">
                <img src="{{ asset('images/icons/lecturer/transaction/withdraw_type.png') }}" alt="withdraw type icon">
                <div class="opacity-80">
                    มีเงินเข้าบัญชีจำนวน <span class="text-[#2A638A] font-bold">{{ number_format($amount, 2) }}</span>
                    บาท
                </div>
            </div>
        @else
            <div class="flex flex-row items-center gap-4 text-lg">
                <img src="{{ asset('images/icons/lecturer/transaction/withdraw_type.png') }}" alt="withdraw type icon">
                <div class="opacity-80">
                    ถอน / โอนเงินจำนวน <span class="text-[#2A638A] font-bold">{{ number_format($amount, 2) }}</span> บาท
                </div>
            </div>
        @endif
    </div>
    <div>
        @if ($status == 2)
            <div class="flex flex-row items-center gap-2 text-lg bg-[#ECF3EB] p-3 rounded-xl">
                <img src="{{ asset('images/icons/lecturer/transaction/complete_black.png') }}" alt="completed icon">
                <div class="opacity-80">
                    การทำธุรกรรมสำเร็จ
                </div>
            </div>
        @elseif ($status == 3)
            <div class="flex flex-row items-center gap-2 text-lg bg-[#FFDAD6] p-3 rounded-xl">
                <img src="{{ asset('images/icons/lecturer/transaction/cancel_black.png') }}" alt="cancelled icon">
                <div class="opacity-80">
                    การทำธุรกรรมไม่สำเร็จ
                </div>
            </div>
        @else
            <div class="flex flex-row items-center gap-2 text-lg bg-[#DEE3EA] p-3 rounded-xl">
                <img src="{{ asset('images/icons/lecturer/transaction/pending_black.png') }}" alt="pending icon">
                <div class="opacity-80">
                    กำลังดำเนินการ
                </div>
            </div>
        @endif
    </div>
</div>
