<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    public function enroll(Request $request)
    {
        foreach (Cart::getContent() as $cart) {
            auth()->user()->enrolls()->create([
                'course_id' => $cart->id
            ]);
        }

        Cart::clear();

        return redirect()->route('home');
    }
}
