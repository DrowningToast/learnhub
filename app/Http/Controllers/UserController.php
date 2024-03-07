<?php

namespace App\Http\Controllers;

use App\Models\Credentials;
use App\Models\AcademicInfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'role' => ['required', Rule::in(['LEARNER', 'LECTURER'])],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'username' => ['required', Rule::unique('credentials', 'username')],
                'password' => ['required', 'min:8', 'confirmed'],
            ],
            [
                'role.required' => 'โปรดเลือกบทบาท (Role)',
                'role.in' => 'โปรดเลือกบทบาท (Role) ที่ถูกต้อง',
                'username.required' => 'โปรดกรอกชื่อผู้ใช้',
                'username.unique' => 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว',
                'password.required' => 'โปรดกรอกรหัสผ่าน',
                'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
                'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
                'email.required' => 'โปรดกรอกอีเมล',
                'email.email' => 'โปรดกรอกอีเมลที่ถูกต้อง',
                'email.unique' => 'อีเมลนี้ถูกใช้ไปแล้ว',
            ]
        );

        $academicInfo = AcademicInfo::create();

        $credentials = Credentials::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user = User::create([
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'credential_id' => $credentials->id,
            'academic_id' => $academicInfo->id,
        ]);

        auth()->login($user);

        return redirect('/')->with('success_message', 'สร้างบัญชีผู้ใช้งานสำหรับ ' . $request->input('username') . ' เสร็จสิ้น');
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
