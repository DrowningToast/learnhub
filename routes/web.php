<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LecturerRouteGuard;
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

route::get('/test', function () {
    return view('chapter');
});
// Create Course
Route::get('/courses/create', [CourseController::class, 'create'])->middleware('auth');
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth');

// Show Course / Update Course
Route::get('/courses/manage', [CourseController::class, 'manage'])->middleware(['auth', LecturerRouteGuard::class]);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware(['auth', LecturerRouteGuard::class]);
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(['auth', LecturerRouteGuard::class]);

// Transactions
Route::get('lecturer/transaction', [TransactionController::class, 'index'])->middleware(['auth', LecturerRouteGuard::class]);

Route::get('/learn', function () {

    // dd(auth()->user()->role->value == RoleEnum::Lecturer->value);

    $user = auth()->user();

    if ($user->first_name == null || $user->last_name == null || $user->phone == null || $user->address == null) {
        return redirect('/profile')->with('error_message', 'โปรดกรอกข้อมูลส่วนตัวให้ครบถ้วนก่อนเริ่มเรียน');
    }

    return view('courses.index', [
        'user' => auth()->user(),
        'enrolledCourses' => auth()->user()->enrolledCourses(),
        'popularCourses' => Courses::latest()->take(5)->get(),
        'isLecturer' => auth()->user()->role->value == RoleEnum::Lecturer->value,
        'managedCourses' => Courses::where('lecturer_id', auth()->id())->latest()->get()
    ]);
})->middleware('auth');

// Edit (self) profile
Route::get('/profile', [UserController::class, 'edit'])->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth');

