<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
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

        // WITHDRAWAL TRANSACTIONS
        $userTransactions = Withdrawals::latest()->where('user_id', $user->id)->get();
        $userTransactionsPagination = Withdrawals::latest()->where('user_id', $user->id)->paginate(5);

        $pendingTransactions = $userTransactions->filter(function ($transaction) {
            return $transaction->status_id === 1;
        });

        $completedTransactions = $userTransactions->filter(function ($transaction) {
            return $transaction->status_id === 2;
        });

        $pendingBalance = $pendingTransactions->sum('amount');

        // COURSE SELLING TRANSACTIONS
        $courseSellingTransactions = Transactions::latest()->get();

        // COURSES THAT BELONG TO THE USER
        $course_ids = $user->ownedCourses->pluck('id')->toArray();
        $courseSellingTransactionsPagination = Transactions::latest()->whereIn('course_id', $course_ids)->paginate(5);

        $courseSellingTransactions = $courseSellingTransactions->filter(function ($transaction) use ($user) {
            return $transaction->course->lecturer_id === $user->id;
        });

        $availableBalance = $courseSellingTransactions->sum('amount') - $pendingTransactions->sum('amount') - $completedTransactions->sum('amount');

        return view('withdrawal.lecturer', [
            'user' => auth()->user(),
            'userTransactions' => $userTransactionsPagination,
            'pendingTransactions' => $pendingTransactions,
            'pendingBalance' => $pendingBalance,
            'availableBalance' => $availableBalance,
            'courseSellingTransactions' => $courseSellingTransactionsPagination,
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

        $userTransactions = Withdrawals::latest()->where('user_id', $user->id)->get();
        $availableBalance = $userTransactions->sum('amount') - $userTransactions->where('status_id', 1)->sum('amount');

        $formFields = $request->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:' . 9999999],
            'bankName' => ['required', 'string'],
            'accountNumber' => ['required', 'string'],
        ], [
            'amount.required' => 'โปรดกรอกจำนวนเงินที่ต้องการถอน',
            'amount.numeric' => 'จำนวนเงินต้องเป็นตัวเลข',
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
