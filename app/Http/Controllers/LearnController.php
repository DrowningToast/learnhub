<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Courses;
use App\Models\ProgressByUserByCourse;

class LearnController extends Controller
{
    //
    public function index() {
        $courses = auth()->user()->enrolledCourses->map(
            function ($courseByUser) {
                $course = $courseByUser->course;
                $completed = count(ProgressByUserByCourse::where('course_id', $course->id)->where('user_id', auth()->id())->get());
                return [
                    "title" => $course->title,
                    "description" => $course->description,
                    "author" => $course->lecturer->first_name . " " . $course->lecturer->last_name,
                    "cover_image_src" => $course->cover_image_src,
                    "progress" => $completed / count($course->chapters) * 100,
                    "href" => $course->id,
                ];
            }   
        );

        return view('learn.index', [
            'user' => auth()->user(),
            'enrolledCourses' => $courses,
            'popularCourses' => Courses::latest()->take(5)->get(),
            'isLecturer' => auth()->user()->role->value == RoleEnum::Lecturer->value,
            'managedCourses' => Courses::where('lecturer_id', auth()->id())->latest()->get()
        ]);
    }

    public function show(Courses $course) {

        $progress = ProgressByUserByCourse::where('course_id', $course->id)->where('user_id', auth()->id())->get();

        return view('learn.show', [
            'course' => $course,
            'progress' => $progress
        ]);
    }
}
