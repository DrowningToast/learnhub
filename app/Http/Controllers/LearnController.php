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
                    "progress" => $completed > 0 ? $completed / count($course->chapters) * 100 : 0,
                    "href" => $course->id,
                    'totalChapters' => count($course->chapters),
                    'completedChapters' => $completed
                ];
            }
        );

        $avg_progress = $courses->avg('progress');

        // dd($avg_progress);

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
        if (request()->has('title') && request('title') != '') {
            $courses = $courses->filter(
                function ($course) {
                    $course = $course->course;
                    return str_contains(strtolower($course['title']), strtolower(request('title')));
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
            'oldInputValue' => request('title'),
            'avg_progress' => intval($avg_progress)
        ]);
    }

    public function show(Courses $course)
    {

        $progress = ProgressByUserByCourse::where('course_id', $course->id)->where('user_id', auth()->id())->get();

        $review = Reviews::where('course_id', $course->id)->where('user_id', auth()->id())->first();
        $review = $review === null ? ['rating' => 0, 'comment' => ""] : $review;



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
