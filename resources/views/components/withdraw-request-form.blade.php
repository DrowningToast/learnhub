<?php
if ($bankName === 'SCB') {
    $bankName = 'ธนาคารไทยพาณิชย์';
} elseif ($bankName === 'KBANK') {
    $bankName = 'ธนาคารกสิกรไทย';
} elseif ($bankName === 'KTB') {
    $bankName = 'ธนาคารกรุงไทย';
} elseif ($bankName === 'BBL') {
    $bankName = 'ธนาคารกรุงเทพ';
} elseif ($bankName === 'PROMPTPAY') {
    $bankName = 'พร้อมเพย์';
}
?>

<div id="withdrawForm" class="hidden absolute top-[25%] right-[20%] bg-white p-6 rounded-xl z-10 shadow-xl w-[50%]">
    <div class="flex flex-row items-center justify-between">
        <h1 class="text-[#2A638A] text-3xl">คำร้องการขอถอนเงิน</h1>
        <div class=" cursor-pointer" onclick="toggleShowForm()">
            ปิด
        </div>
    </div>

    <form action="/lecturer/withdraw" method="post" class="mt-6 ">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="bankName" class="text-[#999999] font-bold">เลขที่บัญชี</label>
            <div class="flex flex-row items-center gap-2 ">
                <input type="text" name="bankName" id="bankName" value="{{ $bankName }}" class="hidden">

                <input type="text" id="bankName"
                    class="w-full p-4 border border-[#999999] bg-[#E0E3E8] focus:outline focus:border-b-[#000842] rounded-xl"
                    placeholder="ยืนยันรหัสผ่านของคุณ" name="bankName" value="{{ $bankName }}" disabled />
            </div>

            @error('bankName')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <input type="text" name="accountNumber" id="accountNumber" value="{{ $accountNumber }}" class="hidden">

            <label for="accountNumber" class="text-[#999999] font-bold">เลขที่บัญชี</label>
            <div class="flex flex-row items-center gap-2 ">
                <input type="text" id="accountNumber"
                    class="w-full p-4 border bg-[#E0E3E8] focus:outline focus:border-b-[#000842] rounded-xl"
                    name="accountNumber" value="{{ $accountNumber }}" />
            </div>

            @error('accountNumber')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-2 mt-6">
            <label for="amount" class="text-[#999999] font-bold">จำนวนเงินที่ต้องการถอน</label>
            <div class="flex flex-row items-center gap-2 ">
                <input type="text" id="amount"
                    class="w-full p-4 border border-[#999999] focus:outline focus:border-b-[#000842] rounded-xl"
                    name="amount" type="number" step="0.1" placeholder="จำนวนเงินที่ต้องการถอน"
                    value="{{ old('amount') }}" />
            </div>

            @error('amount')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-8">
            <button type="submit"
                class="w-full bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-3">สร้างรายการคำขอถอนเงินใหม่</button>
        </div>
    </form>
</div>
