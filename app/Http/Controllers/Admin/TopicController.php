<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Topic\TopicValidationRequest;
use App\Models\Topic;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index()
    {

        $topics = Topic::orderBy('order_index')->get();
        return view('topic.index', compact('topics'));
    }


    public function store(TopicValidationRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['order_index'] = Topic::max('order_index') + 1;

        $validatedData['slug'] = Str::slug($validatedData['slug']);

        Topic::create($validatedData);

        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully.');
    }



    public function edit(Topic $topic)
    {
        return view('topic.edit', compact('topic'));
    }

    public function update(TopicValidationRequest $request, Topic $topic)
    {
        $validatedData = $request->validated();

        $topic->update($validatedData);

        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        if ($topic->lessons()->exists()) {
            return back()->withErrors(['error' => 'Cannot delete topic with existing lessons.']);
        }

        $topic->delete();

        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully.');
    }
}
