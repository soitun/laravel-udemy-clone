@extends('layouts.app')

@section('content')
    <section class="page-header-area my-course-area">
        <div class="container">
            <h1 class="page-title">Become an instructor</h1>
            <p class="text-muted mb-0">Share your knowledge and reach learners on this platform.</p>
        </div>
    </section>

    <section class="user-dashboard-area pb-5">
        <div class="container">
            <div class="user-dashboard-box">
                <div class="user-dashboard-content" style="max-width: 640px; margin: 0 auto;">
                    @if (session('info'))
                        <div class="alert alert-info">{{ session('info') }}</div>
                    @endif

                    <div class="content-title-box">
                        <div class="title">Start teaching</div>
                        <div class="subtitle">Confirm below to unlock the instructor dashboard and course builder.</div>
                    </div>

                    <form action="{{ route('instructor.become.store') }}" method="post" class="content-box">
                        @csrf
                        <div class="form-group form-check">
                            <input type="checkbox" name="accept_terms" id="accept_terms" value="1"
                                   class="form-check-input @error('accept_terms') is-invalid @enderror"
                                   {{ old('accept_terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="accept_terms">
                                I agree to publish accurate course information and comply with platform guidelines.
                            </label>
                            @error('accept_terms')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="content-update-box">
                            <button type="submit" class="btn btn-sign-up">Continue to create courses</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
