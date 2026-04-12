@extends('layouts.app')

@section('content')
    <section class="page-header-area my-course-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">Instructor dashboard</h1>
                    <p class="text-muted mb-0">Create and manage courses you teach.</p>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                    <a href="{{ route('instructor.courses.create') }}" class="btn btn-sign-up">Create a course</a>
                </div>
            </div>
        </div>
    </section>

    <section class="my-courses-area">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($courses->isEmpty())
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-5 text-center">
                        <p class="mb-3">You have not created any courses yet.</p>
                        <a href="{{ route('instructor.courses.create') }}" class="btn btn-sign-up">Create your first course</a>
                    </div>
                </div>
            @else
                <div class="table-responsive bg-white shadow-sm rounded">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Course</th>
                                <th>Status</th>
                                <th class="text-center">Lessons</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>
                                        <strong>{{ $course->title }}</strong>
                                        <div class="small text-muted">{{ Str::limit($course->short_description, 80) }}</div>
                                    </td>
                                    <td>
                                        @if ($course->visibility)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $course->lessons_count }}</td>
                                    <td class="text-right">${{ number_format($course->price, 2) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('instructor.courses.edit', $course) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="{{ route('course_detail', $course) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
@endsection
