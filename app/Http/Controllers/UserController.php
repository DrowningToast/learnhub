<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Enums\RoleEnum;
use App\Models\Credentials;
use Illuminate\Http\Request;
use App\Models\AcademicInfos;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
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
        //dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'role' => ['required', new Enum(RoleEnum::class)],
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

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $academicInfos = AcademicInfos::create();

            $credentials = Credentials::create([
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
            ]);

            $user = Users::create([
                'role' => $request->input('role'),
                'email' => $request->input('email'),
                'credential_id' => $credentials->id,
                'academic_id' => $academicInfos->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error_message', 'เกิดข้อผิดพลาดในการสร้างบัญชีผู้ใช้งาน');
        }

        auth()->login($user);

        return redirect('/')->with('success_message', 'สร้างบัญชีผู้ใช้งานสำหรับ ' . $request->input('username') . ' เสร็จสิ้น');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => ['required'],
                'password' => ['required', 'min:8'],
            ],
            [
                'username.required' => 'โปรดกรอกชื่อผู้ใช้',
                'password.required' => 'โปรดกรอกรหัสผ่าน',
                'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (auth()->attempt((['username' => $request->input('username'), 'password' => $request->input('password')]))) {
            return redirect('/')->with('success_message', 'เข้าสู่ระบบสำเร็จ');
        }

        return back()->with('error_message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
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

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success_message', 'ออกจากระบบเสร็จสิ้น');
    }
}
