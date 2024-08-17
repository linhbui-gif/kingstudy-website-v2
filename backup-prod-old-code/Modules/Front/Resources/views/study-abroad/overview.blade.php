@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => $settings['site_title']['value'],
        'meta_description' => $settings['og_description']['value'],
        'link' => route('studyAbroad',['slug' => @$obj['overview_slug']]),
        'thumbnail' =>  $settings['og_image']['value'],
        'robots' => 1
    ])
@stop
@section('content')
  <section class="Banner">
        <div class="Banner-wrapper"> 
          <div class="Banner-image" style="height: 26.4rem;">
          <div class="Banner-overlay"></div>
          <h1 class="Banner-text">{{$obj['overview_title']}}</h1>
        </div>
  </section>
  <section id="overview_content" class="text-center">
      <div class="content-container" style="margin:0 auto;max-width: 1200px;">
         {!! $obj['overview_content'] !!}
      </div>
  </section>
@endsection

@section('after_styles')
  <style>
    .Banner-image{
      background-image: url({{ $obj['overview_img']}});
      background-position: 0 -474px;
      background-repeat: no-repeat;
      background-size: cover;
    }
    .Banner-overlay{
      background-color: rgba(0,0,0,.42);
      opacity: 1;
      transition: background 0.3s,border-radius 0.3s,opacity 0.3s;
    }
    .Banner-text{
      text-align:center;
    }
  </style>
@stop
@section('after_scripts')

@stop
