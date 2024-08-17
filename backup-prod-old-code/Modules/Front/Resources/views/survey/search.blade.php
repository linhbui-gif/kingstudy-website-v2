@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => @$settings['site_title']['value'],
        'meta_description' => 'Danh sách trường sau khảo sát',
        'link' => route('survey_school'),
        'thumbnail' =>  @$settings['og_image']['value'],
        'robots' => 1
    ])
@stop
@section('content')
   <div class="SchoolListPage">
      <section class="Banner">
        <div class="Banner-wrapper">
          <div class="Banner-image" style="height: 26.4rem;"><img src="{{asset("frontend/assets/images/image-banner-school-list.png")}}" alt=""></div>
          <div class="Banner-overlay"></div>
          <h1 class="Banner-text">Danh sách trường</h1>
        </div>
      </section>
      <div class="container">
        @if(isset($schools) && count($schools) > 0)
        <div class="SchoolListPage-wrapper" style="padding-top: 4rem;">
          <h6 class="SchoolListPage-search-text">{{count($schools)}} trường được tìm kiếm</h6>
          <div class="SchoolListPage-list flex flex-wrap">
            @foreach($schools as $school)
              <div class="SchoolListPage-list-item">
                <div class="SchoolBlock
                @if($school['type_school'] == 3) {{'odd'}} @elseif($school['type_school'] == 2) {{'even'}} @else {{'custom_red'}} @endif">
                  <div class="SchoolBlock-image">
                    <a href="{{route('details_school',['slug'=> $school['slug']] )}}">
                      <img src="{{$school['logo']}}" alt="">
                    </a>
                  </div>
                  <div class="line"></div>
                  <div class="SchoolBlock-info">
                    <a class="SchoolBlock-title" href="{{route('details_school',['slug'=> $school['slug']] )}}">{{$school['name']}}</a>
                    <p class="SchoolBlock-description">{!!$school['heading'] !!}</p>
                    <div class="SchoolBlock-row flex justify-between items-center">
                      <div class="SchoolBlock-country flex items-center">
                        <div class="SchoolBlock-country-flag"> <img src="{{asset('frontend/assets/images/image-flag.png')}}" alt=""></div>UK
                      </div>
                      <div class="SchoolBlock-tag">
                       @if($school['type_school'] == 3) {{'Available'}} @elseif($school['type_school'] == 2) {{'Partner'}} @else {{'Close'}} @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @else
         <h6 class="SchoolListPage-search-text">Chưa tìm được trường phù hợp</h6>
        @endif
      </div>
    </div>
@endsection

@section('after_styles')
  <style>
    .SchoolBlock.custom_red .SchoolBlock-tag {
      background: red;
    }
  </style>
@stop

@section('after_scripts')

@endsection
