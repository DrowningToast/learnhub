<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    public function manage()
    {
        return view('courses.manage', [
            'courses' => Courses::where('lecturer_id', auth()->id())->get()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['buy_price'] = $request->buy_price ? number_format($request->buy_price, 2) : 0;
        $request['discount_percent'] = $request->discount_percent ? number_format($request->discount_percent, 2) : 0;

        $formFields = $request->validate([
            'title' => ['required'],
            'buy_price' => ['required'],
            'discount_percent' => ['required'],
            'cover_image_src' => ['mimes:jpeg,png,jpg,webp', 'required']
        ], [
            'title.required' => 'โปรดใส่ชื่อคอร์ส',
            'cover_image_src.image' => 'โปรดใส่ไฟล์รูปภาพเท่านั้น',
            'cover_image_src.mimes' => 'ไฟล์รูปภาพต้องเป็นรูปภาพชนิด jpeg, png, jpg, webp เท่านั้น',
            'cover_image_src.required' => 'โปรดใส่ไฟล์รูปภาพ',
            'buy_price.required' => 'โปรดใส่ราคาคอร์สเรียน',
            'discount_percent.required' => 'โปรดใส่เปอร์เซนต์ส่วนลด'
        ]);

        $formFields['lecturer_id'] = auth()->id();

        $formFields['cover_image_src'] = Storage::disk('sftp')->put('courses', $request->cover_image_src);
        $formFields['cover_image_src'] = 'https://' . env('SFTP_HOST') . '/' . Storage::disk('sftp')->url($formFields['cover_image_src']);

        $formFields['buy_price'] = number_format($formFields['buy_price'], 2);

        $course = Courses::create($formFields);

        return redirect()->route('courses.show', $course->id)->with('success_message', 'สร้างคอร์มเรียนใหม่สำเร็จ!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('courses.show', [
            'course' => Courses::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('courses.edit', [
            'course' => Courses::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $course)
    {
        if ($course->lecturer_id !== auth()->id()) {
            return back()->with('error_message', 'คุณไม่มีสิทธิ์แก้ไขคอร์สเรียนนี้');
        }

        if (!$request->buy_price) {
            $request['buy_price'] = 0.0;
        }

        if (!$request->discount_percent) {
            $request['discount_percent'] = 0.0;
        }

        $formFields = $request->validate([
            'title' => ['required'],
            'buy_price' => ['required'],
            'discount_percent' => ['required'],
        ], [
            'title.required' => 'โปรดใส่ชื่อคอร์ส',
            'buy_price.decimal' => 'ราคาคอร์สเรียนต้องเป็นตัวเลข หรือทศนิยม',
            'discount_percent.decimal' => 'เปอร์เซนต์ส่วนลดต้องเป็นตัวเลข หรือทศนิยม',
            'buy_price.required' => 'โปรดใส่ราคาคอร์สเรียน',
            'discount_percent.required' => 'โปรดใส่เปอร์เซนต์ส่วนลด'
        ]);

        if ($request->has('cover_image_src')) {
            $request->validate([
                'cover_image_src' => ['mimes:jpeg,png,jpg,webp']
            ], [
                'cover_image_src.mimes' => 'ไฟล์รูปภาพต้องเป็นรูปภาพชนิด jpeg, png, jpg, webp เท่านั้น',
                'cover_image_src.required' => 'โปรดใส่ไฟล์รูปภาพ'
            ]);

            $formFields['cover_image_src'] = Storage::disk('sftp')->put('courses', $request->cover_image_src);
            $formFields['cover_image_src'] = 'https://' . env('SFTP_HOST') . '/' . Storage::disk('sftp')->url($formFields['cover_image_src']);
        }

        $course->update($formFields);

        return redirect("/courses/" . $course->id)->with('success_message', 'อัพเดทคอร์สเรียนสำเร็จ!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
