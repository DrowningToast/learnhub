<?php

namespace App\Http\Controllers;

use App\Models\Chapters;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProgressByUserByCourse;
use App\Models\QuizScoreByUser;
use App\Models\Quizzes;
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
    public function show(int $course, string $chapId)
    {
        // if (request()->input('doquiz') === "true") {
        //     $chap = Chapters::find($chapId);
        //     if (QuizScoreByUser::where('quiz_id', $chap['quizz']['id'])->where('user_id', auth()->user()->id)->first()) {
        //         return redirect(url()->current())->with('error_message', 'คุณได้ทำแบบทดสอบนี้ไปแล้ว');
        //     }
        // }
        $course = Courses::find($course);
        $chapter = Chapters::find($chapId);
        // dd($chapter)
        $newArr = array_map(function ($v, $k) {
            $v['chapId'] = $k + 1;
            return $v;
        }, $course['chapters']->toArray(), array_keys($course['chapters']->toArray()));
        // dd($newArr);
        return view('courses.video', [
            'allChaps' => $newArr,
            'course' => $course,
            'chapter' => $chapter
        ]);
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

    public function quiz(string $course, string $chapter)
    {
        $score = 0;
        $quiz = Quizzes::where('chapter_id', $chapter)->first();
        $quiz_data = json_decode($quiz['quiz_data']);
        $answers = request()->all();
        $counter = 1;
        foreach ($quiz_data as $question) {
            // dd($question);
            if ($question->answer == $answers['q' . $counter]) {
                $score++;
            }
            $counter++;
        }

        $chaptarget = Chapters::find($chapter);

        QuizScoreByUser::create([
            'quiz_id' => $chaptarget['quizz']['id'],
            'user_id' => auth()->user()->id,
            'answer_data' => "[a, c, b]",
            'submitted_at' => now(),
            'score' => $score
        ]);

        ProgressByUserByCourse::create([
            "user_id" => auth()->user()->id,
            "course_id" => $course,
            "chapter_id" => $chapter
        ]);

        return redirect(sprintf('/learn/%s/%s?score=%u', $course, $chapter, $score));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
