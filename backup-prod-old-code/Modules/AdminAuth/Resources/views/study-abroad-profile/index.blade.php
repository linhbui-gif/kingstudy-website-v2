@extends('admin::layouts.master')
@php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
@endphp
@section('after_styles')
<link rel="stylesheet" href="{{asset('/frontend/assets/css/main.css')}}">
    <link rel="icon" type="image/png" href="./assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer">
@stop
@section('content')
    <div class="ProfilePage">
      <div class="container"> 
        <div class="ProfilePage-wrapper include-step">
          <div class="EditProfile">
            <form class="EditProfile-form" id="UpdateProfile_frm" action="{{route('study_abroad_information.post')}}" method="POST" style="padding: 0;">
              <div class="SubmitFilePage-step-header flex items-center justify-between">
                <div class="SubmitFilePage-step-header-item flex items-center justify-center">1</div>
                <div class="SubmitFilePage-step-header-item flex items-center justify-center">2</div>
                <div class="SubmitFilePage-step-header-item flex items-center justify-center">3</div>
                <div class="SubmitFilePage-step-header-item flex items-center justify-center">4</div>
                <div class="SubmitFilePage-step-header-item flex items-center justify-center">5</div>
              </div>
              {{-- Persanal Infor --}}
              @include('adminauth::study-abroad-profile.personal')
              {{-- End --}}

              {{-- Family Infor --}}
              @include('adminauth::study-abroad-profile.family')
              {{-- End --}}

              {{-- Academic Infor --}}
              @include('adminauth::study-abroad-profile.academic')
              {{-- End --}}
              
              {{-- Job Infor --}}
              @include('adminauth::study-abroad-profile.job')
              {{-- End --}}
             
             {{-- Travel history --}}
             @include('adminauth::study-abroad-profile.travel-history')
             {{--  --}}
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
<style type="text/css">
  .UpdateInfoSturyAbroad-step {
    display:block !important;
  }
  .items-start{
    margin-top:0 !important;
  }
  #UpdateProfile_frm input{
    pointer-events: none;
  }
</style>
@section('after_styles')
<link rel="stylesheet" href="{{ asset('/html/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@stop
@section('after_scripts')
  <script>
    $( "input" ).prop( "disabled", true );
  </script>
@endsection