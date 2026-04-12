@extends('layouts.app')

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
            <h1 class="page-title">Create a course</h1>
            <p class="text-muted mb-0"><a href="{{ route('instructor.courses.index') }}">← Back to your courses</a></p>
        </div>
    </section>

    <section class="user-dashboard-area pb-5">
        <div class="container">
            <div class="user-dashboard-box">
                <div class="user-dashboard-content" style="width: 100%; max-width: 920px; margin: 0 auto;">
                    <div class="content-title-box">
                        <div class="title">Course details</div>
                        <div class="subtitle">Add the basics now. You can add lessons after you save.</div>
                    </div>
                    <form action="{{ route('instructor.courses.store') }}" method="post">
                        @csrf
                        <div class="content-box">
                            @include('instructor.courses._form', ['course' => $course, 'categories' => $categories])
                        </div>
                        <div class="content-update-box">
                            <button type="submit" class="btn btn-sign-up">Save and continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
