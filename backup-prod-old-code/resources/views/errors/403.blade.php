@extends('layouts.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="col-md-">
    <section class="content-header">
      <h1 class="text-center">
        <span class="text-capitalize">403</span>
      </h1>
    </section>

    <div class="container text-center alert alert-warning">
      <div class="content">
        <div class="quote">Bạn không có quyền với chức năng này. Vui lòng liên hệ với Admin để được hỗ trợ.</div>
        <div class="explanation">
          <br>
          <small>
              <?php
              $default_error_message = "Vui lòng chỉ chọn các chức năng có trên Menu.";
              ?>
            {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
          </small>
        </div>
      </div>
    </div>
  </div>
@endsection
