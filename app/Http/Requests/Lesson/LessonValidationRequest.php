<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $lessonId = $this->route('lesson')?->id ?? $this->route('lesson');

        return [
            'title'        => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            'slug'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('lessons', 'slug')->ignore($lessonId),
            ],
            'content' => 'nullable|string',
            'widget_html' => 'nullable|string',
            'order_index' => 'nullable|integer',
            'sources' => 'nullable|string',
        ];
    }
}
