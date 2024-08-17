@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')
    @include("front::includes.meta", [
        'meta_title' => @$datas[28]['locale_vi']['title'],
        'meta_description' => @$datas[28]['locale_vi']['description'],
        'link' => route('contactPage'),
        'thumbnail' =>  asset('frontend/assets/images/thumbnail.png'),
        //'thumbnail' =>  @$settings['og_image']['value'],
        'robots' => 1
    ])

@stop
@section('content')
    <section class="ContactInformation">
      <div class="ContactInformation-info">
        <div class="container">
          <div class="ContactInformation-wrapper flex flex-wrap items-center">
            <div class="ContactInformation-wrapper-item">
              <div class="ContactInformation-image"><img src="{{ $datas[27]['image_url'] . $datas[27]['image_location'] }}" alt=""></div>
            </div>
            <div class="ContactInformation-wrapper-item">
              <h2 class="ContactInformation-title">{{$datas[27]['locale_vi']['title'] ?? ''}}</h2>
              <ul class="ContactInformation-list">
                <li class="ContactInformation-list-item flex items-start">
                  <span class="ContactInformation-list-item-icon">
                   <img src="{{asset('frontend/assets/icons/icon-phone.svg')}}" alt="">
                  </span>
                  <span class="ContactInformation-list-item-label">
                    Hotline: <a href="tel: {{$settings['hotline']['value']}}">{{$settings['hotline']['value']}}</a></span>
                </li>
                <li class="ContactInformation-list-item flex items-start">
                  <span class="ContactInformation-list-item-icon">
                    <img src="{{asset('frontend/assets/icons/icon-email.svg')}}" alt="">
                  </span>
                  <span class="ContactInformation-list-item-label">
                    Email: <a href="mailto: {{$settings['email_support']['value']}}">{{$settings['email_support']['value']}}</a></span>
                </li>
                <li class="ContactInformation-list-item flex items-start">
                  <span class="ContactInformation-list-item-icon">
                    <img src="{{asset('frontend/assets/icons/icon-map.svg')}}" alt="">
                  </span>
                  <span class="ContactInformation-list-item-label">
                    {{$settings['company_address_vi']['value']}}
                  </span>
                </li>
                <li class="ContactInformation-list-item flex items-start">
                  <span class="ContactInformation-list-item-icon">
                    <img src="{{asset('frontend/assets/icons/icon-facebook.svg')}}" alt="">
                  </span>
                  <span class="ContactInformation-list-item-label">
                    Facebook: <a href="{{$settings['link_fp_facebook']['value']}}">{{$settings['link_fp_facebook']['value']}}</a></span>
                  </li>
                <li class="ContactInformation-list-item flex items-start">
                  <span class="ContactInformation-list-item-icon">
                    <img src="{{asset('frontend/assets/icons/icon-zalo.svg')}}" alt="">
                  </span>
                  <span class="ContactInformation-list-item-label">
                    Zalo: <a href=": chat.zalo.me">chat.zalo.me</a></span>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
     <div class="ContactInformation-map">
         <iframe src="{{$datas[27]['link_more'] ?? ''}}"></iframe>
       </div>
    </section>
@endsection

@section('after_scripts')

@stop
