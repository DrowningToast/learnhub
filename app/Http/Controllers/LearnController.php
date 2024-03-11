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
                    "progress" => $completed / count($course->chapters) * 100,
                    "href" => $course->id,
                ];
            }
        );

        $popularCoursesByIds = CourseByUser::query()->groupBy('course_id')->select('course_id', DB::raw('count(*) as total'))->orderBy('total', 'desc')->limit(5)->get();

        $popularCourses = $popularCoursesByIds->map(
            function ($course) {
                return Courses::find($course->course_id);
            }
        );

        // SORT BY ENROLLED OPTIONS
        if (request('time') == 'latest') {
            $courses = $courses->sortByDesc(
                function ($course) {
                    return $course['enrolled'];
                }
            );
        } else if (request('time') == 'oldest') {
            $courses = $courses->sortBy(
                function ($course) {
                    return $course['enrolled'];
                }
            );
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
        if (request('categoryId')) {
            $courses = $courses->filter(
                function ($course) {
                    return $course['category_id'] == request('categoryId');
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
