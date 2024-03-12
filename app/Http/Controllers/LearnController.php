<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Courses;
use App\Models\CourseByUser;
use App\Models\Reviews;
use Illuminate\Support\Facades\DB;
use App\Models\ProgressByUserByCourse;
use Illuminate\Http\Request;

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

        $popularCoursesByIds = CourseByUser::query()->groupBy('course_id')->select('course_id', DB::raw('count(*) as total'))->orderBy('total', 'desc')->limit(3)->get();

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

        $review = Reviews::where('course_id', $course->id)->where('user_id', auth()->id())->first();

        return view('learn.show', [
            'course' => $course,
            'review' => $review,
            'progress' => $progress,
            'isLearner' => auth()->user()->role->value == RoleEnum::Learner->value,
        ]);
    }

    /**
     * Submit a review
     */
    public function review(Request $request, Courses $course)
    {
        $fields = $request->validate([
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'comment' => ['string', 'nullable']
        ], [
            'rating.required' => 'โปรดให้คะแนน',
            'rating.numeric' => 'โปรดให้คะแนนเป็นตัวเลข',
            'rating.min' => 'โปรดให้คะแนนมากกว่าหรือเท่ากับ 1',
            'rating.max' => 'โปรดให้คะแนนน้อยกว่าหรือเท่ากับ 5',
            'comment.string' => 'ความคิดเห็นต้องเป็นข้อความ'
        ]);

        // Find if the user owns the course or not
        $owned = CourseByUser::where('course_id', $course->id)->where('user_id', auth()->id())->exists();
        if (!$owned) {
            return back()->with('error_message', 'คุณต้องซื้อคอร์สเรียนนี้ก่อนที่จะสามารถรีวิวได้');
        }

        // Find if the user has already reviewed the course or not
        $review = Reviews::where('course_id', $course->id)->where('user_id', auth()->id())->first();

        try {
            // If the user has already reviewed the course, update the review
            if ($review) {
                $review->update($fields);
                return back()->with('success_message', 'อัพเดทรีวิวสำเร็จ!');
            } else {
                // If the user has not reviewed the course, create a new review
                $fields['course_id'] = $course->id;
                $fields['user_id'] = auth()->id();
                Reviews::create($fields);
                return back()->with('success_message', 'รีวิวสำเร็จ!');
            }
        } catch (e) {
            return back()->with('error_message', 'รีวิวไม่สำเร็จ! ลองอีกครั้งหนึ่งในภายหลัง');
        }
    }
}
