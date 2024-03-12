<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Reviews;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $coursesPagination = Courses::latest()->filter([
            'title' => request('search-course'),
            'categoryId' => request('filter-course'),
        ])->paginate(8)->fragment('all-course');

        $coursesPagination->map(function ($course) {
            // GET COURSE DURATIONS
            $duration = $course->chapters->sum('durationInMinutes');
            $hours = floor($duration / 60);
            $minutes = $duration % 60;
            $course['duration'] = $hours . ' ชั่วโมง ' . $minutes . ' นาที';

            // GET COURSE RATINGS
            $course['rating'] = $course->reviews->avg('rating');

            return [
                $course
            ];
        });

        // TOP REVIEWS
        $top_review = Reviews::whereNot('comment', "=", null)->orderBy('rating', 'desc')->inRandomOrder()->take(3)->get();

        return view('welcome', [
            'top_review' => $top_review,
            'courses' => $coursesPagination,
        ]);
    }
}
