@extends('backEnd.layouts.master')
@section('title', 'SMTP Mail Configuration')

@section('css')
<style>
  .increment_btn,
  .remove_btn {
    margin-top: -17px;
    margin-bottom: 10px;
  }
</style>
<link href="{{ asset('public/backEnd/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/backEnd/assets/libs/summernote/summernote-lite.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">SMTP Mail Configuration</h4>
            </div>
        </div>
    </div>

    <!-- SMTP Configuration Form -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-body">
                <form method="POST" action="{{ route('smtp.update') }}">
                    @csrf

                    <div class="form-group">
                        <label for="MAIL_MAILER">MAIL MAILER</label>
                        <input type="text" name="MAIL_MAILER" class="form-control" value="{{ $smtp['MAIL_MAILER'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_HOST">MAIL HOST</label>
                        <input type="text" name="MAIL_HOST" class="form-control" value="{{ $smtp['MAIL_HOST'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_PORT">MAIL PORT</label>
                        <input type="text" name="MAIL_PORT" class="form-control" value="{{ $smtp['MAIL_PORT'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_USERNAME">MAIL USERNAME</label>
                        <input type="text" name="MAIL_USERNAME" class="form-control" value="{{ $smtp['MAIL_USERNAME'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_PASSWORD">MAIL PASSWORD</label>
                        <input type="text" name="MAIL_PASSWORD" class="form-control" value="{{ $smtp['MAIL_PASSWORD'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_ENCRYPTION">MAIL ENCRYPTION</label>
                        <input type="text" name="MAIL_ENCRYPTION" class="form-control" value="{{ $smtp['MAIL_ENCRYPTION'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_FROM_ADDRESS">MAIL FROM ADDRESS</label>
                        <input type="email" name="MAIL_FROM_ADDRESS" class="form-control" value="{{ $smtp['MAIL_FROM_ADDRESS'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="MAIL_FROM_NAME">MAIL FROM NAME</label>
                        <input type="text" name="MAIL_FROM_NAME" class="form-control" value="{{ $smtp['MAIL_FROM_NAME'] }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Configuration</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('public/backEnd/assets/libs/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('public/backEnd/assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('public/backEnd/assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/backEnd/assets/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/backEnd/assets/libs/summernote/summernote-lite.min.js') }}"></script>

<script>
  $(".summernote").summernote({
    placeholder: "Enter Your Text Here",
  });

  $(document).ready(function () {
    $(".btn-increment").click(function () {
      var html = $(".clone").html();
      $(".increment").after(html);
    });

    $("body").on("click", ".btn-danger", function () {
      $(this).parents(".control-group").remove();
    });

    $(".increment_btn").click(function () {
      var html = $(".clone_price").html();
      $(".increment_price").after(html);
    });

    $("body").on("click", ".remove_btn", function () {
      $(this).parents(".increment_control").remove();
    });

    $(".select2").select2();
  });
</script>
@endsection
