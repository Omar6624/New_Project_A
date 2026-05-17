<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomepageController::class, 'index'])->name('lessons.index');
Route::get('/lesson/{slug}', [HomepageController::class, 'lessonView'])->name('lessons.show');
