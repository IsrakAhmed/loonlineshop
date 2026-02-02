@extends('backEnd.layouts.master')
@section('title', $order_status->name . ' Order')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{route('admin.order.create')}}" class="btn btn-danger rounded-pill"><i
                                class="fe-shopping-cart"></i> Add New</a>
                    </div>
                    <h4 class="page-title">{{$order_status->name}} Order ({{$order_status->orders_count}})</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row order_page">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <ul class="action2-btn">
                                    <li><a data-bs-toggle="modal" data-bs-target="#asignUser"
                                            class="btn rounded-pill btn-success"><i class="fe-plus"></i> Assign User</a>
                                    </li>
                                    <li><a data-bs-toggle="modal" data-bs-target="#changeStatus"
                                            class="btn rounded-pill btn-primary"><i class="fe-plus"></i> Change Status</a>
                                    </li>
                                    <li><a href="{{route('admin.order.bulk_destroy')}}"
                                            class="btn rounded-pill btn-danger order_delete"><i class="fe-plus"></i> Delete
                                            All</a></li>
                                    <li><a href="{{route('admin.order.order_print')}}"
                                            class="btn rounded-pill btn-info multi_order_print"><i class="fe-printer"></i>
                                            Print</a></li>
                                    @if($steadfast)
                                        <li><a href="{{route('admin.bulk_courier', 'steadfast')}}"
                                                class="btn rounded-pill btn-warning multi_order_courier"><i
                                                    class="fe-truck"></i> Steadfast</a></li>
                                    @endif
                                    <li><a data-bs-toggle="modal" data-bs-target="#pathao"
                                            class="btn rounded-pill btn-info"><i class="fe-truck"></i> pathao</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <form class="custom_form">
                                    <div class="form-group">
                                        <input type="text" name="keyword" placeholder="Search">
                                        <button class="btn  rounded-pill btn-info">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive ">
                            <table id="datatable-buttons" class="table table-striped   w-100">


                                <thead>
                                    <tr>
                                        <th style="width:2%">
                                            <div class="form-check"><label class="form-check-label"><input type="checkbox"
                                                        class="form-check-input checkall" value=""></label>

                                        <th style="width:5%">Action</th>
                                        <th style="width:45%">Invoice</th>
                                        <th style="width:50%">Products</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach($show_data as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox" value="{{$value->id}}"></td>

                                            <td style="text-align: center; vertical-align: top;">
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{ route('admin.order.invoice', ['invoice_id' => $value->invoice_id]) }}"
                                                        title="Invoice" style="display: inline-block; margin: 4px;">
                                                        <i class="fe-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.order.process', ['invoice_id' => $value->invoice_id]) }}"
                                                        title="Process" style="display: inline-block; margin: 4px;">
                                                        <i class="fe-settings"></i>
                                                    </a>
                                                    <a href="{{ route('admin.order.edit', ['invoice_id' => $value->invoice_id]) }}"
                                                        title="Edit" style="display: inline-block; margin: 4px;">
                                                        <i class="fe-edit"></i>
                                                    </a>
                                                    <form method="post" action="{{ route('admin.order.destroy') }}"
                                                        class="d-inline" style="display: inline-block; margin: 4px;">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="id">
                                                        <button type="submit" title="Delete" class="delete-confirm"
                                                            style="background: none; border: none; color: red;">
                                                            <i class="fe-trash-2"></i>
                                                        </button>
                                                    </form>




                                                </div>

                                                <!-- Centered Fraud Check Button -->
                                                <div style="display: flex; justify: center; padding-bottom: 10px;">
                                                    <button type="button" title="Fraud Check"
                                                        class="btn btn-sm btn-info fraud-check-btn"
                                                        data-phone="{{ $value->shipping ? $value->shipping->phone : '' }}">
                                                        <i class="">Fraud Check</i>
                                                    </button>
                                                </div>
                                            </td>

                                            <td style="border:1px solid lightgray; padding: 10px;">
                                                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                    <div style="width: 48%;">
                                                        SL: {{ $loop->iteration }} <br>
                                                        Invoice: {{ $value->invoice_id }} <br>
                                                        Date: {{ date('d-m-Y', strtotime($value->updated_at)) }} <br>
                                                        Time: {{ date('h:i:s a', strtotime($value->updated_at)) }} <br>
                                                        Name:
                                                        <strong>{{ $value->shipping ? $value->shipping->name : '' }}</strong>
                                                        <br>
                                                        Address: {{ $value->shipping ? $value->shipping->address : '' }} <br>
                                                        Note: {{ $value->note ? $value->note : 'N/A' }} <br>
                                                    </div>
                                                    <div style="width: 48%;">
                                                        Phone: {{ $value->shipping ? $value->shipping->phone : '' }} <br>
                                                        @if($value->shipping && $value->shipping->additional_phone)
                                                            Extra: {{ $value->shipping->additional_phone }} <br>
                                                        @endif
                                                        Assign: {{ $value->user ? $value->user->name : '' }} <br>
                                                        Amount: ৳{{ $value->amount }} <br>
                                                        IP: {{ $value->user_ip }} <br>
                                                        Status: {{ $value->status ? $value->status->name : '' }} <br>
                                                        <strong style="color:tomato;">Comment: {{ $value->admin_note }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $products = json_decode($value->orderdetails, true);
                                                @endphp

                                                @if(!empty($products))
                                                    @foreach($products as $product_key => $product_value)
                                                        @php
                                                            $product_image = \App\Models\Productimage::where('product_id', $product_value['product_id'])->select('image')->first();
                                                        @endphp
                                                        <div
                                                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; padding: 5px 0;">
                                                            <!-- Product Details (Left Side) -->
                                                            <div style="flex: 1; font-size: 13px; line-height: 1.4;">
                                                                <strong>Product:</strong> {{ $product_value['product_name'] }} <br>
                                                                <strong>Qty:</strong> {{ $product_value['qty'] }} <br>
                                                                <strong>Size:</strong> {{ $product_value['product_size'] ?? 'N/A' }}
                                                                <br>
                                                                <strong>Color:</strong> {{ $product_value['product_color'] ?? 'N/A' }}
                                                                <br>
                                                                <strong>Price:</strong> ৳{{ $product_value['sale_price'] }}
                                                            </div>

                                                            <!-- Product Image (Right Side) -->
                                                            <div style="margin-left: 10px;">
                                                                <img src="{{ asset($product_image->image ?? 'default.jpg') }}"
                                                                    alt="Product Image"
                                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p style="font-size: 13px;">No product details found.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="custom-paginate">
                            {{$show_data->links('pagination::bootstrap-4')}}
                        </div>
                    </div> <!-- end card body-->

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>






    <!-- Assign User End -->
    <div class="modal fade" id="asignUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.order.assign')}}" id="order_assign">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">Select..</option>
                                @foreach($users as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Assign User End-->

    <!-- Assign User End -->
    <div class="modal fade" id="changeStatus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.order.status')}}" id="order_status_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="order_status" id="order_status" class="form-control">
                                <option value="">Select..</option>
                                @foreach($orderstatus as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Assign User End-->
    <!-- pathao coureir start -->
    <div class="modal fade" id="pathao" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pathao Courier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.order.pathao')}}" id="order_sendto_pathao">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pathaostore" class="form-label">Store</label>
                            <select name="pathaostore" id="pathaostore" class="pathaostore form-control">
                                <option value="">Select Store...</option>
                                @if(isset($pathaostore['data']['data']))
                                    @foreach($pathaostore['data']['data'] as $key => $store)
                                        <option value="{{$store['store_id']}}">{{$store['store_name']}}</option>
                                    @endforeach
                                @else
                                @endif
                            </select>
                            @if ($errors->has('pathaostore'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pathaostore') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- form group end -->
                        <div class="form-group mt-3">
                            <label for="pathaocity" class="form-label">City</label>
                            <select name="pathaocity" id="pathaocity" class="chosen-select pathaocity form-control"
                                style="width:100%">
                                <option value="">Select City...</option>
                                @if(isset($pathaocities['data']['data']))
                                    @foreach($pathaocities['data']['data'] as $key => $city)
                                        <option value="{{$city['city_id']}}">{{$city['city_name']}}</option>
                                    @endforeach
                                @else
                                @endif
                            </select>
                            @if ($errors->has('pathaocity'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pathaocity') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- form group end -->
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Zone</label>
                            <select name="pathaozone" id="pathaozone"
                                class="pathaozone chosen-select form-control  {{ $errors->has('pathaozone') ? ' is-invalid' : '' }}"
                                value="{{ old('pathaozone') }}" style="width:100%">
                            </select>
                            @if ($errors->has('pathaozone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pathaozone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- form group end -->
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Area</label>
                            <select name="pathaoarea" id="pathaoarea"
                                class="pathaoarea chosen-select form-control  {{ $errors->has('pathaoarea') ? ' is-invalid' : '' }}"
                                value="{{ old('pathaoarea') }}" style="width:100%">
                            </select>
                            @if ($errors->has('pathaoarea'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pathaoarea') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- form group end -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Fraud Check Modal -->
    <div class="modal fade" id="fraudCheckModal" tabindex="-1" aria-labelledby="fraudCheckModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fraudCheckModalLabel">Fraud Check Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="fraudCheckResult">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>




    <!-- pathao courier  End-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".checkall").on('change', function () {
                $(".checkbox").prop('checked', $(this).is(":checked"));
            });

            // order assign
            $(document).on('submit', 'form#order_assign', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                let user_id = $(document).find('select#user_id').val();

                var order = $('input.checkbox:checked').map(function () {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { user_id, order_ids },
                    success: function (res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });

            // order status change 
            $(document).on('submit', 'form#order_status_form', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                let order_status = $(document).find('select#order_status').val();

                var order = $('input.checkbox:checked').map(function () {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { order_status, order_ids },
                    success: function (res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });
            // order delete
            $(document).on('click', '.order_delete', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function () {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { order_ids },
                    success: function (res) {
                        if (res.status == 'success') {
                            toastr.success(res.message);
                            window.location.reload();

                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });

            });

            // multiple print
            $(document).on('click', '.multi_order_print', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function () {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select Atleast One Order!');
                    return;
                }
                $.ajax({
                    type: 'GET',
                    url,
                    data: { order_ids },
                    success: function (res) {
                        if (res.status == 'success') {
                            console.log(res.items, res.info);
                            var myWindow = window.open("", "_blank");
                            myWindow.document.write(res.view);
                        } else {
                            toastr.error('Failed something wrong');
                        }
                    }
                });
            });
            // multiple courier
            $(document).on('click', '.multi_order_courier', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var order = $('input.checkbox:checked').map(function () {
                    return $(this).val();
                });
                var order_ids = order.get();

                if (order_ids.length == 0) {
                    toastr.error('Please Select An Order First !');
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { order_ids },
                    success: function (res) {
                        console.log(res);

                        // Partial success (some orders successful, some failed)
                        if (res.status === 'partial') {
                            if (res.success && res.success.length > 0) {
                                toastr.success(res.success.join("<br>"));
                            }
                            if (res.failed && res.failed.length > 0) {
                                toastr.error(res.failed.join("<br>"));
                            }
                            setTimeout(() => window.location.reload(), 1500);
                        }
                        // Complete success
                        else if (res.status === 'success') {
                            toastr.success(res.message || 'All orders placed successfully.');
                            setTimeout(() => window.location.reload(), 1500);
                        }
                        // Complete failure
                        else {
                            toastr.error(res.message || 'Something went wrong!');
                        }
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = 'Error: ' + (xhr.responseJSON?.message || xhr.responseText || error || 'Something went wrong!');
                        toastr.error(errorMessage);
                        console.error('AJAX Error:', errorMessage);
                    }
                });



            });
        })
    </script>

    <script>
        $(document).ready(function () {
            $('.fraud-check-btn').on('click', function () {
                const phone = $(this).data('phone');
                const apiToken = @json($activeApi?->api_key ?? '');
                const apiBaseUrl = @json($activeApi?->url ?? '');

                if (!phone) {
                    alert("Phone number not found for this order.");
                    return;
                }

                $('#fraudCheckResult').html('<p>Checking for <strong>' + phone + '</strong>...</p>');
                $('#fraudCheckModal').modal('show');


                console.log('API URL:', apiBaseUrl);
                console.log('API Token:', apiToken);

                $.ajax({
                    url: apiBaseUrl,
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'Authorization': 'Bearer ' + apiToken
                    },
                    data: JSON.stringify({ phone: phone }),
                    success: function (response) {
                        if (response.status !== "success" || !response.courierData) {
                            $('#fraudCheckResult').html('<p class="text-danger">Invalid response format.</p>');
                            return;
                        }

                        let courierData = response.courierData;
                        let tableHTML = `
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped text-center align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Logo</th>
                                                <th>Courier Name</th>
                                                <th>Total Parcel</th>
                                                <th>Success Parcel</th>
                                                <th>Cancelled Parcel</th>
                                                <th>Success Ratio (%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                `;

                        for (let key in courierData) {
                            if (key === 'summary') continue;

                            let c = courierData[key];
                            tableHTML += `
                                        <tr>
                                            <td><img src="${c.logo}" alt="${c.name}" width="80"></td>
                                            <td>${c.name}</td>
                                            <td>${c.total_parcel}</td>
                                            <td>${c.success_parcel}</td>
                                            <td>${c.cancelled_parcel}</td>
                                            <td>${c.success_ratio}%</td>
                                        </tr>
                                    `;
                        }

                        let summary = courierData.summary;
                        tableHTML += `
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr class="fw-bold">
                                                <td colspan="2">Summary</td>
                                                <td>${summary.total_parcel}</td>
                                                <td>${summary.success_parcel}</td>
                                                <td>${summary.cancelled_parcel}</td>
                                                <td>${summary.success_ratio}%</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                `;

                        $('#fraudCheckResult').html(tableHTML);
                    },
                    error: function (xhr, status, error) {
                        $('#fraudCheckResult').html('<p class="text-danger">Error: ' + xhr.status + ' - ' + xhr.responseText + '</p>');
                    }
                });
            });
        });
    </script>




@endsection