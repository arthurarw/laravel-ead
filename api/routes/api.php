<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\ReplySupportController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth', [AuthController::class, 'auth'])->name('auth.auth');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])
    ->name('reset.password.send.reset.link');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
    ->name('reset.password.reset.password');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/me', [AuthController::class, 'me'])->name('auth.me');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    Route::get('/courses/{course}/modules', [ModuleController::class, 'index'])->name('modules.index');

    Route::get('/modules/{module}/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');

    Route::get('/supports/me', [SupportController::class, 'mySupports'])->name('supports.my.supports');
    Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');
    Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');

    //Route::get('/supports/{support}/replies', [SupportController::class, 'getReplies'])->name('supports.get.replies');
    Route::post('/replies', [ReplySupportController::class, 'store'])->name('reply.supports.store');
});

