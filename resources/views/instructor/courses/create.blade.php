@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/instructor-course-form.css') }}">
@endpush

@section('content')
    @php
        $course = new \App\Course([
            'language' => 'English',
            'level' => 'Beginner',
            'price' => 0,
            'visibility' => false,
        ]);
    @endphp

    <section class="page-header-area my-course-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="page-title">Create a course</h1>
                    <p class="text-muted mb-0"><a href="{{ route('instructor.courses.index') }}">← Back to your courses</a></p>
                </div>
            </div>
        </div>
    </section>

    <div class="instructor-course-create">
        <div class="instructor-create-shell">
            <div class="container">
                <div class="instructor-create-card">
                    <div class="instructor-create-card__head">
                        <h2 class="instructor-create-card__title">Course details</h2>
                        <p class="instructor-create-card__sub">Add the basics in a relaxed pass—you can add lessons after you save.</p>
                    </div>
                    <form action="{{ route('instructor.courses.store') }}" method="post">
                        @csrf
                        <div class="instructor-create-card__body">
                            @include('instructor.courses._form', ['course' => $course, 'categories' => $categories])
                        </div>
                        <div class="instructor-create-card__foot">
                            <button type="submit" class="btn btn-instructor-save">Save and continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
