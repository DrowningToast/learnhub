<?php

use App\Enums\RoleEnum;
use App\Models\Courses;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Middleware\LecturerRouteGuard;
use App\Http\Middleware\ModeratorRouteGuard;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckIsProfileComplete;
use App\Http\Middleware\ModAndLectRouteGuard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// LOGIN / REGISTER / LOGOUT
Route::get('/login', [UserController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');

Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');


// Create Course
Route::get('/courses/create', [CourseController::class, 'create'])->middleware('auth', LecturerRouteGuard::class);
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth');

// Show Course
Route::get('/courses/{course}', [CourseController::class, 'show']);


// Edit Course (Lecturer & Moderator)
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware(['auth', ModAndLectRouteGuard::class]);
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(['auth', ModAndLectRouteGuard::class]);

// For moderator
// Show Moderator Dashboard / Manage Courses / Manage Lecturers / Manage Learners / Manage Withdrawals
Route::get('/moderator', [ModeratorController::class, 'index'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/course', [ModeratorController::class, 'course'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/lecturer', [ModeratorController::class, 'lecturer'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/learner', [ModeratorController::class, 'learner'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/withdraw', [ModeratorController::class, 'transaction'])->middleware(['auth', ModeratorRouteGuard::class]);

// edit (any) profile (moderator)
Route::get('/moderator/user/edit/{id}', [UserController::class, 'edit'])->middleware(['auth', ModeratorRouteGuard::class]);

// Transactions
Route::get('lecturer/transaction', [TransactionController::class, 'index'])->middleware(['auth', LecturerRouteGuard::class]);

// Manage Withdrawals (Lecturer) 
Route::get('/lecturer/withdraw', [WithdrawalController::class, 'index'])->middleware(['auth', LecturerRouteGuard::class]);
Route::post('/lecturer/withdraw', [WithdrawalController::class, 'store'])->middleware(['auth', LecturerRouteGuard::class]);

// Show Learn Dashboard for Learners and Lecturers
Route::get('/learn', function () {
    return view('courses.index', [
        'user' => auth()->user(),
        'enrolledCourses' => auth()->user()->enrolledCourses(),
        'popularCourses' => Courses::latest()->take(5)->get(),
        'isLecturer' => auth()->user()->role->value == RoleEnum::Lecturer->value,
        'managedCourses' => Courses::where('lecturer_id', auth()->id())->latest()->get()
    ]);
})->middleware(['auth', CheckIsProfileComplete::class]);

// Show Chapter Video
Route::get('/learn/{course}/{vdoId}', function (int $course, string $vdoId) {
    // $course = Courses::find($course);
    $video = [
        [
            'chapNo' => 1,
            'title' => 'Sex Video',
            'id' => $vdoId
        ],
        [
            'chapNo' => 2,
            'title' => 'Sex Video 2',
            'id' => $vdoId
        ],
        [
            'chapNo' => 3,
            'title' => 'Sex Video 3',
            'id' => $vdoId
        ],
        [
            'chapNo' => 4,
            'title' => 'Sex Video 4',
            'id' => $vdoId
        ],
        [
            'chapNo' => 5,
            'title' => 'Sex Video 5',
            'id' => $vdoId
        ],
    ];
    return view('courses.video', [
        'ytid' => $vdoId,
        'courseid' => $course
    ]);
});

// Check answer quiz
Route::post('/learn/{course}/quiz/{chapter}', function () {
    dd(request()->all());
    return response()->json([
        'status' => 'success',
        'message' => 'Correct Answer'
    ]);
});

// Edit (Self) Profile
Route::get('/profile', [UserController::class, 'edit'])->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth');
