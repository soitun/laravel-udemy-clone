<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstructorOnboardingController extends Controller
{
    public function show()
    {
        if (auth()->user()->is_instructor) {
            return redirect()->route('instructor.courses.index');
        }

        return view('instructor.become');
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->is_instructor) {
            return redirect()->route('instructor.courses.index');
        }

        $request->validate([
            'accept_terms' => ['accepted'],
        ], [
            'accept_terms.accepted' => 'Please confirm you agree to the instructor terms.',
        ]);

        auth()->user()->update(['is_instructor' => true]);

        return redirect()
            ->route('instructor.courses.create')
            ->with('status', 'You can now create your first course.');
    }
}
