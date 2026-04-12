@extends('layouts.app')

@section('content')

    <section class="page-header-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Shopping Cart</a></li>
                        </ol>
                    </nav>
                    <h1 class="page-title">Shopping Cart</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="cart-list-area">
        <div class="container">
            @if($carts->count() > 0)
                <div class="row" id="cart_items_details">
                    <div class="col-lg-9">

                        <div class="in-cart-box">
                            <div class="title">{{ Cart::getTotal() }} courses in cart</div>
                            <div class="">
                                <ul class="cart-course-list">
                                    @foreach ($carts as $cart)
                                        <li>
                                            <div class="cart-course-wrapper">
                                                <div class="image">
                                                    <a href="{{ route('course_detail', $cart->id) }}">
                                                        <img src="{{ optional(\App\Course::find($cart->id))->thumbnail_url ?? asset('images/learning.jpg') }}" alt=""
                                                             class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="details">
                                                    <a href="">
                                                        <div class="name">{{ $cart->name }}</div>
                                                    </a>
                                                </div>
                                                <div class="move-remove">
                                                    <div>
                                                        <form action="{{ route('cart.remove', $cart->id) }}"
                                                              method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ $cart->id }}">
                                                            <input type="submit" class="btn-success" value="Remove">
                                                        </form>
                                                    </div>
                                                    <!-- <div>Move to Wishlist</div> -->
                                                </div>
                                                <div class="price">
                                                    <a href="">
                                                        <div class="current-price">
                                                            {{ $cart->price }}
                                                        </div>
                                                        <span class="coupon-tag">
                                                        <i class="fas fa-tag"></i>
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="cart-sidebar">
                            <div class="total">Total:</div>
                            <div class="total-price">
                                $<span id="total_price_of_checking_out">{{ Cart::getTotal() }}</span>
                            </div>
                            <button type="button" class="btn btn-primary btn-block checkout-btn"
                                    onclick="handleCheckOut()">Checkout
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center py-5">
                    <div class="col-md-8 col-lg-6 text-center">
                        <div class="bg-white border rounded p-5 shadow-sm">
                            <p class="text-muted mb-2"><i class="fas fa-shopping-cart fa-3x"></i></p>
                            <h2 class="h5 mb-3" style="color: #505763;">Your cart is empty</h2>
                            <p class="text-muted mb-4">Add courses from the catalog to see them here before checkout.</p>
                            <a href="{{ route('home') }}" class="btn btn-sign-up mr-2 mb-2">Explore courses</a>
                            @auth
                                <a href="{{ route('user.courses') }}" class="btn btn-outline-secondary mb-2">My courses</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <script>
        function handleCheckOut() {
            $.ajax({
                url: '/auth/check',
                success: function (res) {
                    console.log(res);
                    if (!res.success) {
                        $('#signInModal').modal('show');
                    } else {
                        $('#paymentModal').modal('show');
                        $('.total_price_of_checking_out').val($('#total_price_of_checking_out').text());
                    }
                }
            });
        }
    </script>

@endsection