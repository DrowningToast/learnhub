<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Courses;
use App\Models\CourseByUser;
use Illuminate\Support\Facades\DB;
use App\Models\ProgressByUserByCourse;

class LearnController extends Controller
{
    //
    public function index()
    {
        $courses = auth()->user()->enrolledCourses->map(
            function ($courseByUser) {
                $course = $courseByUser->course;
                $completed = count(ProgressByUserByCourse::where('course_id', $course->id)->where('user_id', auth()->id())->get());
                return [
                    "id" => $course->id,
                    "title" => $course->title,
                    "description" => $course->description,
                    "author" => $course->lecturer->first_name . " " . $course->lecturer->last_name,
                    "cover_image_src" => $course->cover_image_src,
                    "progress" => $completed > 0 ? $completed / count($course->chapters) * 100 : 0,
                    "href" => $course->id,
                ];
            }
        );

        $popularCoursesByIds = CourseByUser::query()->groupBy('course_id')->select('course_id', DB::raw('count(*) as total'))->orderBy('total', 'desc')->limit(3)->get();

        $popularCourses = $popularCoursesByIds->map(
            function ($course) {
                return Courses::find($course->course_id);
            }
        );

        // SORT BY ENROLLED OPTIONS
        if (request('time') == 'latest') {
            $courses = CourseByUser::latest('enrolled_at')->where('user_id', auth()->id())->get();
        } else if (request('time') == 'oldest') {
            $courses = CourseByUser::oldest('enrolled_at')->where('user_id', auth()->id())->get();
        }

        // FILTER BY TITLE
        if (request('title')) {
            $courses = $courses->filter(
                function ($course) {
                    return str_contains(strtolower($course['title']), strtolower(request('title')));
                }
            );
        }

        // FILTER BY CATEGORY ID
        if (request('categoryId') && request('categoryId') != 'ALL') {
            $courses = $courses->filter(
                function ($course) {
                    return intval($course->course['category_id']) == intval(request('categoryId'));
                }
            );

            $courses = $courses->map(
                function ($enrolledCourse) {
                    return $enrolledCourse->course;
                }
            );
        }

        return view('learn.index', [
            'user' => auth()->user(),
            'enrolledCourses' => $courses,
            "popularCourses" => $popularCourses,
            // 'popularCourses' => Courses::withCount('enrolledUsers')->orderBy('enrolled_users_count', 'desc')->limit(5)->get(),
            'isLecturer' => auth()->user()->role->value == RoleEnum::Lecturer->value,
            'managedCourses' => Courses::where('lecturer_id', auth()->id())->latest()->get(),
            'oldInputValue' => request('title')
        ]);
    }

    public function show(Courses $course)
    {

        $progress = ProgressByUserByCourse::where('course_id', $course->id)->where('user_id', auth()->id())->get();

        return view('learn.show', [
            'course' => $course,
            'progress' => $progress,
            'isLearner' => auth()->user()->role->value == RoleEnum::Learner->value,
        ]);
    }
}
