@extends('backEnd.layouts.master')
@section('title', 'Incomplete Orders')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Incomplete Orders</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row order_page">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Customer Info</th>
                                        <th>Cart Content</th>
                                        <th>Order Summary</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($show_data as $key => $value)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <strong>{{$value->name}}</strong><br>
                                                {{$value->phone}}<br>
                                                @if($value->additional_phone)
                                                {{$value->additional_phone}}<br>
                                                @endif
                                                {{$value->address}}<br>
                                                Note: {{ $value->note ? $value->note : 'N/A' }} <br>
                                                {{$value->area}}<br>
                                                IP: {{$value->ip_address}}  
                                            </td>
                                            <td>
                                                @php
                                                    $cart = json_decode($value->cart_content, true);
                                                @endphp
                                                @if($cart)
                                                    @foreach($cart as $item)
                                                        <small>
                                                        {{$item['name']}} x {{$item['qty']}} - {{ $item['price'] }}<br>
                                                        </small>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                 @php
                                                    $summary = json_decode($value->order_summary, true);
                                                @endphp
                                                @if($summary)
                                                    Subtotal: {{$summary['subtotal'] ?? 0}}<br>
                                                    Shipping: {{$summary['shipping'] ?? 0}}<br>
                                                    Discount: {{$summary['discount'] ?? 0}}<br>
                                                    <strong>Total: {{$summary['total'] ?? 0}}</strong>
                                                @endif
                                            </td>
                                            <td>{{$value->updated_at}}</td>
                                            <td>
                                                 <form method="post" action="{{ route('admin.order.incomplete_destroy') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" value="{{ $value->id }}" name="id">
                                                    <button type="submit" class="btn btn-xs btn-danger delete-confirm"><i class="fe-trash-2"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="custom-paginate">
                            {{$show_data->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
