<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect(route('home'));
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/type/{type}/id/{id}', [AdminController::class, 'CourseShow'])->name('course.show');
    Route::get('/course/{id}/edit', [AdminController::class, 'CourseEdit'])->name('course.edit');
    Route::patch('/course/{id}', [AdminController::class, 'CourseUpdate'])->name('course.update');
    Route::get('/course/create', [AdminController::class, 'CourseCreate'])->name('course.create');
    Route::post('/course', [AdminController::class, 'CourseStore'])->name('course.store');
    Route::delete('/delete/course/{id}', [AdminController::class, 'DeleteCourse'])->name('delete');
    Route::delete('/delete/course/{course}/user/{user}', [AdminController::class, 'UnsubUser'])->name('user.unsub');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/main', [IndexController::class, 'index'])->name('home');
Route::get('/type/{type}', [IndexController::class, 'type'])->name('artType');

Route::middleware('auth')->group(function () {
    Route::get('/account', [IndexController::class, 'account'])->name('account');
    Route::get('/check/{course}', [ActionController::class, 'check'])->name('check');
    Route::post('/enroll/{course}', [ActionController::class, 'store'])->name('enroll.store');
    Route::post('/enroll/{course}/cancel', [ActionController::class, 'cancel'])->name('enroll.cancel');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';