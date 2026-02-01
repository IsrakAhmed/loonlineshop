@extends('frontEnd.layouts.master') @section('title', 'Popular E-Commerce & Gadget Online Market in Bangladesh')
@push('seo')
    <meta name="app-url" content="" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Open Graph data -->
    <meta property="og:title" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="{{ asset($generalsetting->white_logo) }}" />
    <meta property="og:description" content="" />
@endpush @push('css')
    <!-- CSS in <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.theme.default.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet" />
@endpush @section('content')
    <section class="slider-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="col-sm-12">
                        <div class="home-slider-container">
                            <div class="main_slider owl-carousel">
                                @foreach ($sliders as $key => $value)
                                    <div class="slider-item">
                                        <img src="{{ asset($value->image) }}" alt="" />
                                    </div>
                                    <!-- slider item -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- slider end -->
    <section class="bottoads_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bottoads_inner">
                        @foreach ($sliderbottomads as $key => $value)
                            <div class="ads_item">
                                <a href="{{ $value->link }}">
                                    <img src="{{ asset($value->image) }}" alt="" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="homeproduct">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sec_title">
                        <h3 class="section-title-header">
                            <div class="timer_inner">
                                <div class="">
                                    <span class="section-title-name"> Categories </span>
                                </div>
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="category-slider owl-carousel">
                        @foreach ($menucategories as $key => $value)
                            <div class="cat_item">
                                <div class="cat_img">
                                    <a href="{{ route('category', $value->slug) }}">
                                        <img src="{{ asset($value->image) }}" alt="" />
                                    </a>
                                </div>
                                <div class="cat_name">
                                    <a href="{{ route('category', $value->slug) }}">
                                        {{ $value->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="homeproduct">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sec_title">
                        <h3 class="section-title-header">
                            <div class="timer_inner">
                                <div class="">
                                    <span class="section-title-name"> Hot Deal </span>
                                </div>

                                <div class="">
                                    <div class="offer_timer" id="simple_timer"></div>
                                </div>
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="product_slider owl-carousel">
                        @foreach ($hotdeal_top as $key => $value)
                            <div class="product_item wist_item wow zoomIn" data-wow-duration="1.5s"
                                data-wow-delay="0.{{ $key }}s">
                                <div class="product_item_inner">
                                    @if($value->old_price)
                                        <div class="sale-badge">
                                            <div class="sale-badge-inner">
                                                <div class="sale-badge-box">
                                                    <span class="sale-badge-text">
                                                        <p>@php $discount = (((($value->old_price) - ($value->new_price)) * 100) / ($value->old_price)) @endphp
                                                            {{ number_format($discount, 0) }}%
                                                        </p>
                                                        ছাড়
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="pro_img">
                                        <a href="{{ route('product', $value->slug) }}">
                                            <img src="{{ asset($value->image ? $value->image->image : '') }}"
                                                alt="{{ $value->name }}" />
                                        </a>
                                    </div>
                                    <div class="pro_des">
                                        <div class="pro_name">
                                            <a
                                                href="{{ route('product', $value->slug) }}">{{ Str::limit($value->name, 35) }}</a>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $averageRating = $value->reviews->avg('ratting');
                                    $filledStars = floor($averageRating);
                                    $hasHalfStar = $averageRating - $filledStars >= 0.5;
                                    $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0);
                                @endphp

                                <div class="ratting_star">
                                    @if ($averageRating >= 0 && $averageRating <= 5)
                                        @for ($i = 0; $i < $filledStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    @endif
                                </div>
                                <div class="pro_price">
                                    <p>
                                        <del>৳ {{ $value->old_price }}</del>
                                        ৳ {{ $value->new_price }} @if ($value->old_price)
                                        @endif
                                    </p>
                                </div>
                                @if (!$value->prosizes->isEmpty() || !$value->procolors->isEmpty())
                                    <div class="pro_btn d-flex justify-content-between align-items-center gap-2">

                                        <a href="{{ route('product', $value->slug) }}" class="btn btn-sm btn-success w-100"
                                            style="flex: 1;">
                                            অর্ডার করুন
                                        </a>


                                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success add-to-cart-btn"
                                            data-id="{{ $value->id }}" style="width: 40px; padding: 4px;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>

                                    </div>
                                @else
                                    <div class="pro_btn d-flex justify-content-between align-items-center gap-2">
                                        <!-- অর্ডার করুন বাটন -->
                                        <a class="btn btn-sm btn-success w-100 addcartbutton" data-id="{{ $value->id }}"
                                            data-checkout="yes" style="flex: 1;">
                                            অর্ডার করুন
                                        </a>

                                        <!-- কার্ট আইকন বাটন -->
                                        <a class="btn btn-sm btn-outline-success addcartbutton" data-id="{{ $value->id }}"
                                            style="width: 40px; padding: 4px;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12">
                    <a href="{{ route('hotdeals') }}" class="view_more_btn" style="float:left">View More</a>
                </div>
            </div>
        </div>
    </section>














    @foreach ($homeproducts as $homecat)
        <section class="homeproduct">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sec_title">
                            <h3 class="section-title-header">
                                <span class="section-title-name">{{ $homecat->name }}</span>
                                <a href="{{ route('category', $homecat->slug) }}" class="view_more_btn">View More</a>
                            </h3>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="product_slider owl-carousel">
                            @foreach ($homecat->products as $key => $value)
                                <div class="product_item wist_item wow zoomIn" data-wow-duration="1.5s"
                                    data-wow-delay="0.{{ $key }}s">
                                    <div class="product_item_inner">
                                        @if($value->old_price)
                                            <div class="sale-badge">
                                                <div class="sale-badge-inner">
                                                    <div class="sale-badge-box">
                                                        <span class="sale-badge-text">
                                                            <p>@php $discount = (((($value->old_price) - ($value->new_price)) * 100) / ($value->old_price)) @endphp
                                                                {{ number_format($discount, 0) }}%
                                                            </p>
                                                            ছাড়
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="pro_img">
                                            <a href="{{ route('product', $value->slug) }}">
                                                <img src="{{ asset($value->image ? $value->image->image : '') }}"
                                                    alt="{{ $value->name }}" />
                                            </a>
                                        </div>
                                        <div class="pro_des">
                                            <div class="pro_name">
                                                <a
                                                    href="{{ route('product', $value->slug) }}">{{ Str::limit($value->name, 35) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $averageRating = $value->reviews->avg('ratting');
                                        $filledStars = floor($averageRating);
                                        $hasHalfStar = $averageRating - $filledStars >= 0.5;
                                        $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0);
                                    @endphp

                                    <div class="ratting_star">
                                        @if ($averageRating >= 0 && $averageRating <= 5)
                                            @for ($i = 0; $i < $filledStars; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            @if ($hasHalfStar)
                                                <i class="fas fa-star-half-alt"></i>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        @endif
                                    </div>
                                    <div class="pro_price">
                                        <p>
                                            <del>৳ {{ $value->old_price }}</del>
                                            ৳ {{ $value->new_price }}
                                        </p>
                                    </div>
                                    @if (!$value->prosizes->isEmpty() || !$value->procolors->isEmpty())
                                        <div class="pro_btn d-flex justify-content-between align-items-center gap-2">
                                            <a href="{{ route('product', $value->slug) }}" class="btn btn-sm btn-success w-100"
                                                style="flex: 1;">
                                                অর্ডার করুন
                                            </a>
                                            <a href="{{ route('product', $value->slug) }}" class="btn btn-sm btn-outline-success"
                                                style="width: 40px; padding: 4px;">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="pro_btn d-flex justify-content-between align-items-center gap-2">
                                            <a class="btn btn-sm btn-success w-100 addcartbutton" data-id="{{ $value->id }}"
                                                data-checkout="yes" style="flex: 1;">
                                                অর্ডার করুন
                                            </a>
                                            <a class="btn btn-sm btn-outline-success addcartbutton" data-id="{{ $value->id }}"
                                                style="width: 40px; padding: 4px;">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    <section class="footer_top_ads_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="footertop_ads_inner">
                        @foreach ($footertopads as $key => $value)
                            <div class="footertop_ads_item">
                                <a href="{{ $value->link }}">
                                    <img src="{{ asset($value->image) }}" alt="" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection @push('script')
    <script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/jquery.syotimer.min.js') }}"></script>
    <!-- JS before </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.info-carousel').owlCarousel({
                loop: true,
                margin: 15,
                autoplay: true,
                dots: false,
                autoplayTimeout: 4000,
                smartSpeed: 700,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 3 }
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $(".main_slider").owlCarousel({
                items: 1,
                loop: true,
                dots: false,
                autoplay: true,
                nav: true,
                autoplayHoverPause: false,
                margin: 0,
                mouseDrag: true,
                smartSpeed: 8000,
                autoplayTimeout: 3000,
                animateOut: "fadeOutDown",
                animateIn: "slideInDown",

                navText: ["<i class='fa-solid fa-angle-left'></i>",
                    "<i class='fa-solid fa-angle-right'></i>"
                ],
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".hotdeals-slider").owlCarousel({
                margin: 15,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 3,
                        nav: true,
                    },
                    600: {
                        items: 3,
                        nav: false,
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false,
                    },
                },
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".category-slider").owlCarousel({
                margin: 15,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 3,
                        nav: true,
                    },
                    600: {
                        items: 5,
                        nav: false,
                    },
                    1000: {
                        items: 8,
                        nav: true,
                        loop: false,
                    },
                },
            });

            $(".product_slider").owlCarousel({
                margin: 15,
                items: 6,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                    },
                    600: {
                        items: 5,
                        nav: false,
                    },
                    1000: {
                        items: 6,
                        nav: false,
                    },
                },
            });
        });
    </script>

    <script>
        $(document).on('click', '.add-to-cart-btn', function (e) {
            e.preventDefault();
            var productId = $(this).data('id');

            $.ajax({
                url: '{{ route("cart.add.ajax") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);

                        // কার্ট কাউন্ট যদি থাকে
                        $('#cart-count').text(response.cart_count);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function () {
                    toastr.error('Something went wrong!');
                }
            });
        });
    </script>



    <script>
        $("#simple_timer").syotimer({
            date: new Date(2015, 0, 1),
            layout: "hms",
            doubleNumbers: false,
            effectType: "opacity",

            periodUnit: "d",
            periodic: true,
            periodInterval: 1,
        });
    </script>
@endpush