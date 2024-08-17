@extends('front::layouts.master')
@php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
@endphp
@section('content')
<section class="Banner">
      <div class="Banner-wrapper"> 
        <div class="Banner-image" style="height: 26.4rem;"><img src="./assets/images/image-banner-school-list.png" alt=""></div>
        <div class="Banner-overlay"></div>
        <h1 class="Banner-text">Nộp hồ sơ</h1>
      </div>
    </section>
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
              @include('front::profile.personal')
              {{-- End --}}

              {{-- Family Infor --}}
              @include('front::profile.family')
              {{-- End --}}

              {{-- Academic Infor --}}
              @include('front::profile.academic')
              {{-- End --}}
              
              {{-- Job Infor --}}
              @include('front::profile.job')
              {{-- End --}}
             
             {{-- Travel history --}}
             @include('front::profile.travel-history')
             {{--  --}}
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('after_styles')
<link rel="stylesheet" href="{{ asset('/html/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@stop

@section('after_scripts')
<script src="{{ asset('/html/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@include('front::profile.function-script')
@include('front::profile.script')
    <script type="text/javascript">
          $(document).ready(function() {
             init_datepicker(".datepicker", "dd-mm-yyyy");
          })
      
    </script>
@endsection