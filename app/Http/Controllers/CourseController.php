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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['buy_price'] = $request->buy_price ? number_format($request->buy_price, 2) : null;
        $request['discount_percent'] = $request->discount_percent ? number_format($request->discount_percent, 2) : null;

        $formFields = $request->validate([
            'title' => ['required'],
            'buy_price' => ['decimal:2', 'nullable'],
            'discount_percent' => ['decimal:2', 'nullable'],
            'cover_image_src' => ['mimes:jpeg,png,jpg,webp', 'required']
        ], [
            'title.required' => 'โปรดใส่ชื่อคอร์ส',
            'buy_price.decimal' => 'ราคาคอร์สเรียนต้องเป็นตัวเลข หรือทศนิยม',
            'discount_percent.numeric' => 'เปอร์เซนต์ส่วนลดต้องเป็นตัวเลข หรือทศนิยม',
            'cover_image_src.image' => 'โปรดใส่ไฟล์รูปภาพเท่านั้น',
            'cover_image_src.mimes' => 'ไฟล์รูปภาพต้องเป็นรูปภาพชนิด jpeg, png, jpg, webp เท่านั้น',
            'cover_image_src.required' => 'โปรดใส่ไฟล์รูปภาพ'
        ]);

        $formFields['lecturer_id'] = auth()->id();

        $formFields['cover_image_src'] = Storage::disk('sftp')->put('courses', $request->cover_image_src);
        $formFields['cover_image_src'] = 'https://' . env('SFTP_HOST') . '/' . Storage::disk('sftp')->url($formFields['cover_image_src']);

        $formFields['buy_price'] = number_format($formFields['buy_price'], 2);

        if (!$formFields['discount_percent']) {
            $formFields['discount_percent'] = 0;
        }

        $course = Courses::create($formFields);

        return redirect()->route('courses.show', $course->id)->with('success_message', 'สร้างคอร์มเรียนใหม่สำเร็จ!');
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
