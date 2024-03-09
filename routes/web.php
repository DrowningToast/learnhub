<?php

use App\Http\Controllers\UserController;
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

Route::get('/learn', function () {
    return view('courses.index');
});
// ->middleware('auth');
// COURSES

// WIP
Route::get('/courses/{id}', function ($id) {
    return view('courses.show');
});

// Edit Profile
Route::get('/profile', [UserController::class, 'edit'])->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth');