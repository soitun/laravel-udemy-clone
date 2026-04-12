<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;

class HomeController extends Controller
{
    public function index()
    {
        $courseQuery = static function ($query) {
            $query->with(['category'])
                ->withCount('lessons')
                ->withAvg('reviews', 'rating');
        };

        $topCourses = Course::query()
            ->tap($courseQuery)
            ->inRandomOrder()
            ->limit(12)
            ->get();

        $courses = Course::query()
            ->tap($courseQuery)
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $totalCourses = Course::count();

        return view('home', compact('courses', 'topCourses', 'totalCourses'));
    }

    // courses by category
    public function courses_by_category(Category $category)
    {
        return view('courses_by_category')
            ->with('category', $category)
            ->with('courses', $category->courses()->paginate(6));
    }

    // course details
    public function course_detail(Course $course)
    {
        return view('course_details', compact('course'));
    }

    public function checkAuth()
    {
        $isLoggedIn = auth()->check() ? true : false;

        return response()->json(['success' => $isLoggedIn]);
    }
}
