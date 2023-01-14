<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ModuleController;
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

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/courses/{course}/modules', [ModuleController::class, 'index'])->name('modules.index');

Route::get('/modules/{module}/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');

Route::get('/', function () {
    return response()->json([
        'ping' => 'pong'
    ]);
});
