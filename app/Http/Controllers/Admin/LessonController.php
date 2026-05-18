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
        }])->select('id', 'title', 'is_published')->get();

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

    public function edit(Lesson $lesson)
    {
        $topics = Topic::select('id', 'name')->get();
        return view('lessons.edit', compact('lesson', 'topics'));
    }

    public function update(LessonValidationRequest $request, Lesson $lesson)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['slug']);


        $validated['widget_html'] = $request->input('widget_html') ?? $lesson->widget_html;

        $validated['is_published'] = false;

        $lesson->update($validated);

        return redirect()->route('admin.lessons.index')->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
