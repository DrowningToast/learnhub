<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Enums\RoleEnum;
use App\Models\Credentials;
use FileUploadController;
use Illuminate\Http\Request;
use App\Models\AcademicInfos;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $formFields = $request->validate(
            [
                'role' => ['required'],
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

        $formFields['password'] = bcrypt($formFields['password']);

        DB::beginTransaction();

        try {
            $academicInfos = AcademicInfos::create();

            $credentials = Credentials::create([
                'username' => $formFields['username'],
                'password' => $formFields['password'],
            ]);

            $user = Users::create([
                'role' => $formFields['role'],
                'email' => $formFields['email'],
                'credential_id' => $credentials->id,
                'academic_id' => $academicInfos->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error_message', 'เกิดข้อผิดพลาดในการสร้างบัญชีผู้ใช้งาน');
        }

        auth()->login($user, true);

        $registerSuccMessage = "สร้างบัญชีผู้ใช้งานสำหรับ " . $formFields["username"] . " เสร็จสิ้น ท่านสามารถล็อคอินได้ทันที";

        return redirect('/learn')->with('success_message', $registerSuccMessage);
    }

    public function login(Request $request)
    {
        $formFields = $request->validate(
            [
                'username' => ['required', Rule::exists('credentials', 'username')],
                'password' => ['required', 'min:8'],
            ],
            [
                'username.required' => 'โปรดกรอกชื่อผู้ใช้',
                'password.required' => 'โปรดกรอกรหัสผ่าน',
                'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
                'username.exists' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
            ]
        );

        $isUserSaveSession = $request->get('saveSession') !== null ? true : false;

        $credentials = Credentials::where('username', $formFields['username'])->first();
        if (!$credentials || !Hash::check($formFields['password'], $credentials->password)) {
            return back()->with('error_message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        }

        $user = Users::where('credential_id', $credentials->id)->first();
        auth()->login($user, $isUserSaveSession);

        if (auth()->user()->role === RoleEnum::Lecturer || auth()->user()->role === RoleEnum::Learner) {
            return redirect('/learn')->with('success_message', 'เข้าสู่ระบบสำเร็จ');
        } else if (auth()->user()->role === RoleEnum::Moderator) {
            return redirect('/moderator')->with('success_message', 'เข้าสู่ระบบสำเร็จ');
        } else {
            return redirect('/')->with('error_message', 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ');
        }
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
    public function edit(string $id = NULL)
    {
        if ($id === NULL) {
            $id = auth()->user()->id;
        }

        $user = Users::find($id);

        return view('profile.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = auth()->user()->id;

        // Validate the information
        $fields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'first_name' => ['string', "max:255", "nullable"],
            'last_name' => ['string', "max:255", "nullable"],
            'phone' => ['string', "digits_between:10,10", "nullable"],
            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', "nullable"],
            'year' => ['integer', 'min:1', 'max:8', "nullable"],
            'school' => ['string', "nullable"],
            'institute' => ['string', "nullable"],
            'campus' => ['string', "nullable"],
            "bankName" => ["string", "nullable"],
            "accountNumber" => ["string", "nullable"],
        ], [
            'email.required' => 'โปรดกรอกอีเมล',
            'email.email' => 'โปรดกรอกอีเมลที่ถูกต้อง',
            'email.unique' => 'อีเมลนี้ถูกใช้ไปแล้ว',
            'first_name.string' => 'ชื่อต้องเป็นตัวอักษร',
            'last_name.string' => 'นามสกุลต้องเป็นตัวอักษร',
            'phone.string' => 'โปรดกรอกเบอร์โทรศัพท์ที่ถูกต้อง',
            'phone.digits_between' => 'โปรดกรอกเบอร์โทรศัพท์ที่ถูกต้อง',
            'profile_image.image' => 'โปรดอัพโหลดไฟล์รูปภาพ',
            'profile_image.mimes' => 'โปรดอัพโหลดไฟล์รูปภาพที่ถูกต้อง',
            'profile_image.max' => 'ไฟล์รูปภาพต้องมีขนาดไม่เกิน 2MB',
            'year.integer' => 'โปรดกรอกระดับชั้นปีที่ถูกต้อง',
            'school.string' => 'โปรดกรอกชื่อโรงเรียนที่ถูกต้อง',
            'institute.string' => 'โปรดกรอกชื่อสถาบันที่ถูกต้อง',
            'campus.string' => 'โปรดกรอกชื่อวิทยาเขตที่ถูกต้อง',
        ]);

        $profileInfo = [
            'email' => $fields['email'],
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'phone' => $fields['phone'],
        ];

        $academicInfo = [
            'year' => $fields['year'],
            'school' => $fields['school'],
            'institute' => $fields['institute'],
            'campus' => $fields['campus'],
        ];

        $targetID = $id;
        // Validate the role
        if (auth()->user()->role === RoleEnum::Moderator) {
            $targetID = (int) $request->get('id');
        } else if ($id != auth()->user()->id) {
            return back()->with('error_message', 'คุณไม่มีสิทธิ์แก้ไขข้อมูลของผู้ใช้อื่น');
        }


        // update the information
        $target = Users::find($targetID);

        // dd($target->academicInfo);
        // update the academic information
        if ($target->academicInfo->exists()) {
            $target->academicInfo->update($academicInfo);
        } else {
            $academicInfoResult = $target->academicInfo()->create($academicInfo);
            $profileInfo['academic_id'] = $academicInfoResult->id;
        }

        // update the profile image src
        if ($request->profile_image_src) {
            $fileUpload = new FileController($request->profile_image_src);
            $URL = $fileUpload->upload('portrait', $target->id . "-portrait");
            $profileInfo['profile_image_src'] = $URL;
        }

        // If the user is a lecturer, update the banking information
        if (auth()->user()->role === RoleEnum::Lecturer) {
            $profileInfo['bankName'] = $fields['bankName'];
            $profileInfo['accountNumber'] = $fields['accountNumber'];
        }

        $target->update($profileInfo);

        if (auth()->user()->role === RoleEnum::Moderator) {
            return redirect('/moderator/learner/edit/' . $targetID)->with('success_message', 'อัพเดทข้อมูลสำเร็จ');
        } else {
            return $this->edit($id)->with('success_message', 'อัพเดทข้อมูลสำเร็จ');
        }
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

    public function getCurrentUser($academic = false)
    {
        if ($academic) {
            $user = Users::find(auth()->user()->id)->with('academicInfo')->get();
            return $user;
        } else {
            $user = Users::find(auth()->user()->id);
            return $user;
        }
    }

}
