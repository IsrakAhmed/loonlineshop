@extends('frontEnd.layouts.master')
@section('title', $details->name) 
@push('seo')
<meta name="app-url" content="{{ route('product', $details->slug) }}" />
<meta name="robots" content="index, follow" />
<meta name="description" content="{{ $details->meta_description }}" />
<meta name="keywords" content="{{ $details->slug }}" />

<!-- Twitter Card data -->
<meta name="twitter:card" content="product" />
<meta name="twitter:site" content="{{ $details->name }}" />
<meta name="twitter:title" content="{{ $details->name }}" />
<meta name="twitter:description" content="{{ $details->meta_description }}" />
<meta name="twitter:creator" content="gomobd.com" />
<meta property="og:url" content="{{ route('product', $details->slug) }}" />
<meta name="twitter:image" content="{{ asset($details->image->image) }}" />

<!-- Open Graph data -->
<meta property="og:title" content="{{ $details->name }}" />
<meta property="og:type" content="product" />
<meta property="og:url" content="{{ route('product', $details->slug) }}" />
<meta property="og:image" content="{{ asset($details->image->image) }}" />
<meta property="og:description" content="{{ $details->meta_description }}" />
<meta property="og:site_name" content="{{ $details->name }}" />
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/zoomsl.css') }}">
<style>
    .product-support-banner { background: #fff; border-radius: 12px; padding: 15px; margin: 20px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; text-align: center; }
    .product-support-banner h5 { color: #002366; font-weight: 700; margin-bottom: 12px; font-size: 16px; }
    .support-buttons-flex { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; }
    .support-btn { display: flex; align-items: center; gap: 6px; padding: 8px 15px; border-radius: 50px; color: #fff; font-weight: 600; text-decoration: none; transition: 0.3s; font-size: 13px; border: none; flex: 1; min-width: 100px; justify-content: center; }
    .support-btn:hover { opacity: 0.9; color: #fff; transform: translateY(-2px); }
    .support-btn.whatsapp { background: #25D366; }
    .support-btn.messenger { background: #0084FF; }
    .support-btn.call { background: #FF3B30; }
    @media (max-width: 576px) { .support-btn { padding: 8px 10px; font-size: 12px; min-width: 0; } .support-btn i { font-size: 14px; } }
</style>
@endpush

@section('content')
<div class="homeproduct main-details-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <section class="product-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 position-relative">
                                @if($details->old_price)
                                <div class="product-details-discount-badge">
                                    <div class="sale-badge">
                                        <div class="sale-badge-inner">
                                            <div class="sale-badge-box">
                                                <span class="sale-badge-text">
                                                    <p> @php $discount=(((($details->old_price)-($details->new_price))*100) / ($details->old_price)) @endphp {{ number_format($discount, 0) }}%</p>
                                                    ছাড়
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="details_slider owl-carousel">
                                    @foreach ($details->images as $value)
                                        <div class="dimage_item">
                                            <img src="{{ asset($value->image) }}" class="block__pic" />
                                        </div>
                                    @endforeach
                                </div>
                                <div
                                    class="indicator_thumb @if ($details->images->count() > 4) thumb_slider owl-carousel @endif">
                                    @foreach ($details->images as $key => $image)
                                        <div class="indicator-item" data-id="{{ $key }}">
                                            <img src="{{ asset($image->image) }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="details_right">
                                    <div class="breadcrumb">
                                        <ul>
                                            <li><a href="{{ url('/') }}">Home</a></li>
                                            <li><span>/</span></li>
                                            <li><a
                                                    href="{{ url('/category/' . $details->category->slug) }}">{{ $details->category->name }}</a>
                                            </li>
                                            @if ($details->subcategory)
                                                <li><span>/</span></li>
                                                <li><a
                                                        href="#">{{ $details->subcategory ? $details->subcategory->subcategoryName : '' }}</a>
                                                </li>
                                                @endif @if ($details->childcategory)
                                                    <li><span>/</span></li>
                                                    <li><a
                                                            href="#">{{ $details->childcategory->childcategoryName }}</a>
                                                    </li>
                                                @endif
                                        </ul>
                                    </div>

                                    <div class="product">
                                        <div class="product-cart">
                                            <p class="name">{{ $details->name }}</p>
                                            <p class="details-price">
                                                @if ($details->old_price)
                                                    <del>৳{{ $details->old_price }}</del>
                                                @endif ৳{{ $details->new_price }}
                                            </p>
                                            <div class="details-ratting-wrapper">
                                            @php
                                                $averageRating = $reviews->avg('ratting');
                                                $filledStars = floor($averageRating);
                                                $emptyStars = 5 - $filledStars;
                                            @endphp
                                            
                                            @if ($averageRating >= 0 && $averageRating <= 5)
                                                @for ($i = 1; $i <= $filledStars; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            
                                                @if ($averageRating == $filledStars)
                                                    {{-- If averageRating is an integer, don't display half star --}}
                                                @else
                                                    <i class="far fa-star-half-alt"></i>
                                                @endif
                                            
                                                @for ($i = 1; $i <= $emptyStars; $i++)
                                                    <i class="far fa-star"></i>
                                                @endfor
                                            
                                                <span>{{ number_format($averageRating, 2) }}/5</span>
                                            @else
                                                <span>Invalid rating range</span>
                                            @endif
                                            <a class="all-reviews-button" href="#writeReview">See Reviews</a>
                                            </div>
                                            <div class="product-code">
                                                <p><span>প্রোডাক্ট কোড : </span>{{ $details->product_code }}</p>
                                            </div>
                                            <form action="{{ route('cart.store') }}" method="POST" name="formName">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $details->id }}" />
                                                @if ($productcolors->count() > 0)
                                                    <div class="pro-color" style="width: 100%;">
                                                        <div class="color_inner">
                                                            <p>Color -</p>
                                                            <div class="size-container">
                                                                <div class="selector">
                                                                    @foreach ($productcolors as $procolor)
                                                                        <div class="selector-item">
                                                                            <input type="radio"
                                                                                id="fc-option{{ $procolor->id }}"
                                                                                value="{{ $procolor->color ? $procolor->color->colorName : '' }}"
                                                                                name="product_color"
                                                                                class="selector-item_radio emptyalert"
                                                                                required />
                                                                            <label for="fc-option{{ $procolor->id }}"
                                                                                style="background-color: {{ $procolor->color ? $procolor->color->color : '' }}"
                                                                                class="selector-item_label">
                                                                                <span>
                                                                                    <img src="{{ asset('public/frontEnd/images') }}/check-icon.svg"
                                                                                        alt="Checked Icon" />
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif @if ($productsizes->count() > 0)
                                                        <div class="pro-size" style="width: 100%;">
                                                            <div class="size_inner">
                                                                <p>Size - <span class="attibute-name"></span></p>
                                                                <div class="size-container">
                                                                    <div class="selector">
                                                                        @foreach ($productsizes as $prosize)
                                                                            <div class="selector-item">
                                                                                <input type="radio"
                                                                                    id="f-option{{ $prosize->id }}"
                                                                                    value="{{ $prosize->size ? $prosize->size->sizeName : '' }}"
                                                                                    name="product_size"
                                                                                    class="selector-item_radio emptyalert"
                                                                                    required />
                                                                                <label
                                                                                    for="f-option{{ $prosize->id }}"
                                                                                    class="selector-item_label">{{ $prosize->size ? $prosize->size->sizeName : '' }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if ($details->pro_unit)
                                                            <div class="pro_unig">
                                                                <label>Unit: {{ $details->pro_unit }}</label>
                                                                <input type="hidden" name="pro_unit"
                                                                    value="{{ $details->pro_unit }}" />
                                                            </div>
                                                        @endif
                                                        <div class="pro_brand">
                                                            <p>Brand :
                                                                {{ $details->brand ? $details->brand->name : 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div class="row">
                                                            <div class="qty-cart col-sm-12">
                                                                <div class="quantity">
                                                                    <span class="minus">-</span>
                                                                    <input type="text" name="qty"
                                                                        value="1" />
                                                                    <span class="plus">+</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex single_product col-sm-12">
                                                                <input type="submit" class="btn px-4 add_cart_btn"
                                                                    onclick="return sendSuccess();" name="add_cart" id="add_to_cart"
                                                                    value="কার্টে যোগ করুন" />

                                                                <input type="submit"
                                                                    class="btn px-4 order_now_btn order_now_btn_m"
                                                                    onclick="return sendSuccess();" name="order_now" id="order_now"
                                                                    value="অর্ডার করুন" />
                                                            </div>
                                                        </div>
                                                        <div class="product-support-banner">
                                                            <h5>পণ্য সম্পর্কে জানতে যোগাযোগ করুন:</h5>
                                                            <div class="support-buttons-flex">
                                                                @if($contact->messenger)
                                                                    <a href="https://m.me/{{$contact->messenger}}" target="_blank" class="support-btn messenger">
                                                                        <i class="fa-brands fa-facebook-messenger"></i> Messenger
                                                                    </a>
                                                                @endif

                                                                @if($contact->whatsapp)
                                                                    <a href="https://api.whatsapp.com/send?phone={{ $contact->whatsapp }}&text=আসসালামু আলাইকুম, আমি এই পণ্যটি সম্পর্কে জানতে চাই: {{ urlencode(Request::url()) }}" target="_blank" class="support-btn whatsapp">
                                                                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                                                    </a>
                                                                @endif

                                                                @if($contact->phone)
                                                                    <a href="tel:{{ $contact->phone }}" class="support-btn call">
                                                                        <i class="fa-solid fa-phone"></i> Call করুন
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="mt-md-2 mt-2">
                                                            <div class="del_charge_area">
                                                                <div class="alert alert-info text-xs">
                                                                    <div class="flext_area">
                                                                        <i class="fa-solid fa-cubes"></i>
                                                                        <div>

                                                                            @foreach ($shippingcharge as $key => $value)
                                                                                <span>{{ $value->name }} <br /></span>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<div class="description-nav-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="description-nav">
                    <ul class="desc-nav-ul">
                        {{-- <li class="active">
                            <a href="#specification" target="_self">Specification</a>
                        </li> --}}
                        <li>
                            <a href="#description" target="_self">Description</a>
                        </li>
                        {{-- <li>
                            <a href="#question" target="_self">Questions (0)</a>
                        </li> --}}
                        <li>
                            <a href="#writeReview" target="_self">Reviews ({{ $reviews->count() }}) </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="pro_details_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="description tab-content details-action-box" id="description">
                    <h2>বিস্তারিত</h2>
                    <p>{!! $details->description !!}</p>
                </div>
                <div class="tab-content details-action-box" id="writeReview">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-head">
                                    <div class="title">
                                        <h2>Reviews ({{ $reviews->count() }})</h2>
                                        <p>Get specific details about this product from customers who own it.</p>
                                    </div>
                                    <div class="action">
                                        <div>
                                            <button type="button" class="details-action-btn question-btn btn-overlay"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Write a review
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if ($reviews->count() > 0)
                                    <div class="customer-review">
                                        <div class="row">
                                            @foreach ($reviews as $key => $review)
                                                <div class="col-sm-12 col-12">
                                                    <div class="review-card">
                                                        <p class="reviewer_name"><i data-feather="message-square"></i>
                                                            {{ $review->name }}</p>
                                                        <p class="review_data">{{ $review->created_at->format('d-m-Y') }}</p>
                                                        <p class="review_star">{!! str_repeat('<i class="fa-solid fa-star"></i>', $review->ratting) !!}</p>
                                                        <p class="review_content">{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-content">
                                        <i class="fa fa-clipboard-list"></i>
                                        <p class="empty-text">This product has no reviews yet. Be the first one to write a review.</p>
                                    </div>
                                @endif
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Your review</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="insert-review">
                                                    @if (Auth::guard('customer')->user())
                                                        <form action="{{ route('customer.review') }}" id="review-form"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $details->id }}">
                                                            <div class="fz-12 mb-2">
                                                                <div class="rating">
                                                                    <label title="Excelent">
                                                                        ☆
                                                                        <input required type="radio" name="ratting"
                                                                            value="5" />
                                                                    </label>
                                                                    <label title="Best">
                                                                        ☆
                                                                        <input required type="radio" name="ratting"
                                                                            value="4" />
                                                                    </label>
                                                                    <label title="Better">
                                                                        ☆
                                                                        <input required type="radio" name="ratting"
                                                                            value="3" />
                                                                    </label>
                                                                    <label title="Very Good">
                                                                        ☆
                                                                        <input required type="radio" name="ratting"
                                                                            value="2" />
                                                                    </label>
                                                                    <label title="Good">
                                                                        ☆
                                                                        <input required type="radio" name="ratting"
                                                                            value="1" />
                                                                    </label>
                                                                </div>
                                                            </div>
                
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Message:</label>
                                                                <textarea required class="form-control radius-lg" name="review" id="message-text"></textarea>
                                                                <span id="validation-message" style="color: red;"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="details-review-button" type="submit">Submit
                                                                    Review</button>
                                                            </div>
                
                                                        </form>
                                                    @else
                                                        <a class="customer-login-redirect" href="{{ route('customer.login') }}">Login
                                                            to Post
                                                            Your Review</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($details->pro_video)
            <div class="col-sm-4">
                <div class="pro_vide">
                    <h2>ভিডিও</h2>
                    <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/{{ $details->pro_video }}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<style>
    .related-product-section .owl-carousel {
        width: 100% !important;
        overflow: hidden;
    }
    
    .related-product-section .owl-stage-outer {
        overflow: hidden;
        
    }
</style>

<section class="related-product-section">
    
    <div class="container">
        <div class="row">
            <div class="related-title">
                <h5>Related Product</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="product-inner owl-carousel related_slider">
                    @foreach ($products as $key => $value)
                       <div class="product_item wist_item wow zoomIn" data-wow-duration="1.5s"
                            data-wow-delay="0.{{ $key }}s">
                            <div class="product_item_inner">
                                @if($value->old_price)
                                <div class="sale-badge">
                                    <div class="sale-badge-inner">
                                        <div class="sale-badge-box">
                                            <span class="sale-badge-text">
                                                <p>@php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) @endphp {{ number_format($discount, 0) }}%</p>
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

                            @if ($averageRating >= 0 && $averageRating <= 5)
                                {{-- Filled stars --}}
                                @for ($i = 0; $i < $filledStars; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor

                                {{-- Half star --}}
                                @if ($hasHalfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif

                                {{-- Empty stars --}}
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            @else
                                <span>Invalid rating range</span>
                            @endif

                             <div class="pro_price">
                                <p>
                                    <del>৳ {{ $value->old_price }}</del>
                                    ৳ {{ $value->new_price }} @if ($value->old_price)
                                    @endif
                                </p>
                            </div>
                            @if (!$value->prosizes->isEmpty() || !$value->procolors->isEmpty())
                            <div class="pro_btn">
                                <div class="cart_btn order_button">
                                    <a href="{{ route('product', $value->slug) }}"
                                        class="addcartbutton">
                                        <span>অর্ডার করুন</span>
                                    </a>
                                </div>
                               
                            </div>
                            @else
                            <div class="pro_btn">
                                <div class="cart_btn order_button">
                                    <a class="addcartbutton" data-id="{{ $value->id }}" data-checkout="yes">
                                        <span>অর্ডার করুন</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection @push('script')
<script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('public/frontEnd/js/zoomsl.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $(".details_slider").owlCarousel({
            margin: 15,
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
        });
        $(".indicator-item").on("click", function() {
            var slideIndex = $(this).data("id");
            $(".details_slider").trigger("to.owl.carousel", slideIndex);
        });
    });
</script>
<!--Data Layer Start-->
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        ecommerce: null
    });
    dataLayer.push({
        event: "view_item",
        ecommerce: {
            items: [{
                item_name: "{{ $details->name }}",
                item_id: "{{ $details->id }}",
                price: "{{ $details->new_price }}",
                item_brand: "{{ $details->brand?$details->brand->name:'' }}",
                item_category: "{{ $details->category->name }}",
                item_variant: "{{ $details->pro_unit }}",
                currency: "BDT",
                quantity: {{ $details->stock ?? 0 }}
            }],
            impression: [
                @foreach ($products as $value)
                    {
                        item_name: "{{ $value->name }}",
                        item_id: "{{ $value->id }}",
                        price: "{{ $value->new_price }}",
                        item_brand: "{{ $details->brand?$details->brand->name:'' }}",
                        item_category: "{{ $value->category ? $value->category->name : '' }}",
                        item_variant: "{{ $value->pro_unit }}",
                        currency: "BDT",
                        quantity: {{ $value->stock ?? 0 }}
                    },
                @endforeach
            ]
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // একটি জেনেরিক ফাংশন যা add_to_cart ইভেন্টকে হ্যান্ডেল করবে
        function trackAddToCartEvent(buttonClicked) {
            // ফর্ম থেকে প্রয়োজনীয় ডেটা সংগ্রহ করুন
            var form = $('form[name="formName"]'); // ফর্মটি সিলেক্ট করুন

            var productId = form.find('input[name="id"]').val();
            var productName = "{{ $details->name }}";
            var newPrice = parseFloat("{{ $details->new_price }}"); // parseFloat ব্যবহার করুন যাতে সংখ্যা হিসেবে যায়
            var quantity = parseInt(form.find('input[name="qty"]').val()); // parseInt ব্যবহার করুন
            var productBrand = "{{ $details->brand ? $details->brand->name : '' }}";
            var productCategory = "{{ $details->category->name }}";
            var productUnit = "{{ $details->pro_unit }}";

            // নির্বাচিত কালার এবং সাইজ সংগ্রহ করা হচ্ছে
            // যদি রেডিও বাটন না থাকে, তাহলে .val() undefined দেবে, যা ঠিক আছে।
            var selectedColor = form.find('input[name="product_color"]:checked').val();
            var selectedSize = form.find('input[name="product_size"]:checked').val();

            // আইটেম অবজেক্ট তৈরি করুন
            var item = {
                item_id: productId,
                item_name: productName,
                price: newPrice,
                currency: "BDT",
                quantity: quantity,
                item_brand: productBrand, // ব্র্যান্ড যোগ করা হচ্ছে
                item_category: productCategory // ক্যাটাগরি যোগ করা হচ্ছে
            };

            // item_variant প্রপার্টিটি শুধুমাত্র তখনই যোগ করা হবে যখন একটি কালার বা সাইজ সিলেক্ট করা হয়েছে।
            // null বা undefined ভ্যালু দিয়ে item_variant সেট করা হবে না।
            var itemVariantValue = ''; // একটি খালি স্ট্রিং দিয়ে শুরু করি

            if (selectedColor) {
                itemVariantValue += selectedColor;
            }

            if (selectedSize) {
                if (itemVariantValue !== '') { // যদি কালার আগে থেকেই থাকে, তাহলে একটি স্লাশ দিয়ে যোগ করি
                    itemVariantValue += ' / ';
                }
                itemVariantValue += selectedSize;
            }

            // যদি itemVariantValue তে কোনো মান থাকে, তাহলেই item.item_variant প্রপার্টি সেট করি।
            if (itemVariantValue !== '') {
                item.item_variant = itemVariantValue;
            }

            // যদি আপনার GA4 সেটআপে কাস্টম ডাইমেনশন থাকে তবে item_unit যোগ করতে পারেন
            if (productUnit) { // যদি productUnit থাকে তবেই যোগ করুন
                item.item_unit = productUnit;
            }

            // --- ডিবাগিং এর জন্য কনসোল লগ ---
            console.log("--- GTM/GA4 Add to Cart Event Data ---");
            console.log("Event Triggered by:", buttonClicked);
            console.log("Item Object:", item); // পুরো আইটেম অবজেক্টটি দেখুন
            console.log("Calculated Total Value:", (newPrice * quantity).toFixed(2));
            console.log("--- End Debugging Data ---");
            // --- ডিবাগিং শেষ ---


            // GA4 ট্র্যাকিং (এই অংশটি GTM কনফিগারেশনের উপর নির্ভরশীল)
            // gtag("event", "add_to_cart", {
            //     currency: "BDT",
            //     value: (newPrice * quantity).toFixed(2),
            //     items: [item]
            // });

            // Facebook Pixel & GTM Data Layer Push (এটি মূল ডেটালেয়ার পুশ)
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'add_to_cart', // ইভেন্টের নাম
                ecommerce: {
                    items: [item] // তৈরি করা আইটেম অবজেক্ট
                }
            });
        }

        // 'কার্টে যোগ করুন' বাটনে ক্লিক ইভেন্ট
        $('#add_to_cart').click(function(e) {
            // sendSuccess() ফাংশনটি ভ্যালিডেশন চেক করে।
            if (sendSuccess()) {
                trackAddToCartEvent('Add to Cart Button'); // ফাংশন কল করুন
            } else {
                e.preventDefault(); // ফর্ম সাবমিশন বন্ধ করুন যদি ভ্যালিডেশন ব্যর্থ হয়
            }
        });

        // 'অর্ডার করুন' বাটনে ক্লিক ইভেন্ট
        $('#order_now').click(function(e) {
            // sendSuccess() ফাংশনটি ভ্যালিডেশন চেক করে।
            if (sendSuccess()) {
                trackAddToCartEvent('Order Now Button'); // ফাংশন কল করুন
            } else {
                e.preventDefault(); // ফর্ম সাবমিশন বন্ধ করুন যদি ভ্যালিডেশন ব্যর্থ হয়
            }
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#order_now').click(function() {

            // Facebook Pixel & GTM tracking
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'add_to_cart',
                ecommerce: {
                    items: [
                        @foreach (Cart::instance('shopping')->content() as $cartInfo)
                            {
                                item_id: "{{$details->id}}",
                                item_name: "{{$details->name}}",
                                price: "{{$details->new_price}}",
                                currency: "BDT",
                                quantity: {{ $cartInfo->qty ?? 0 }}
                            },
                        @endforeach
                    ]
                }
            });
        });
    });
</script>


<!-- Data Layer End-->
<script>
    $(document).ready(function() {
        $(".related_slider").owlCarousel({
            margin: 10,
            items: 6,
            loop: true,
            dots: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true,
                },
                600: {
                    items: 3,
                    nav: false,
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true,
                },
            },
        });
        // $('.owl-nav').remove();
    });
</script>
<script>
    $(document).ready(function() {
        $(".minus").click(function() {
            var $input = $(this).parent().find("input");
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $(".plus").click(function() {
            var $input = $(this).parent().find("input");
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });
</script>

<script>
    function sendSuccess() {
        // সাইজ ভ্যালিডেশন
        // প্রথমে চেক করুন product_size নামের কোনো ইনপুট ফিল্ড আছে কিনা।
        var sizeInputExists = document.querySelector('input[name="product_size"]');

        if (sizeInputExists) { // যদি product_size অপশন থাকে
            var selectedSize = document.querySelector('input[name="product_size"]:checked');
            if (!selectedSize) { // যদি অপশন থাকে কিন্তু কোনোটি সিলেক্ট করা না থাকে
                toastr.warning("অনুগ্রহ করে যেকোনো একটি সাইজ নির্বাচন করুন।");
                return false; // ভ্যালিডেশন ব্যর্থ
            }
            // যদি সাইজ অপশন থাকে এবং সিলেক্ট করা থাকে, তাহলে এখানে কোনো অ্যাকশন দরকার নেই।
        }
        // যদি product_size অপশন না থাকে (sizeInputExists false হয়), তাহলে ভ্যালিডেশন স্কিপ হবে।

        // কালার ভ্যালিডেশন
        // প্রথমে চেক করুন product_color নামের কোনো ইনপুট ফিল্ড আছে কিনা।
        var colorInputExists = document.querySelector('input[name="product_color"]');

        if (colorInputExists) { // যদি product_color অপশন থাকে
            var selectedColor = document.querySelector('input[name="product_color"]:checked');
            if (!selectedColor) { // যদি অপশন থাকে কিন্তু কোনোটি সিলেক্ট করা না থাকে
                toastr.error("অনুগ্রহ করে যেকোনো একটি রঙ নির্বাচন করুন।");
                return false; // ভ্যালিডেশন ব্যর্থ
            }
            // যদি কালার অপশন থাকে এবং সিলেক্ট করা থাকে, তাহলে এখানে কোনো অ্যাকশন দরকার নেই।
        }
        // যদি product_color অপশন না থাকে (colorInputExists false হয়), তাহলে ভ্যালিডেশন স্কিপ হবে।

        // সকল প্রযোজ্য ভ্যালিডেশন সফল হলে true রিটার্ন করুন।
        return true;
    }
</script>
<script>
    $(document).ready(function() {
        $(".rating label").click(function() {
            $(".rating label").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".thumb_slider").owlCarousel({
            margin: 15,
            items: 4,
            loop: true,
            dots: false,
            nav: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
        });
    });
</script>

<script type="text/javascript">
    $(".block__pic").imagezoomsl({
        zoomrange: [3, 3]
    });
</script>
@endpush
