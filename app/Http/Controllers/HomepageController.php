<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Topic;

class HomepageController extends Controller
{
    //

    public function index()
    {
        $lessons = Lesson::where('is_published', true)->select('id', 'title', 'slug')->orderBy('order_index', 'desc')->get();
        return view('homepage.index', compact('lessons'));
    }

    public function lessonView($slug)
    {

        $lesson = Lesson::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('homepage.lesson', compact('lesson'));
    }
}
