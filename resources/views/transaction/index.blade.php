<x-left_side_layout>
    <div class="flex flex-row items-center justify-between relative">
        <h1 class="text-4xl font-bold text-[#4369A2] font-noto-thai">
            บัญชีของฉัน
        </h1>

        <div onclick="toggleShowForm()"
            class="flex flex-row items-center gap-2 border p-3 px-6 w-fit rounded-lg text-[#2A638A] cursor-pointer hover:bg-slate-100">
            <img src="{{ asset('images/icons/lecturer/transaction/withdraw.png') }}" alt="withdraw">
            ถอนเงิน
        </div>
    </div>

    <div class="grid grid-cols-2 gap-20 mt-8">
        <div class="text-white bg-[#2A638A] rounded-xl shadow relative p-6">
            <div class="flex flex-row items-center gap-2 text-lg">
                <img src="{{ asset('images/icons/lecturer/transaction/coin.png') }}" alt="coin">
                <div class=" opacity-80">
                    จำนวนเงินทั้งหมด
                </div>
            </div>
            <div class=" text-4xl mt-6 font-bold">
                {{ number_format(1000000, 2) }} บาท
            </div>

            <img src="{{ asset('images/icons/lecturer/transaction/blue.png') }}" alt="fuck"
                class=" absolute bottom-0 right-0 rounded-ee-xl">
        </div>

        <div class=" rounded-xl shadow border  p-6">
            <div class="flex flex-row items-center gap-2 text-lg">
                <img src="{{ asset('images/icons/lecturer/transaction/clock.png') }}" alt="clock"
                    class=" bg-slate-400 rounded-full">
                <div class=" text-[#112E5B]">
                    กำลังดำเนินการ
                </div>
            </div>
            <div class=" text-4xl mt-6 font-bold">
                {{ number_format(1000000, 2) }} บาท
            </div>
        </div>
    </div>

    <h1 class=" text-2xl font-bold mt-10">
        ประวัติการถอนเงิน
    </h1>

    <div class="mt-6 flex flex-col gap-4">
        <x-transaction-history-card amount="5000" type="RECEIVE" status="COMPLETED" />
        <x-transaction-history-card amount="5000" type="WITHDRAW" status="CANCELLED" />
        <x-transaction-history-card amount="5000" type="WITHDRAW" status="PENDING" />
        <x-transaction-history-card amount="5000" type="RECEIVE" status="COMPLETED" />
    </div>

    <div id="withdrawForm" class="hidden absolute top-[30%] right-[20%] bg-white p-6 rounded-xl z-10 shadow-xl w-[50%]">
        <div class="flex flex-row items-center justify-between">
            <h1 class="text-[#2A638A] text-3xl">คำร้องการขอถอนเงิน</h1>
            <div class=" cursor-pointer" onclick="toggleShowForm()">
                ปิด
            </div>
        </div>

        <form action="/transaction" method="post" class="mt-6 ">
            <div class="flex flex-col gap-2">
                <label for="account_no" class="text-[#999999] font-bold">เลขที่บัญชี</label>
                <div class="flex flex-row items-center gap-2 ">
                    <input type="text" id="account_no"
                        class="w-full p-4 border border-[#999999] focus:outline focus:border-b-[#000842] rounded-xl"
                        placeholder="ยืนยันรหัสผ่านของคุณ" name="account_no" value="{{ old('account_no') }}" />
                </div>

                @error('account_no')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="bank_name" class="text-[#999999] font-bold">เลขที่บัญชี</label>
                <div class="flex flex-row items-center gap-2 ">
                    <input type="text" id="bank_name"
                        class="w-full p-4 border border-[#999999] focus:outline focus:border-b-[#000842] rounded-xl"
                        placeholder="ยืนยันรหัสผ่านของคุณ" name="bank_name" value="{{ old('bank_name') }}" />
                </div>

                @error('bank_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <label for="amount" class="text-[#999999] font-bold">จำนวนเงินที่ต้องการถอน</label>
                <div class="flex flex-row items-center gap-2 ">
                    <input type="text" id="amount"
                        class="w-full p-4 border border-[#999999] focus:outline focus:border-b-[#000842] rounded-xl"
                        placeholder="ยืนยันรหัสผ่านของคุณ" name="amount" value="{{ old('amount') }}" />
                </div>

                @error('amountหอแก')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-[#2A638A] text-white rounded-3xl font-bold focus:outline-none py-3">สร้างรายการคำขอถอนเงินใหม่</button>
            </div>
        </form>
    </div>

    <script>
        function toggleShowForm() {
            document.getElementById('withdrawForm').classList.toggle('hidden')
        }
    </script>
</x-left_side_layout>
