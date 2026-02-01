@extends('backEnd.layouts.master')
@section('title', 'Dashboard')
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backEnd/')}}/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet"
        type="text/css" />

@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12" style="padding-top: 0; padding-left: 20px; padding-right: 20px; padding-bottom: 30px;">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <style>
                        .btn-custom-primary {
                            background: #1e88e5;
                            /* গাঢ় নীল */
                            border: none;
                            color: #fff;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.4);
                            transition: background 0.3s ease, box-shadow 0.3s ease;
                        }

                        .btn-custom-primary:hover {
                            background: #1565c0;
                            box-shadow: 0 6px 20px rgba(21, 101, 192, 0.6);
                            color: #fff;
                        }

                        .btn-custom-secondary {
                            background: #f8bbd0;
                            /* হালকা গোলাপি */
                            border: none;
                            color: #880e4f;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(248, 187, 208, 0.6);
                            transition: background 0.3s ease, box-shadow 0.3s ease;
                        }

                        .btn-custom-secondary:hover {
                            background: #f48fb1;
                            box-shadow: 0 6px 20px rgba(244, 143, 177, 0.8);
                            color: #4a004d;
                        }

                        .btn-custom-primary i,
                        .btn-custom-secondary i {
                            vertical-align: middle;
                        }

                        .btn-custom-primary,
                        .btn-custom-secondary {
                            border-radius: 20px;
                            /* বা 0.5rem */
                        }

                        .btn-dev-support {
                            background-color: rgb(104, 6, 173);
                            /* Dark Indigo */
                            color: #ffffff;
                            font-weight: 600;
                            border: none;
                            border-radius: 8px;
                            box-shadow: 0 4px 12px rgba(75, 0, 130, 0.3);
                            transition: all 0.3s ease;
                        }

                        .btn-dev-support:hover {
                            background-color: rgb(89, 4, 155);
                            box-shadow: 0 6px 20px rgba(55, 0, 98, 0.5);
                            color: #fff;
                        }

                        .btn-dev-support i {
                            vertical-align: middle;
                        }
                    </style>




                    <!-- <h4 class="page-title mb-0" style="color:rgb(231, 68, 18); font-size: 28px; font-weight: 700;">
                            Live Dashboard
                        </h4> -->

                </div>
            </div>
        </div>

        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card gradient-purple">
                    <style>
                        .gradient-purple {
                            background: linear-gradient(135deg, #D9D5F6, #6658dd);
                            color: white;
                            border: none;
                            box-shadow: 0 4px 20px rgba(157, 80, 187, 0.3);
                        }

                        .gradient-purple .text-end h3,
                        .gradient-purple .text-end p {
                            color: #ffffff !important;
                        }
                    </style>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary border-white border">
                                    <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$total_order}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Oreder</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card gradient-mint">
                    <style>
                        .gradient-mint {
                            background: linear-gradient(135deg, #C6EEE6, #1ABC9E);
                            color: white;
                            border: none;
                            box-shadow: 0 4px 20px rgba(26, 188, 156, 0.3);
                        }

                        .gradient-mint h3,
                        .gradient-mint p,
                        .gradient-mint .text-dark,
                        .gradient-mint .text-muted {
                            color: #ffffff !important;
                        }
                    </style>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success border-white border">
                                    <i class="fe-shopping-bag font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$today_order}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Today's Order</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card gradient-skyblue">
                    <style>
                        .gradient-skyblue {
                            background: linear-gradient(135deg, #D0EFF8, #43BFE7);
                            color: white;
                            border: none;
                            box-shadow: 0 4px 20px rgba(67, 191, 231, 0.3);
                        }

                        .gradient-skyblue h3,
                        .gradient-skyblue p,
                        .gradient-skyblue .text-dark,
                        .gradient-skyblue .text-muted {
                            color: #ffffff !important;
                        }
                    </style>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-white border">
                                    <i class="fe-database font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$total_product}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Products</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card gradient-amber">
                    <style>
                        .gradient-amber {
                            background: linear-gradient(135deg, #FDEDD2, #DB9A32);
                            color: white;
                            border: none;
                            box-shadow: 0 4px 20px rgba(219, 154, 50, 0.3);
                        }

                        .gradient-amber h3,
                        .gradient-amber p,
                        .gradient-amber .text-dark,
                        .gradient-amber .text-muted {
                            color: #ffffff !important;
                        }
                    </style>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning border-white border">
                                    <i class="fe-user font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$total_customer}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Customer</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-xl-6">
                <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">

                    <div class="card-body" style="background-color: #944df7; color: white;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4 class="header-title fw-semibold" style="color: #ffde59;">Latest 7 Orders</h4>

                            <div class="dropdown">
                                <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical fs-5"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Edit Report</a></li>
                                    <li><a class="dropdown-item" href="#">Export Report</a></li>
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table table-hover align-middle table-striped table-bordered mb-0 bg-white text-dark rounded">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse($latest_order as $order)
                                        <tr>
                                            <td class="fw-bold">{{$loop->iteration}}</td>
                                            <td>
                                                <img src="{{ asset($order->product ? $order->product->image->image : 'assets/images/default-product.png') }}"
                                                    alt="Product" class="rounded-circle shadow-sm" width="40" height="40">
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary text-white">{{ $order->invoice_id }}</span>
                                            </td>
                                            <td>
                                                <strong class="text-success">৳{{ number_format($order->amount, 2) }}</strong>
                                            </td>
                                            <td>{{ $order->customer ? $order->customer->name : 'Unknown' }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = match ($order->order_status) {
                                                        'Pending' => 'warning',
                                                        'Completed' => 'success',
                                                        'Cancelled' => 'danger',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $badgeClass }}">{{ $order->order_status }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No recent orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card shadow-lg border-0"
                    style="border-radius: 1rem; overflow: hidden; background: linear-gradient(135deg, #e0c3fc, #8ec5fc);">
                    <div class="card-body" style="color: #212529;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4 class="header-title fw-semibold" style="color: #5c2d91;">Latest Customers</h4>
                            <div class="dropdown">
                                <a href="#" class="text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical fs-5"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Edit Report</a></li>
                                    <li><a class="dropdown-item" href="#">Export Report</a></li>
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table table-hover align-middle table-striped table-bordered mb-0 bg-white text-dark">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse($latest_customer as $customer)
                                        <tr>
                                            <td><strong>{{ $loop->iteration }}</strong></td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = match ($customer->status) {
                                                        'Active' => 'success',
                                                        'Inactive' => 'secondary',
                                                        'Blocked' => 'danger',
                                                        default => 'warning'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $badgeClass }}">{{ $customer->status }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-muted">No recent customers found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

    </div> <!-- container -->

    <div class="page-title-right">
        <!-- <a href="{{ config('app.url') }}" target="_blank" class="btn btn-custom-primary me-2">
                                <i class="mdi mdi-web me-1"></i> Visit Website
                            </a> -->


        <a href="https://www.solutionitbd.com/" target="_blank" class="btn btn-dev-support me-2">
            <i class="mdi mdi-headset me-1"></i> Developer Support
        </a>

    </div>
@endsection
@section('script')
    <!-- Plugins js-->
    <script src="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/libs/selectize/js/standalone/selectize.min.js"></script>

    <script>

        var colors = ["#f1556c"],
            dataColors = $("#total-revenue").data("colors");
        dataColors && (colors = dataColors.split(","));
        var options = {

            chart: {
                height: 242,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: "65%"
                    }
                }
            },
            colors: colors,
            labels: ["Delivery"]
        },
            chart = new ApexCharts(document.querySelector("#total-revenue"), options);
        chart.render();
        colors = ["#1abc9c", "#4a81d4"];
        (dataColors = $("#sales-analytics").data("colors")) && (colors = dataColors.split(","));
        options = {
            series: [{
                name: "Revenue",
                type: "column",
                data: [@foreach($monthly_sale as $sale) {{$sale->amount}}, @endforeach]
            }, {
                name: "Sales",
                type: "line",
                data: [@foreach($monthly_sale as $sale) {{$sale->amount}}, @endforeach]
            }],
            chart: {
                height: 378,
                type: "line",
            },
            stroke: {
                width: [2, 3]
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%"
                }
            },
            colors: colors,
            dataLabels: {
                enabled: !0,
                enabledOnSeries: [1]
            },
            labels: [@foreach($monthly_sale as $sale) {{date('d', strtotime($sale->date))}} + '-' + {{date('m', strtotime($sale->date))}} + '-' + {{date('Y', strtotime($sale->date))}}, @endforeach],
            legend: {
                offsetY: 7
            },
            grid: {
                padding: {
                    bottom: 20
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "light",
                    type: "horizontal",
                    shadeIntensity: .25,
                    gradientToColors: void 0,
                    inverseColors: !0,
                    opacityFrom: .75,
                    opacityTo: .75,
                    stops: [0, 0, 0]
                }
            },
            yaxis: [{
                title: {
                    text: "Net Revenue"
                }
            }]
        };
        (chart = new ApexCharts(document.querySelector("#sales-analytics"), options)).render(), $("#dash-daterange").flatpickr({
            altInput: !0,
            mode: "range",
        });
    </script>
@endsection