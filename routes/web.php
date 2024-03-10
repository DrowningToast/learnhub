<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIsProfileComplete;
use App\Http\Middleware\LecturerRouteGuard;
use App\Http\Middleware\ModeratorRouteGuard;
use App\Models\Courses;
use Illuminate\Support\Facades\Route;

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

Route::get('/video', function () {
    return view('coursevideo');
});

<<<<<<< HEAD
<<<<<<< HEAD

    route::get('/test2', function(){
        return view('test2');
});
=======
route::get('/test', function(){
=======
route::get('/test', function () {
>>>>>>> b1b9e5b3b9f8bd03bc8f62e57652c6402f9ff763
    return view('chapter');
});
// Create Course
Route::get('/courses/create', [CourseController::class, 'create'])->middleware('auth', LecturerRouteGuard::class);
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth');

// Show Course / Update Course
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware(['auth', LecturerRouteGuard::class]);
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(['auth', LecturerRouteGuard::class]);

Route::get('/moderator', [ModeratorController::class, 'index'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/course', [ModeratorController::class, 'course'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/lecturer', [ModeratorController::class, 'lecturer'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/learner', [ModeratorController::class, 'learner'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/withdraw', [ModeratorController::class, 'transaction'])->middleware(['auth', ModeratorRouteGuard::class]);
// Transactions
Route::get('lecturer/transaction', [TransactionController::class, 'index'])->middleware(['auth', LecturerRouteGuard::class]);

Route::get('/learn', function () {
<<<<<<< HEAD
    return view('courses.index');
})->middleware('auth');
>>>>>>> 31aa3c1ec6bf23f1641a0965187a9c24d00f525d
=======
    return view('courses.index', [
        'user' => auth()->user(),
        'enrolledCourses' => auth()->user()->enrolledCourses(),
        'popularCourses' => Courses::latest()->take(5)->get(),
        'isLecturer' => auth()->user()->role->value == RoleEnum::Lecturer->value,
        'managedCourses' => Courses::where('lecturer_id', auth()->id())->latest()->get()
    ]);
})->middleware(['auth', CheckIsProfileComplete::class]);

// Edit (self) profile
Route::get('/profile', [UserController::class, 'edit'])->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth');

>>>>>>> b1b9e5b3b9f8bd03bc8f62e57652c6402f9ff763
