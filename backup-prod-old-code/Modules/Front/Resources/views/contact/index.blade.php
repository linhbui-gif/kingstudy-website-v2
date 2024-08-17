@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('content')
   <section class="ContactInformation">
      <div class="ContactInformation-info">
        <div class="container">
          <div class="ContactInformation-wrapper flex flex-wrap items-center">
            <div class="ContactInformation-wrapper-item">
              <div class="ContactInformation-image"><img src="{{asset('frontend/assets/images/image-about.png')}}" alt=""></div>
            </div>
            <div class="ContactInformation-wrapper-item">
              <h1 class="ContactInformation-title">Thông tin liên hệ</h1>
              <ul class="ContactInformation-list">
                <li class="ContactInformation-list-item flex items-start">
                  <span class="ContactInformation-list-item-icon">
                    <img src="{{asset('frontend/assets/icons/icon-phone.svg')}}" alt="">
                  </span><span class="ContactInformation-list-item-label">Hotline: <a href="tel: 0569999595">0569999595</a></span>
                </li>
                <li class="ContactInformation-list-item flex items-start"><span class="ContactInformation-list-item-icon">
                  <img src="{{asset('frontend/assets/icons/icon-email.svg')}}" alt="">
                  </span><span class="ContactInformation-list-item-label">Email: <a href="mailto: info@kingstudy.vn">info@kingstudy.vn</a></span>
                </li>
                <li class="ContactInformation-list-item flex items-start"><span class="ContactInformation-list-item-icon">
                   <img src="{{asset('frontend/assets/icons/icon-map.svg')}}" alt="">
                   </span><span class="ContactInformation-list-item-label">Văn phòng: số 7, ngách 1, ngõ 178 Thái Hà, phường Trung Liệt, quận Đống Đa, thành phố Hà Nội.</span>
                </li>
                <li class="ContactInformation-list-item flex items-start"><span class="ContactInformation-list-item-icon">
                  <img src="{{asset('frontend/assets/icons/icon-facebook.svg')}}" alt="">
                  </span><span class="ContactInformation-list-item-label">Facebook: <a href="facebook.com">facebook.com</a></span>
                </li>
                <li class="ContactInformation-list-item flex items-start"><span class="ContactInformation-list-item-icon">
                  <img src="{{asset('frontend/assets/icons/icon-zalo.svg')}}" alt="">
                  </span><span class="ContactInformation-list-item-label">Zalo: <a href="https://zalo.me/0569999595">chat.zalo.me</a></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="ContactInformation-map">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59587.94583828266!2d105.80185828327892!3d21.022816117812383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2zSMOgIE7hu5lpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1660146040429!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </section>
@endsection

@section('after_styles')
@stop

@section('after_scripts')

@endsection
