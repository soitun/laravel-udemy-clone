@extends('layouts.app')

@section('content')
    <section class="page-header-area my-course-area">
        <div class="container">
            <h1 class="page-title">Edit course</h1>
            <p class="text-muted mb-0">
                <a href="{{ route('instructor.courses.index') }}">← Back to your courses</a>
                ·
                <a href="{{ route('course_detail', $course) }}">Preview course page</a>
            </p>
        </div>
    </section>

    <section class="user-dashboard-area pb-5">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="user-dashboard-box">
                <div class="user-dashboard-content" style="width: 100%; max-width: 920px; margin: 0 auto;">
                    <div class="content-title-box">
                        <div class="title">Course details</div>
                        <div class="subtitle">Update information and publishing status.</div>
                    </div>
                    <form action="{{ route('instructor.courses.update', $course) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="content-box">
                            @include('instructor.courses._form', ['course' => $course, 'categories' => $categories])
                        </div>
                        <div class="content-update-box">
                            <button type="submit" class="btn btn-sign-up">Save changes</button>
                        </div>
                    </form>

                    <div class="content-title-box mt-5">
                        <div class="title">Curriculum</div>
                        <div class="subtitle">Add video lessons (YouTube or direct video URLs).</div>
                    </div>
                    <div class="content-box">
                        @if ($course->lessons->isEmpty())
                            <p class="text-muted">No lessons yet. Add the first one below.</p>
                        @else
                            <ul class="list-group mb-4">
                                @foreach ($course->lessons as $lesson)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $lesson->title }}</strong>
                                            <span class="text-muted small ml-2">{{ $lesson->duration }} min ·</span>
                                            <a href="{{ $lesson->video }}" target="_blank" rel="noopener" class="small">Video link</a>
                                        </div>
                                        <form action="{{ route('instructor.courses.lessons.destroy', [$course, $lesson]) }}" method="post"
                                              onsubmit="return confirm('Remove this lesson?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <h6 class="mb-3">Add lesson</h6>
                        <form action="{{ route('instructor.courses.lessons.store', $course) }}" method="post" class="border rounded p-3 bg-light">
                            @csrf
                            <div class="form-group">
                                <label for="lesson-title">Lesson title</label>
                                <input type="text" name="title" id="lesson-title" class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" required maxlength="255">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="lesson-duration">Duration (e.g. minutes)</label>
                                    <input type="text" name="duration" id="lesson-duration" class="form-control @error('duration') is-invalid @enderror"
                                           value="{{ old('duration', '10') }}" required maxlength="50" placeholder="12.5">
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="lesson-video">Video URL</label>
                                    <input type="url" name="video" id="lesson-video" class="form-control @error('video') is-invalid @enderror"
                                           value="{{ old('video') }}" required maxlength="2048" placeholder="https://www.youtube.com/watch?v=…">
                                    @error('video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add lesson</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
