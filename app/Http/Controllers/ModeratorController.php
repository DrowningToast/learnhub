<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('moderator.course');
    }

    public function lecturer()
    {
        $lecturers = Users::where('role', 'LECTURER')->get();
        return view('moderator.lecturer', ['lecturers' => $lecturers]);
    }

    public function learner()
    {
        return view('moderator.learner');
    }

    public function transaction()
    {
        return view('moderator.transaction');
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
