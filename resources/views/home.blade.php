@extends('layouts.app')

@section('content')
    <style>
        @keyframes homeKenBurns {
            from { transform: scale(1); }
            to { transform: scale(1.07); }
        }
        @keyframes homeFadeUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes homeFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes homeGradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .home-banner--enhanced {
            position: relative;
            overflow: hidden;
            padding: 0;
            min-height: 420px;
            display: flex;
            align-items: center;
            color: #fff;
        }
        .home-banner-bg {
            position: absolute;
            inset: -24px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
            animation: homeKenBurns 28s ease-in-out infinite alternate;
            will-change: transform;
        }
        .home-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                115deg,
                rgba(20, 23, 28, 0.82) 0%,
                rgba(20, 23, 28, 0.55) 42%,
                rgba(110, 26, 82, 0.5) 100%
            );
        }
        .home-banner-inner {
            position: relative;
            z-index: 1;
            padding: 140px 0 110px;
            width: 100%;
        }
        .home-banner-wrap {
            max-width: 560px;
        }
        .home-banner-eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 14px;
            animation: homeFadeUp 0.85s ease 0.05s both;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
        }
        .home-banner-wrap h2 {
            animation: homeFadeUp 0.85s ease 0.15s both;
        }
        .home-banner-wrap .home-banner-lead {
            animation: homeFadeUp 0.85s ease 0.28s both;
        }
        .home-banner-wrap form {
            animation: homeFadeUp 0.85s ease 0.4s both;
        }
        .home-banner-wrap .home-search-hint {
            font-size: 14px;
            margin-top: 12px;
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.85);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
            animation: homeFadeIn 1s ease 0.55s both;
        }
        .home-banner-wrap .input-group {
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.22);
            border-radius: 4px;
            overflow: hidden;
            transition: box-shadow 0.25s ease, transform 0.25s ease;
        }
        .home-banner-wrap .input-group:focus-within {
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.28);
            transform: translateY(-1px);
        }
        .home-fact-area.home-fact--animated {
            background: linear-gradient(-45deg, #ec5252, #c72c7a, #6e1a52, #ec5252);
            background-size: 320% 320%;
            animation: homeGradientShift 18s ease infinite;
        }
        .home-fact-area.home-fact--animated .home-fact-box {
            opacity: 0;
            animation: homeFadeUp 0.75s ease forwards;
        }
        .home-fact-area.home-fact--animated .row > .col-md-4:nth-child(1) .home-fact-box { animation-delay: 0.1s; }
        .home-fact-area.home-fact--animated .row > .col-md-4:nth-child(2) .home-fact-box { animation-delay: 0.22s; }
        .home-fact-area.home-fact--animated .row > .col-md-4:nth-child(3) .home-fact-box { animation-delay: 0.34s; }
        .home-section-head {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 16px;
        }
        .home-section-head .course-carousel-title {
            margin-bottom: 0;
            position: relative;
            padding-bottom: 8px;
        }
        .home-section-head .course-carousel-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 48px;
            height: 3px;
            background: linear-gradient(90deg, #ec5252, #6e1a52);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            animation: homeTitleLine 0.7s ease 0.35s forwards;
        }
        @keyframes homeTitleLine {
            to { transform: scaleX(1); }
        }
        .home-section-sub {
            font-size: 14px;
            color: #686f7a;
            margin: 0;
        }
        .course-box-wrap {
            transition: transform 0.3s ease, filter 0.3s ease;
        }
        .course-box-wrap:hover {
            transform: translateY(-6px);
        }
        .course-box-wrap .course-box {
            transition: box-shadow 0.3s ease;
        }
        .course-box-wrap:hover .course-box {
            box-shadow: 0 10px 28px rgba(20, 23, 28, 0.12);
        }
        .course-box-wrap .course-image img {
            transition: transform 0.45s ease;
        }
        .course-box-wrap:hover .course-image img {
            transform: scale(1.04);
        }
        @media (prefers-reduced-motion: reduce) {
            .home-banner-bg,
            .home-fact-area.home-fact--animated {
                animation: none;
            }
            .home-fact-area.home-fact--animated {
                background: linear-gradient(-45deg, #ec5252, #6e1a52);
            }
            .home-banner-eyebrow,
            .home-banner-wrap h2,
            .home-banner-wrap .home-banner-lead,
            .home-banner-wrap form,
            .home-banner-wrap .home-search-hint,
            .home-fact-area.home-fact--animated .home-fact-box,
            .home-section-head .course-carousel-title::after {
                animation: none;
                opacity: 1;
                transform: none;
            }
            .home-section-head .course-carousel-title::after {
                transform: scaleX(1);
            }
            .course-box-wrap,
            .course-box-wrap .course-box,
            .course-box-wrap .course-image img {
                transition: none;
            }
            .course-box-wrap:hover {
                transform: none;
            }
            .course-box-wrap:hover .course-image img {
                transform: none;
            }
        }
    </style>

    <section class="home-banner-area home-banner--enhanced">
        <div class="home-banner-bg" style="background-image: url({{ asset('images/learning.jpg') }})" role="presentation"></div>
        <div class="home-banner-overlay" role="presentation"></div>
        <div class="container-lg home-banner-inner">
            <div class="row">
                <div class="col">
                    <div class="home-banner-wrap">
                        <p class="home-banner-eyebrow">Learn skills that move your career forward</p>
                        <h2>Find your next course</h2>
                        <p class="home-banner-lead">Video lessons from real-world practitioners. Browse by topic, level, and category—then start learning at your own pace.</p>
                        <form class="home-banner-search" action="{{ url('/') }}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q"
                                       placeholder="Search for a skill, e.g. PHP, design, marketing…"
                                       autocomplete="off"
                                       aria-label="Search courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <p class="home-search-hint"><i class="fas fa-shield-alt" style="opacity:0.85;margin-right:6px;"></i>Trusted by learners worldwide · New courses added regularly</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-fact-area home-fact--animated">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fas fa-bullseye float-left" aria-hidden="true"></i>
                        <div class="text-box">
                            <h4>{{ $totalCourses === 0 ? 'Growing course library' : $totalCourses.' '.($totalCourses === 1 ? 'online course' : 'online courses') }}</h4>
                            <p>Fresh topics across development, design, and business</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fa fa-check float-left" aria-hidden="true"></i>
                        <div class="text-box">
                            <h4>Expert-led instruction</h4>
                            <p>Structured paths from fundamentals to advanced projects</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fa fa-clock float-left" aria-hidden="true"></i>
                        <div class="text-box">
                            <h4>Lifetime access</h4>
                            <p>Learn on your schedule—desktop or mobile</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-carousel-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <div class="home-section-head">
                        <h2 class="course-carousel-title">Recommended for you</h2>
                        <p class="home-section-sub">Hand-picked courses to explore this week</p>
                    </div>
                    <div class="course-carousel">
                        @foreach ($topCourses as $top_course)
                            @php
                                $avgTop = round((float) ($top_course->reviews_avg_rating ?? 4.5), 1);
                                $starsTop = (int) min(5, max(0, round($avgTop)));
                            @endphp
                            <div class="course-box-wrap">
                                <a href="{{ route('course_detail', $top_course) }}"
                                   class="has-popover">
                                    <div class="course-box">
                                        <div class="course-image">
                                            <img src="{{ $top_course->thumbnail_url }}" alt="{{ $top_course->title }}" class="img-fluid" loading="lazy">
                                        </div>
                                        <div class="course-details">
                                            <h5 class="title">{{ $top_course->title }}</h5>
                                            <p class="instructors">{{ Str::limit($top_course->short_description, 96) }}</p>
                                            <div class="rating" aria-label="Average rating {{ $avgTop }} out of 5">
                                                @for ($s = 1; $s <= 5; $s++)
                                                    <i class="fas fa-star {{ $s <= $starsTop ? 'filled' : '' }}"></i>
                                                @endfor
                                                <span class="d-inline-block average-rating">{{ number_format($avgTop, 1) }}</span>
                                            </div>
                                            <p class="price text-right">
                                                ${{ number_format($top_course->price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <div class="webui-popover-content">
                                    <div class="course-popover-content">
                                        <div class="course-title">
                                            <a href="{{ route('course_detail', $top_course) }}">{{ $top_course->title }}</a>
                                        </div>
                                        <div class="course-meta">
                                            <span><i class="fas fa-play-circle"></i>
                                                {{ $top_course->lessons_count }} {{ $top_course->lessons_count === 1 ? 'lesson' : 'lessons' }}
                                            </span>
                                            <span><i class="fas fa-layer-group"></i>
                                                {{ $top_course->category?->name ?? 'General' }}
                                            </span>
                                            <span><i class="fas fa-closed-captioning"></i>{{ $top_course->language }}</span>
                                        </div>
                                        <div class="course-subtitle">{{ Str::limit($top_course->short_description, 180) }}</div>
                                        <div class="what-will-learn">
                                            <ul>
                                                {{ $top_course->outcomes }}
                                            </ul>
                                        </div>
                                        <div class="popover-btns">
                                            @if(auth()->check() && \App\Enroll::whereCourseId($top_course->id)->first() !== null)
                                                <div class="purchased">
                                                    <a href="#">Already purchased</a>
                                                </div>
                                            @elseif(Cart::get($top_course->id) !== null)
                                                <button type="button"
                                                        class="btn add-to-cart-btn addedToCart big-cart-button-1"
                                                        id="{{ $top_course->id }}">
                                                    Added To Cart
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn add-to-cart-btn addedToCart big-cart-button-1"
                                                        id="{{ $top_course->id }}">
                                                    Add To Cart
                                                </button>
                                            @endif
                                            <button type="button"
                                                    class="wishlist-btn"
                                                    title="Add to wishlist"
                                                    id="{{ $top_course->id }}"><i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-carousel-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <div class="home-section-head">
                        <h2 class="course-carousel-title">Latest courses</h2>
                        <p class="home-section-sub">Recently published on the platform</p>
                    </div>
                    <div class="course-carousel">
                        @foreach($courses as $course)
                            @php
                                $avgCourse = round((float) ($course->reviews_avg_rating ?? 4.5), 1);
                                $starsCourse = (int) min(5, max(0, round($avgCourse)));
                            @endphp
                            <div class="course-box-wrap">
                                <a href="{{ route('course_detail', $course) }}">
                                    <div class="course-box">
                                        <div class="course-image">
                                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="img-fluid" loading="lazy">
                                        </div>
                                        <div class="course-details">
                                            <h5 class="title">{{ $course->title }}</h5>
                                            <p class="instructors">
                                                {{ $course->category?->name ?? 'Professional instructor' }}
                                                @if($course->level)
                                                    · {{ $course->level }}
                                                @endif
                                            </p>
                                            <div class="rating" aria-label="Average rating {{ $avgCourse }} out of 5">
                                                @for ($s = 1; $s <= 5; $s++)
                                                    <i class="fas fa-star {{ $s <= $starsCourse ? 'filled' : '' }}"></i>
                                                @endfor
                                                <span class="d-inline-block average-rating">{{ number_format($avgCourse, 1) }}</span>
                                            </div>
                                            <p class="price text-right">
                                                ${{ number_format($course->price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
