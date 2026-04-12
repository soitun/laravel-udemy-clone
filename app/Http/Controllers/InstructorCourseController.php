<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstructorCourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->where('user_id', auth()->id())
            ->orderByDesc('updated_at')
            ->withCount('lessons')
            ->get();

        return view('instructor.courses.index', compact('courses'));
    }

    public function create(): View
    {
        $categories = Category::query()->orderBy('title')->get();

        return view('instructor.courses.create', compact('categories'));
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['visibility'] = $request->boolean('visibility');

        $course = Course::query()->create($data);

        return redirect()
            ->route('instructor.courses.edit', $course)
            ->with('status', 'Course created. Add lessons below, then publish when you are ready.');
    }

    public function edit(Course $course): View
    {
        $this->authorizeInstructor($course);

        $categories = Category::query()->orderBy('title')->get();
        $course->load('lessons');

        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $this->authorizeInstructor($course);

        $data = $request->validated();
        $data['visibility'] = $request->boolean('visibility');

        $course->update($data);

        return redirect()
            ->route('instructor.courses.edit', $course)
            ->with('status', 'Course updated.');
    }

    public function storeLesson(StoreLessonRequest $request, Course $course): RedirectResponse
    {
        $this->authorizeInstructor($course);

        $course->lessons()->create($request->validated());

        return redirect()
            ->route('instructor.courses.edit', $course)
            ->with('status', 'Lesson added.');
    }

    public function destroyLesson(Course $course, Lesson $lesson): RedirectResponse
    {
        $this->authorizeInstructor($course);

        abort_unless((int) $lesson->course_id === (int) $course->id, 404);

        $lesson->delete();

        return redirect()
            ->route('instructor.courses.edit', $course)
            ->with('status', 'Lesson removed.');
    }

    private function authorizeInstructor(Course $course): void
    {
        abort_unless((int) $course->user_id === (int) auth()->id(), 403);
    }
}
