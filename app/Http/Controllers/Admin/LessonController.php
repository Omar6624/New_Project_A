<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\LessonValidationRequest;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with(['topic' => function ($q) {
            $q->select('id', 'name');
        }])->select('id', 'title')->get();

        $topics = Topic::select('id', 'name')->get();


        return view('lessons.index', compact('lessons', 'topics'));
    }


    public function store(LessonValidationRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['order_index'] = Lesson::max('order_index') + 1;

        $validatedData['slug'] = Str::slug($validatedData['slug']);

        Lesson::create($validatedData);

        return redirect()->route('admin.lessons.index')->with('success', 'Lesson created successfully.');
    }

    public function toggle_publish(Lesson $lesson)
    {

        $lesson->is_published = !$lesson->is_published;
        $lesson->save();

        $status = $lesson->is_published ? "Published" : "Unpublished";

        return redirect()->back()->with('success', $lesson->title . " is " . $status);
    }

    public function update(LessonValidationRequest $request, $lesson)
    {
        $validated = $request->validated();
    }
}
