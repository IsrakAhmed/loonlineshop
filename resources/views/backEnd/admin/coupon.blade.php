@extends('backEnd.layouts.master')
@section('title','Coupon Management')
@section('css')
<!-- Plugins css -->
<link href="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backEnd/')}}/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Coupon Management</h4>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#couponModal">
                    Create Coupon
                </button
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="card">
    
        <div class="card-body">
            <div id="successMessage" class="alert alert-success d-none"></div>
            <table class="table table-bordered mt-1">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Expired Date</th>
                        <th>Min Purchase</th>
                        <th>Max Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="couponTableBody">
                    <!-- Coupons will be loaded via AJAX here -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- Create/Edit Coupon Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Create Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="couponForm">
                        @csrf 
                        <input type="hidden" id="coupon_id" name="coupon_id" >
                        <div class="row gy-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="code">Coupon Code</label>
                                    <input type="text" name="code" id="code" class="form-control" required>
                                    <span id="codeError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" required>
                                    <span id="amountError" class="text-danger"></span>
                                </div>                        
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                    <span id="typeError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="expired_date">Expired Date</label>
                                    <input type="date" id="expired_date" name="expired_date" class="form-control" required>
                                    <span id="expiredDateError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="min_purchase">Minimum Purchase</label>
                                    <input type="number" name="min_purchase" id="min_purchase" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="max_value">Maximum Value</label>
                                    <input type="number" name="max_value" id="max_value" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary mt-3" id="saveCouponBtn">Save Coupon</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 


 
    
</div> <!-- container -->
@endsection
@section('script')
 <!-- Plugins js-->
        <script src="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="{{asset('public/backEnd/')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="{{asset('public/backEnd/')}}/assets/libs/selectize/js/standalone/selectize.min.js"></script>
         <script>
             $(document).ready(function () {
                loadCoupons();
            
                // Load coupons from the server
                function loadCoupons() {
                    $.ajax({
                        url: '/admin/coupons', // Adjust the URL according to your API endpoint
                        method: 'GET',
                        success: function (data) {
                            console.log(data);
                            let couponsHtml = '';
                            $.each(data, function (index, coupon) {
                                couponsHtml += `
                                    <tr>
                                        <td>${coupon.code}</td>
                                        <td>${coupon.amount}</td>
                                        <td>${coupon.type.charAt(0).toUpperCase() + coupon.type.slice(1)}</td>
                                        <td>${coupon.expired_date}</td>
                                        <td>${coupon.min_purchase || 'N/A'}</td>
                                        <td>${coupon.max_value || 'N/A'}</td>
                                        <td>
                                            <button class="btn btn-warning edit-button btn-sm" data-id="${coupon.id}">Edit</button>
                                            <button class="btn btn-danger delete-button btn-sm" data-id="${coupon.id}">Delete</button>
                                        </td>
                                    </tr>
                                `;
                            });
                            $('#couponTableBody').html(couponsHtml);
                        },
                        error: function () {
                            alert('Error loading coupons.');
                        }
                    });
                }
            
                // Create or update coupon
                $('#couponForm').on('submit', function (event) {
                    event.preventDefault();
            
                    let formData = $(this).serialize(); // Serialize form data
            
                    let url = $('#coupon_id').val() ? '/admin/coupons/' + $('#coupon_id').val() : '/admin/coupons'; // Adjust URL
                    let method = $('#coupon_id').val() ? 'PUT' : 'POST'; // Determine method
                    
                    console.log(url);
                    console.log(method);
                    console.log(formData);
                    console.log($('#coupon_id').val());
                    $.ajax({
                        url: url,
                        method: method,
                        data: formData,
                        success: function (response) {
                            console.log(response.message);
                            loadCoupons(); // Refresh coupon list
                            $('#successMessage').html(response.message).removeClass('d-none');
                            $('#couponModal').modal('hide'); // Close modal
                            $('#couponForm')[0].reset(); // Reset form
                            $('#coupon_id').val(''); // Clear hidden input
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function (key, value) {
                                errorMessages += value[0] + '<br>';
                            });
                            $('#errorMessage').html(errorMessages).removeClass('d-none');
                        }
                    });
                });
            
                // Edit coupon
                $(document).on('click', '.edit-button', function () {
                    let id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        url: '/admin/coupons/' + id,
                        method: 'GET',
                        success: function (coupon) {
                            $('#coupon_id').val(coupon.id);
                            $('#code').val(coupon.code);
                            $('#amount').val(coupon.amount);
                            $('#type').val(coupon.type);
                            $('#expired_date').val(coupon.expired_date);
                            $('#min_purchase').val(coupon.min_purchase);
                            $('#max_value').val(coupon.max_value);
                            $('#couponModal').modal('show'); // Show modal
                        },
                        error: function () {
                            alert('Error loading coupon data.');
                        }
                    });
                });
            
                // Delete coupon
                $(document).on('click', '.delete-button', function () {
                    let id = $(this).data('id');
            
                    if (confirm('Are you sure you want to delete this coupon?')) {
                        $.ajax({
                            url: '/admin/coupons/' + id,
                            method: 'DELETE',
                            data: {
                                _token: $('input[name="_token"]').val(), // CSRF token
                            },
                            success: function (response) {
                                loadCoupons(); // Refresh coupon list
                                $('#successMessage').html(response.message).removeClass('d-none');
                            },
                            error: function () {
                                $('#errorMessage').html('Error deleting coupon.').removeClass('d-none');
                            }
                        });
                    }
                });
            });

         </script>
@endsection