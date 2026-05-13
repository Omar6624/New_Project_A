<?php

namespace App\Http\Requests\Topic;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopicValidationRequest extends FormRequest
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
        $topicId = $this->route('topic')?->id ?? $this->route('topic');

        return [
            'name'        => 'required|string|max:255',
            'slug'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('topics', 'slug')->ignore($topicId),
            ],
            'description' => 'nullable|string',
            'order_index' => 'nullable|integer',
        ];
    }
}
