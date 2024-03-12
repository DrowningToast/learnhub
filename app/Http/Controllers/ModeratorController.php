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

        if (request('name')) {
            $lecturers = $lecturers->filter(function ($lecturer) {
                return str_contains(strtolower($lecturer->first_name), strtolower(request('name'))) ||
                    str_contains(strtolower($lecturer->last_name), strtolower(request('name')));
            });
        }

        return view('moderator.lecturer', ['lecturers' => $lecturers, 'oldInputValue' => request('name')]);
    }

    public function learner()
    {
        $learners = Users::where('role', 'LEARNER')->get();

        if (request('name')) {
            $learners = $learners->filter(function ($learner) {
                return str_contains(strtolower($learner->first_name), strtolower(request('name'))) ||
                    str_contains(strtolower($learner->last_name), strtolower(request('name')));
            });
        }

        return view('moderator.learner', ['learners' => $learners, 'oldInputValue' => request('name')]);
    }

    public function transaction()
    {
        if (request('orderBy') === 'latest') {
            $transactions = Withdrawals::latest()->get();
        } else {
            $transactions = Withdrawals::oldest()->get();
        }

        $transactions = Withdrawals::latest()->filter(request(['statusId']))->get();

        if (request('name')) {
            $transactions = $transactions->filter(function ($transaction) {
                return str_contains(strtolower($transaction->user->first_name), strtolower(request('name'))) ||
                    str_contains(strtolower($transaction->user->last_name), strtolower(request('name')));
            });
        }

        return view('moderator.transaction', [
            'transactions' => $transactions,
            'oldInputValue' => request('name')
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
