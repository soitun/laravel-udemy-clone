<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'duration' => ['required', 'string', 'max:50'],
            'video' => ['required', 'string', 'max:2048'],
        ];
    }
}
