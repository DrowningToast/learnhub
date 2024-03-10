<?php

namespace App\Http\Controllers;

use App\Models\Withdrawals;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user->bankName || !$user->accountNumber) {
            return redirect('/profile')->with('error_message', 'โปรดกรอกข้อมูลบัญชีธนาคารของคุณก่อน');
        }

        // Get User Transactions
        $userTransactions = Withdrawals::latest()->findMany($user->id, 'user_id');

        // Filter Pending Transactions
        $pendingTransactions = $userTransactions->filter(function ($transaction) {
            return $transaction->status === 1;
        });

        $availableBalance = $userTransactions->sum('amount') - $pendingTransactions->sum('amount');
        $pendingBalance = $pendingTransactions->sum('amount');

        return view('withdrawal.lecturer', [
            'user' => auth()->user(),
            'userTransactions' => $userTransactions,
            'pendingTransactions' => $pendingTransactions,
            'pendingBalance' => $pendingBalance,
            'availableBalance' => $availableBalance,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $formFields = $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:' . auth()->user()->points],
            'bankName' => ['required', 'string'],
            'accountNumber' => ['required', 'string'],
        ], [
            'amount.required' => 'โปรดกรอกจำนวนเงินที่ต้องการถอน',
            'amount.numeric' => 'โปรดกรอกจำนวนเงินที่ถูกต้อง',
            'amount.min' => 'จำนวนเงินต้องมากกว่า 0',
            'amount.max' => 'จำนวนเงินที่ถอนต้องน้อยกว่าหรือเท่ากับจำนวนเงินที่มี',
            'bankName.required' => 'โปรดกรอกชื่อธนาคาร',
            'accountNumber.required' => 'โปรดกรอกหมายเลขบัญชี',
        ]);

        $formFields['user_id'] = $user->id;

        Withdrawals::create($formFields);

        return redirect('/lecturer/withdraw')->with('success_message', 'คำขอถอนเงินของคุณถูกส่งแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
