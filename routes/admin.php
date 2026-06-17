<?php

use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\TopicController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('topics', TopicController::class);
    Route::resource('lessons', LessonController::class);

    Route::post('publish/{lesson}', [LessonController::class, 'toggle_publish'])->name("lessons.publish");
});
