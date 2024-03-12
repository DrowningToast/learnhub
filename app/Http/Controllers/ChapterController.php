<?php

namespace App\Http\Controllers;

use App\Models\Chapters;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ChapterController extends Controller
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
    public function create(Courses $course)
    {
        return view('chapters.create', ['course' => $course]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Courses $course, )
    {

        // VALIDATE REQUEST
        $formFields = $request->validate([
            'title' => ['required'],
            'durationInMinutes' => ['required', 'numeric', 'min:1'],
        ], [
            'title.required' => 'โปรดใส่ชื่อบทเรียน',
            'durationInMinutes.required' => 'โปรดใส่ระยะเวลาของบทเรียน',
            'durationInMinutes.numeric' => 'โปรดใส่ระยะเวลาของบทเรียนเป็นตัวเลขเท่านั้น',
            'durationInMinutes.min' => 'โปรดใส่ระยะเวลาของบทเรียนมากกว่า 0',
        ]);

        $formFields['video_src'] = $request->video_src;
        $formFields['description'] = $request->description;
        $formFields['course_id'] = $course->id;

        // RETRIVE UPLOADED FILES
        $files = $request->file('attachment');

        DB::beginTransaction();

        try {
            // CREATE CHAPTER
            $chapter = $course->chapters()->create($formFields);

            // CREATE FILES
            if ($files) {
                foreach ($files as $file) {
                    $uploadedFile = Storage::disk('azure')->put('files', $file);
                    $path = Storage::disk('azure')->url($uploadedFile);
                    $chapter->files()->create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'chatper_id' => $chapter->id,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'เกิดข้อผิดพลาดในการสร้างบทเรียน');
        }

        return redirect('courses/' . $course->id . '/chapters/' . $chapter->id . '/quizzes/create/')->with('success_message', 'บทเรียนถูกสร้างเรียบร้อยแล้ว คุณสามารถเพิ่มแบบทดสอบได้เลย');
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
    public function edit(Request $request, string $id)
    {
        $chapterId = explode('/', $request->fullUrl())[6];

        $chapter = Chapters::find($chapterId);
        $course = $chapter->course;

        return view('chapters.edit', [
            'chapter' => $chapter,
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $chapterId = explode('/', $request->fullUrl())[6];
        $chapter = Chapters::find($chapterId);

        if ($request->has('delete')) {
            $chapter->delete();
            return redirect('/learn/' . $chapter->course->id)->with('success_message', 'บทเรียนถูกลบเรียบร้อยแล้ว');
        }

        $formFields = $request->validate([
            'title' => ['required'],
            'durationInMinutes' => ['required', 'numeric', 'min:1'],
        ], [
            'title.required' => 'โปรดใส่ชื่อบทเรียน',
            'durationInMinutes.required' => 'โปรดใส่ระยะเวลาของบทเรียน',
            'durationInMinutes.numeric' => 'โปรดใส่ระยะเวลาของบทเรียนเป็นตัวเลขเท่านั้น',
            'durationInMinutes.min' => 'โปรดใส่ระยะเวลาของบทเรียนมากกว่า 0',
        ]);

        $formFields['video_src'] = $request->video_src;
        $formFields['description'] = $request->description;

        $chapter->update($formFields);

        return redirect('/learn/' . $chapter->course->id)->with('success_message', 'บทเรียนถูกแก้ไขเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
