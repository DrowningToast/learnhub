<?php

use App\Enums\RoleEnum;
use App\Models\Courses;
use App\Models\Reviews;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ChapterController;
use App\Http\Middleware\LecturerRouteGuard;
use App\Http\Middleware\ModeratorRouteGuard;
use App\Http\Controllers\ModeratorController;
use App\Http\Middleware\ModAndLectRouteGuard;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckIsProfileComplete;
use App\Models\Chapters;
use App\Models\Quizzes;

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

Route::get('/', [Controller::class, 'index']);


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

// Show Withdrawal Request (Approve & Reject)
Route::get('/moderator/withdraw', [ModeratorController::class, 'transaction'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::put('/moderator/withdraw/approve', [ModeratorController::class, 'approve'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::put('/moderator/withdraw/reject', [ModeratorController::class, 'reject'])->middleware(['auth', ModeratorRouteGuard::class]);

// edit (any) profile (moderator)
Route::get('/moderator/user/edit/{id}', [UserController::class, 'edit'])->middleware(['auth', ModeratorRouteGuard::class]);
Route::get('/moderator/lecturer/edit/{id}', [UserController::class, 'edit'])->middleware(['auth', ModeratorRouteGuard::class]);

// Transactions
Route::get('lecturer/transaction', [TransactionController::class, 'index'])->middleware(['auth', LecturerRouteGuard::class]);

// Manage Withdrawals (Lecturer) 
Route::get('/lecturer/withdraw', [WithdrawalController::class, 'index'])->middleware(['auth', LecturerRouteGuard::class]);
Route::post('/lecturer/withdraw', [WithdrawalController::class, 'store'])->middleware(['auth', LecturerRouteGuard::class]);

// Show Learn Dashboard for Learners and Lecturers
Route::get('/learn', [LearnController::class, 'index'])->middleware(['auth', CheckIsProfileComplete::class]);
Route::get('/learn/{course}', [LearnController::class, 'show'])->middleware('auth', CheckIsProfileComplete::class);
Route::post('/learn/{course}/review', [LearnController::class, 'review'])->middleware('auth', CheckIsProfileComplete::class);

// Show Chapter Video
Route::get('/learn/{course}/{chapId}', [ChapterController::class, 'show']);

// Check answer quiz
Route::post('/learn/{course}/quiz/{chapter}', [ChapterController::class, 'quiz']);

// Edit (Self) Profile
Route::get('/profile', [UserController::class, 'edit'])->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth');

// Create Chapter
Route::get('/courses/{course}/chapters/create', [ChapterController::class, 'create'])->middleware(['auth', ModAndLectRouteGuard::class]);
Route::post('/courses/{course}/chapters/create', [ChapterController::class, 'store'])->middleware(['auth', ModAndLectRouteGuard::class]);

// Create Quiz
Route::get('/courses/{course}/chapters/{chapter}/quizzes/create', [QuizController::class, 'create'])->middleware(['auth', ModAndLectRouteGuard::class]);
Route::post('/courses/{course}/chapters/{chapter}/quizzes/create', [QuizController::class, 'store'])->middleware(['auth', ModAndLectRouteGuard::class]);

// Edit Quiz
Route::get('/courses/{course}/chapters/{chapter}/quizzes/edit ', [QuizController::class, 'edit'])->middleware(['auth', ModAndLectRouteGuard::class]);
Route::post('/courses/{course}/chapters/{chapter}/quizzes/edit', [QuizController::class, 'update'])->middleware(['auth', ModAndLectRouteGuard::class]);

// Edit Chapter
Route::get('/courses/{course}/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->middleware(['auth', ModAndLectRouteGuard::class]);
Route::put('/courses/{course}/chapters/{chapter}/edit', [ChapterController::class, 'update'])->middleware(['auth', ModAndLectRouteGuard::class]);

// Stripe Payment
Route::get('/courses/{course}/checkout', [StripeController::class, 'checkout'])->middleware(['auth'])->name('checkout');
Route::get('/success', [StripeController::class, 'success'])->middleware(['auth'])->name('checkout.success');
Route::get('/cancel', [StripeController::class, 'cancel'])->middleware(['auth'])->name('checkout.cancel');

// ENROLL BY REDEEM REWARD POINTS
Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->middleware(['auth', CheckIsProfileComplete::class]);
