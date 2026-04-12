<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        $course = $this->route('course');

        return $course instanceof Course
            && (int) $course->user_id === (int) auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'outcomes' => ['required', 'string'],
            'section' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'language' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'level' => ['required', 'string', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'thumbnail' => ['nullable', 'string', 'max:2048'],
            'visibility' => ['sometimes', 'boolean'],
        ];
    }
}
