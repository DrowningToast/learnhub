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
                {{ number_format($availableBalance, 2) }} บาท
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
                {{ number_format($pendingBalance, 2) }} บาท
            </div>
        </div>
    </div>

    <h1 class=" text-2xl font-bold mt-10">
        ประวัติการถอนเงิน
    </h1>

    <div class="mt-6 flex flex-col gap-4">
        @foreach ($userTransactions as $userTransaction)
            <x-transaction-history-card amount="{{ $userTransaction->amount }}" type="WITHDRAW"
                status="{{ $userTransaction->status_id }}" />
        @endforeach

        {{ $userTransactions->links() }}
    </div>

    <x-withdraw-request-form bankName="{{ $user->bankName }}" accountNumber="{{ $user->accountNumber }}" />

    <h1 class=" text-2xl font-bold mt-10">
        ธุรกรรมล่าสุด
    </h1>

    <div class="mt-6 flex flex-col gap-4">
        @foreach ($courseSellingTransactions as $userTransaction)
            <x-transaction-history-card amount="{{ $userTransaction->amount }}" type="RECEIVE" status=2 />
        @endforeach

        {{ $courseSellingTransactions->links() }}
    </div>

    <script>
        function toggleShowForm() {
            document.getElementById('withdrawForm').classList.toggle('hidden')
        }
    </script>
</x-left_side_layout>
