<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Withdrawals;
use Illuminate\Http\Request;
use Workbench\App\Models\User;
use App\Models\Users;

class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('moderator.index');
    }

    public function course()
    {
        if (request('orderBy') === 'latest') {
            $corses = Courses::latest()->filter(request(['title', 'categoryId']))->get();
        } else {
            $corses = Courses::oldest()->filter(request(['title', 'categoryId']))->get();
        }

        return view('moderator.course', [
            'courses' => $corses,
            'oldInputValue' => request('title')
        ]);
    }

    public function lecturer()
    {
        $lecturers = Users::where('role', 'LECTURER')->get();
        return view('moderator.lecturer', ['lecturers' => $lecturers]);
    }

    public function learner()
    {
        $learners = Users::where('role', 'LEARNER')->get();
        return view('moderator.learner', ['learners' => $learners]);
    }

    public function transaction()
    {
        $transactions = Withdrawals::latest()->get();

        return view('moderator.transaction', [
            'transactions' => $transactions
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
        //
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    public function approve(Request $request)
    {
        $withdrawel = Withdrawals::find($request->id);

        $withdrawel->status_id = 2;
        $withdrawel->save();

        return redirect()->back()->with('success_message', 'คำขอถอนเงินถูกอนุมัติแล้ว');
    }

    public function reject(Request $request)
    {
        $withdrawel = Withdrawals::find($request->id);

        $withdrawel->status_id = 3;
        $withdrawel->save();

        return redirect()->back()->with('success_message', 'ปฎิเสธคำขอถอนเงินแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
