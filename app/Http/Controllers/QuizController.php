<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Chapters;
use App\Models\Quizzes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuizController extends Controller
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
    public function create(Courses $course, Chapters $chapter)
    {
        return view('quizzes.create', [
            'course' => $course,
            'chapter' => $chapter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $chapterId = explode('/', $request->path())[3];

        $formFields = $request->validate([
            'q1_question' => ['required', 'string'],
            'q1_choice_a' => ['required', 'string'],
            'q1_choice_b' => ['required', 'string'],
            'q1_choice_c' => ['required', 'string'],
            'q1_answer' => ['required', 'string', Rule::notIn(['โปรดเลือกคำตอบที่ถูกต้อง'])],
            'q2_question' => ['required', 'string'],
            'q2_choice_a' => ['required', 'string'],
            'q2_choice_b' => ['required', 'string'],
            'q2_choice_c' => ['required', 'string'],
            'q2_answer' => ['required', 'string', Rule::notIn(['โปรดเลือกคำตอบที่ถูกต้อง'])],
            'q3_question' => ['required', 'string'],
            'q3_choice_a' => ['required', 'string'],
            'q3_choice_b' => ['required', 'string'],
            'q3_choice_c' => ['required', 'string'],
            'q3_answer' => ['required', 'string', Rule::notIn(['โปรดเลือกคำตอบที่ถูกต้อง'])]
        ], [
            'q1_answer.not_in' => 'โปรดเลือกคำตอบที่ถูกต้อง แบบทดสอบ ข้อ 1.',
            'q2_answer.not_in' => 'โปรดเลือกคำตอบที่ถูกต้อง แบบทดสอบ ข้อ 2.',
            'q3_answer.not_in' => 'โปรดเลือกคำตอบที่ถูกต้อง แบบทดสอบ ข้อ 3.',
            'q1_question.required' => 'โปรดกรอกคำถาม แบบทดสอบ ข้อ 1.',
            'q1_choice_a.required' => 'โปรดกรอกตัวเลือกข้อ ก. แบบทดสอบ ข้อ 1.',
            'q1_choice_b.required' => 'โปรดกรอกตัวเลือกข้อ ข. แบบทดสอบ ข้อ 1.',
            'q1_choice_c.required' => 'โปรดกรอกตัวเลือกข้อ ค. แบบทดสอบ ข้อ 1.',
            'q1_answer.required' => 'โปรดเลือกคำตอบที่ถูกต้อง แบบทดสอบ ข้อ 1.',
            'q2_question.required' => 'โปรดกรอกคำถาม แบบทดสอบ ข้อ 2.',
            'q2_choice_a.required' => 'โปรดกรอกตัวเลือกข้อ ก. แบบทดสอบ ข้อ 2.',
            'q2_choice_b.required' => 'โปรดกรอกตัวเลือกข้อ ข. แบบทดสอบ ข้อ 2.',
            'q2_choice_c.required' => 'โปรดกรอกตัวเลือกข้อ ค. แบบทดสอบ ข้อ 2.',
            'q2_answer.required' => 'โปรดเลือกคำตอบที่ถูกต้อง แบบทดสอบ ข้อ 2.',
            'q3_question.required' => 'โปรดกรอกคำถาม แบบทดสอบ ข้อ 3.',
            'q3_choice_a.required' => 'โปรดกรอกตัวเลือกข้อ ก. แบบทดสอบ ข้อ 3.',
            'q3_choice_b.required' => 'โปรดกรอกตัวเลือกข้อ ข. แบบทดสอบ ข้อ 3.',
            'q3_choice_c.required' => 'โปรดกรอกตัวเลือกข้อ ค. แบบทดสอบ ข้อ 3.',
            'q3_answer.required' => 'โปรดเลือกคำตอบที่ถูกต้อง แบบทดสอบ ข้อ 3.'
        ]);

        $quiz = array(
            'q1' => [
                'question' => $formFields['q1_question'],
                'choice_a' => $formFields['q1_choice_a'],
                'choice_b' => $formFields['q1_choice_b'],
                'choice_c' => $formFields['q1_choice_c'],
                'answer' => $formFields['q1_answer']
            ],
            'q2' => [
                'question' => $formFields['q2_question'],
                'choice_a' => $formFields['q2_choice_a'],
                'choice_b' => $formFields['q2_choice_b'],
                'choice_c' => $formFields['q2_choice_c'],
                'answer' => $formFields['q2_answer']
            ],
            'q3' => [
                'question' => $formFields['q3_question'],
                'choice_a' => $formFields['q3_choice_a'],
                'choice_b' => $formFields['q3_choice_b'],
                'choice_c' => $formFields['q3_choice_c'],
                'answer' => $formFields['q3_answer']
            ]
        );

        $quizJson = json_encode($quiz);

        // SAVE QUIZ TO DATABASE
        $quiz = Quizzes::create([
            'title' => 'QUIZ',
            'chapter_id' => intval($chapterId),
            'quiz_data' => $quizJson,
        ]);

        return redirect('/learn/' . $request->course_id)->with('success_message', 'แบบทดสอบถูกสร้างเรียบร้อยแล้ว');
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
