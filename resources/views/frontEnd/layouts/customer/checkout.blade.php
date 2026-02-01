

@extends('frontEnd.layouts.master') @section('title', 'Customer Checkout') @push('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/select2.min.css') }}" />
    <style>
        .chheckout-section {
            background: #f8f9fa;
            padding: 40px 0;
        }

        .checkout-shipping .card,
        .cart_details .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .checkout-shipping .card-header,
        .cart_details .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
            padding: 20px 25px;
        }

        .checkout-shipping .card-header h6,
        .cart_details .card-header h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #002366;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-shipping .card-header h6 i,
        .cart_details .card-header h5 i {
            color: #ff3b30;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            border-radius: 8px !important;
            border: 1px solid #999 !important;
            padding: 12px 15px !important;
            height: auto !important;
            font-size: 14px !important;
            transition: all 0.3s !important;
            background: #fff !important;
        }

        .form-control:focus {
            border-color: #002366 !important;
            box-shadow: 0 0 0 3px rgba(0, 35, 102, 0.1) !important;
            outline: none !important;
        }

        .coupon_wrapper .form-control {
            border: 1px solid #888 !important;
        }

        .order_place {
            background: #002366;
            color: #fff;
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 18px;
            transition: 0.3s;
            margin-top: 10px;
        }

        .order_place:hover {
            background: #3c7d17;
        }

        .cartlist_item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px dashed #eee;
            gap: 15px;
        }

        .cartlist_item:last-child {
            border-bottom: none;
        }

        .cartlist_img {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #f1f1f1;
        }

        .cartlist_info {
            flex: 1;
        }

        .cartlist_info a {
            font-weight: 600;
            color: #333;
            text-decoration: none;
            font-size: 15px;
            display: block;
            margin-bottom: 5px;
        }

        .cartlist_qty_wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }

        .vcart-qty .quantity {
            display: flex;
            border: 1px solid #eee;
            border-radius: 6px;
            overflow: hidden;
            background: #fdfdfd;
        }

        .vcart-qty .quantity button {
            border: none;
            background: none;
            padding: 0 10px;
            font-size: 18px;
            color: #666;
        }

        .vcart-qty .quantity input {
            width: 45px;
            border: none;
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            background: none;
            padding: 0;
            margin-left: 15px;
        }

        .cartlist_price {
            text-align: right;
            font-weight: 700;
            color: #333;
        }

        .cart_remove_btn {
            color: #ff3b30;
            cursor: pointer;
            font-size: 16px;
        }

        .summary_table {
            width: 100%;
            margin-top: 20px;
        }

        .summary_table tr td {
            padding: 10px 0;
            font-size: 15px;
            color: #555;
        }

        .summary_table tr td:last-child {
            text-align: right;
            font-weight: 700;
            color: #333;
        }

        .summary_table tr.total_row td {
            border-top: 1px solid #eee;
            padding-top: 15px;
            font-size: 18px;
            color: #002366;
            font-weight: 800;
        }

        .coupon_wrapper {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .coupon_wrapper .form-control {
            flex: 1;
        }

        #apply_coupon {
            background: #002366 !important;
            color: #fff !important;
            border: none;
            padding: 0 20px;
            border-radius: 8px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .payment_method_wrapper {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .checkout-support-banner {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #f0f0f0;
            text-align: center;
        }

        .checkout-support-banner h5 {
            color: #002366;
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .support-buttons-flex {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .support-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            font-size: 14px;
            border: none;
        }

        .support-btn:hover {
            opacity: 0.9;
            color: #fff;
            transform: translateY(-2px);
        }

        .support-btn.whatsapp {
            background: #25D366;
        }

        .support-btn.messenger {
            background: #0084FF;
        }

        .support-btn.call {
            background: #FF3B30;
        }

        @media (max-width: 576px) {
            .chheckout-section {
                padding: 20px 0;
            }

            .cus-order-2 {
                order: 2;
            }

            .cust-order-1 {
                order: 1;
            }

            .checkout-support-banner {
                padding: 15px 10px;
            }

            .support-buttons-flex {
                gap: 5px;
            }

            .support-btn {
                padding: 8px 10px;
                font-size: 12px;
                flex: 1;
                min-width: 0;
                justify-content: center;
            }

            .support-btn i {
                font-size: 16px;
                margin: 0;
            }

            .checkout-support-banner h5 {
                font-size: 15px;
            }

            .coupon_wrapper {
                flex-direction: column;
            }

            #apply_coupon {
                padding: 12px;
            }

            .cartlist_item {
                gap: 10px;
            }

            .cartlist_img {
                width: 60px;
                height: 60px;
            }

            .cartlist_info a {
                font-size: 14px;
            }

            .vcart-qty .quantity button {
                padding: 0 8px;
            }

            .vcart-qty .quantity input {
                width: 35px;
                padding: 0;
                margin-left: 5px;
            }
        }
    </style>
@endpush @section('content')
    <section class="chheckout-section">
        @php
            $subtotal = Cart::instance('shopping')->subtotal();
            $subtotal = str_replace(',', '', $subtotal);
            $subtotal = str_replace('.00', '', $subtotal);
            $shipping = Session::get('shipping') ? Session::get('shipping') : 0;
        @endphp
        <div class="container">
            <div class="row">
                <!-- Support Banner -->
                <div class="col-sm-12 order-0">
                    <div class="checkout-support-banner">
                        <h5>অর্ডার করতে সমস্যা হচ্ছে? সরাসরি আমাদের সাথে যোগাযোগ করুন:</h5>
                        <div class="support-buttons-flex">
                            @if($contact->messenger)
                                <a href="https://m.me/{{$contact->messenger}}" target="_blank" class="support-btn messenger">
                                    <i class="fa-brands fa-facebook-messenger"></i> Messenger
                                </a>
                            @endif

                            @if($contact->whatsapp)
                                <a href="https://api.whatsapp.com/send?phone={{ $contact->whatsapp }}&text=অর্ডার করতে সমস্যা হচ্ছে"
                                    target="_blank" class="support-btn whatsapp">
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
                </div>
                
                <div class="col-sm-7 cust-order-1">
                    <div class="cart_details table-responsive-sm">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="fa fa-shopping-bag"></i> অর্ডার সামারি
                                    ({{ Cart::instance('shopping')->count() }})</h5>
                            </div>
                            <div class="card-body cartlist">
                                @foreach (Cart::instance('shopping')->content() as $value)
                                    <div class="cartlist_item">
                                        <img src="{{ asset($value->options->image) }}" class="cartlist_img" alt="" />
                                        <div class="cartlist_info">
                                            <a
                                                href="{{ route('product', $value->options->slug) }}">{{ Str::limit($value->name, 40) }}</a>
                                            <div class="cartlist_qty_wrapper">
                                                <div class="qty-cart vcart-qty">
                                                    <div class="quantity">
                                                        <button class="minus cart_decrement"
                                                            data-id="{{ $value->rowId }}">-</button>
                                                        <input type="text" value="{{ $value->qty }}" readonly />
                                                        <button class="plus cart_increment"
                                                            data-id="{{ $value->rowId }}">+</button>
                                                    </div>
                                                </div>
                                                <span class="cart_remove_btn cart_remove" data-id="{{ $value->rowId }}"><i
                                                        class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                        <div class="cartlist_price">
                                            ৳ {{ $value->price }}
                                        </div>
                                    </div>
                                @endforeach

                                <table class="summary_table">
                                    <tr>
                                        <td>মোট</td>
                                        <td>৳ <span id="net_total">{{ $subtotal }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>ডেলিভারি চার্জ</td>
                                        <td>৳ <span id="cart_shipping_cost">{{ $shipping }}</span></td>
                                    </tr>
                                    @if(Session::get('discount', 0) > 0)
                                        <tr>
                                            <td>কুপন ছাড়</td>
                                            <td>৳ <span id="discount">{{ Session::get('discount', 0) }}</span></td>
                                        </tr>
                                    @endif
                                    <tr class="total_row">
                                        <td>সর্বমোট</td>
                                        <td>৳ <span
                                                id="grand_total">{{ $subtotal + $shipping - Session::get('discount', 0) }}</span>
                                        </td>
                                    </tr>
                                </table>

                                <form id="coupon_form" class="mt-3">
                                    <div class="coupon_wrapper">
                                        <input type="text" id="coupon_code" class="form-control"
                                            placeholder="কুপন কোড থাকলে এখানে লিখুন...">
                                        <button type="button" id="apply_coupon">APPLY</button>
                                    </div>
                                    <div id="coupon-message" class="mt-2"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col end -->

                <div class="col-sm-5 cus-order-2">
                    <div class="checkout-shipping">
                        <form action="{{ route('customer.ordersave') }}" method="POST" data-parsley-validate="">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h6><i class="fa fa-truck"></i> শিপিং এবং ফিলিং তথ্য</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="name">আপনার নাম লিখুন *</label>
                                                <input type="text" id="name"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    placeholder="সম্পূর্ণ নাম লিখুন"
                                                    value="@if(Auth::guard('customer')->user()){{ Auth::guard('customer')->user()->name }}@else{{ old('name') }}@endif"
                                                    required />
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="phone">মোবাইল নাম্বার দিন *</label>
                                                <input type="text" minlength="11" id="phone" maxlength="11"
                                                    pattern="0[0-9]+" placeholder="017xxxxxxxx"
                                                    title="Please enter an 11-digit number."
                                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                    value="@if(Auth::guard('customer')->user()){{ Auth::guard('customer')->user()->phone }}@else{{ old('phone') }}@endif"
                                                    required />
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="additional_phone">অতিরিক্ত মোবাইল নাম্বার (ঐচ্ছিক) </label>
                                                <input type="text" minlength="11" id="additional_phone" maxlength="11"
                                                    pattern="0[0-9]+" placeholder="017xxxxxxxx"
                                                    class="form-control @error('additional_phone') is-invalid @enderror"
                                                    name="additional_phone" value="{{ old('additional_phone') }}" />
                                                @error('additional_phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="address">আপনার ঠিকানা লিখুন *</label>
                                                <input type="text" id="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    placeholder="গ্রাম, থানা, জেলা" name="address"
                                                    value="@if(Auth::guard('customer')->user()){{ Auth::guard('customer')->user()->address }}@else{{ old('address') }}@endif"
                                                    required />
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="area">ডেলিভারি এরিয়া নিবার্চন করুন *</label>
                                                <select id="area"
                                                    class="form-control select2 @error('area') is-invalid @enderror"
                                                    name="area" required>
                                                    <option value="">এরিয়া নির্বাচন করুন...</option>
                                                    @foreach ($shippingcharge as $key => $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('area')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="payment_method_wrapper">
                                                <label class="mb-2 d-block font-weight-bold">পেমেন্ট মেথড</label>
                                                <div class="form-check p_cash">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="inlineRadio1" value="Cash On Delivery" checked required />
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        <img src="{{ asset('public/frontEnd/images/cod.png') }}" alt="COD" style="height: 30px; margin-right: 8px;"> ক্যাশ অন ডেলিভারি
                                                    </label>
                                                </div>
                                                @if($bkash_gateway)
                                                    <div class="form-check p_bkash">
                                                        <input class="form-check-input" type="radio" name="payment_method"
                                                            id="inlineRadio2" value="bkash" required />
                                                        <label class="form-check-label" for="inlineRadio2">
                                                            <img src="{{ asset('public/frontEnd/images/bkash.png') }}" alt="Bkash" style="height: 30px; margin-right: 8px;"> বিকাশ
                                                        </label>
                                                    </div>
                                                @endif
                                                @if($shurjopay_gateway)
                                                    <div class="form-check p_shurjo">
                                                        <input class="form-check-input" type="radio" name="payment_method"
                                                            id="inlineRadio3" value="shurjopay" required />
                                                        <label class="form-check-label" for="inlineRadio3">
                                                            <img src="https://shurjopay.com.bd/dev/images/shurjoPay.png" alt="Shurjopay" style="height: 30px; margin-right: 8px;"> সূর্য্যপে
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button class="order_place" type="submit">অর্ডার করুন</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- col end -->
            </div>
        </div>
    </section>
@endsection @push('script')
    <script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
    <script>
        // Debounce function to limit AJAX calls
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        // Function to save incomplete order
        function saveIncompleteOrder() {
            let formData = {
                _token: "{{ csrf_token() }}",
                name: $('#name').val(),
                phone: $('#phone').val(),
                additional_phone: $('#additional_phone').val(),
                address: $('#address').val(),
                area: $('#area').val(),
                note: $('textarea[name="note"]').val() // Include note if it exists
            };

            $.ajax({
                url: "{{ route('customer.incomplete_order.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    // console.log('Incomplete order saved');
                },
                error: function(xhr) {
                    // console.log('Error saving incomplete order');
                }
            });
        }

        // Event listeners for inputs with debounce
        $('#name, #phone, #additional_phone, #address, textarea[name="note"]').on('input', debounce(function() {
            saveIncompleteOrder();
        }, 1000));



        // Event listeners for change events (selects, radios, etc.)
        $('#area').on('change', function() {
            saveIncompleteOrder();
        });

        $("#area").on("change", function () {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    id: id
                },
                url: "{{ route('shipping.charge') }}",
                dataType: "html",
                success: function (response) {
                    $(".cartlist").html(response);
                    saveIncompleteOrder(); // Save after cart update
                },
            });
        });

        function cart_list() {
            $.ajax({
                type: "GET",
                url: "{{ route('shipping.charge') }}",
                dataType: "html",
                success: function (response) {
                    $(".cartlist").html(response);
                    saveIncompleteOrder(); // Save after cart update
                },
            });
        }
        $('#apply_coupon').on('click', function () {

            let couponCode = $('#coupon_code').val();
            // cart_list();
            // if (!couponCode) {
            //     $('#coupon-message').html('<div class="alert alert-danger">Please enter a coupon code!</div>');
            //     return;
            // }

            $.ajax({
                url: "{{ route('coupon.apply') }}",  // Ensure this route matches the correct one
                type: 'POST',
                data: {
                    coupon_code: couponCode,
                    _token: "{{ csrf_token() }}" // CSRF token for Laravel
                },
                success: function (response) {

                    if (response.status) {

                        $('#coupon-message').html('<div class="alert alert-success">' + response.message + '</div>');
                        // Update discount and total prices on page
                        $('#discount').text(response.discount);
                        $('#grand_total').text(parseFloat({{ Cart::instance('shopping')->subtotal() }}) - response.discount);
                    } else {
                        $('#coupon-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                    cart_list();
                },
                error: function (response) {

                    $('#coupon-message').html('<div class="alert alert-danger">Something went wrong! Please try again.</div>');
                    cart_list();
                }
            });
        });
    </script>
    <script type="text/javascript">
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "view_cart",
            ecommerce: {
                items: [@foreach (Cart::instance('shopping')->content() as $cartInfo){
                    item_name: "{{$cartInfo->name}}",
                    item_id: "{{$cartInfo->id}}",
                    price: "{{$cartInfo->price}}",
                    item_brand: "{{$cartInfo->options->brand}}",
                    item_category: "{{$cartInfo->options->category}}",
                    item_size: "{{$cartInfo->options->size}}",
                    item_color: "{{$cartInfo->options->color}}",
                    currency: "BDT",
                    quantity: {{$cartInfo->qty ?? 0}}
                }, @endforeach]
            }
        });
    </script>
    <script type="text/javascript">
        // Clear the previous ecommerce object.
        dataLayer.push({ ecommerce: null });

        // Push the begin_checkout event to dataLayer.
        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                items: [@foreach (Cart::instance('shopping')->content() as $cartInfo)
                    {
                    item_name: "{{$cartInfo->name}}",
                    item_id: "{{$cartInfo->id}}",
                    price: "{{$cartInfo->price}}",
                    item_brand: "{{$cartInfo->options->brands}}",
                    item_category: "{{$cartInfo->options->category}}",
                    item_size: "{{$cartInfo->options->size}}",
                    item_color: "{{$cartInfo->options->color}}",
                    currency: "BDT",
                    quantity: {{$cartInfo->qty ?? 0}}
                    },
                @endforeach]
            }
        });
    </script>
@endpush