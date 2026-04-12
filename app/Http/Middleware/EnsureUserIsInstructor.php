<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsInstructor
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || ! $user->is_instructor) {
            return redirect()
                ->route('instructor.become')
                ->with('info', 'Become an instructor to create and manage courses.');
        }

        return $next($request);
    }
}
