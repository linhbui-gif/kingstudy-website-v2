<!DOCTYPE html>
<html lang="en">
<?php
$ver_js = \App\Helpers\General::get_version_js();
$ver_css = \App\Helpers\General::get_version_css();
$ac = \App\Helpers\General::get_controller_action();
$settings = \App\Helpers\General::get_settings();
?>

    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WKLV84D');</script>
        <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/frontend/assets/css/main.css')}}">
        <link rel="icon" type="image/png" href="{{ $settings['favicon_ico']['value'] }}">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('/frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/assets/css/jquery.fancybox.min.css')}}" >
    <link rel="stylesheet" href="{{asset('/frontend/assets/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/assets/css/custome.css')}}">
    @yield('after_styles')
    </head>
    <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKLV84D"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <style>
        .Navigation{
            height: 70px;
        }

        @media (max-width: 992px) {
            .Navigation{
                height: auto;
            }
        }
        .FilterInformation-title {
            margin-bottom: 1rem;
        }
        .CoreValues-carousel-item {
            border: unset;
            box-shadow: 0 0.4rem 2rem rgba(0,0,0,.1);
        }
        .SchoolBlock-title {
            height: 54px;
        }
        .Partners-title h2 {
            margin-bottom: 3rem;
        }
        .Partners-list-item img {
            transform: scale(1);
            transition: .3s;
        }
        .Partners-list-item:hover img {
            transform: scale(1.1);
        }
        .Header-actions-item-icon{
            position: relative;
        }
        .Header-actions-item-number{
            position: absolute;
            top: -24%;
            right: -16%;
            width: 2rem;
            height: 2rem;
            background: linear-gradient(180deg, #d41f30 0, #80141f 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        #Feedback-carousel .owl-dots{
            display: none;
        }
        .modal{
            display: block;
        }
        #hocphi{
            margin-top: 40px;
        }
        .NewBlock.vertical .NewBlock-info-title {
            white-space: normal;
            word-break: break-word;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            display: -moz-box;
            display: box;
            -webkit-line-clamp: 2;
            -moz-line-clamp: 2;
            -line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        @media (min-width: 992px) and (max-width: 1441px) {
            .NewBlock.vertical .NewBlock-info-title{
                height: 48px;
            }

        }
        .NewBlock.vertical .NewBlock-info-description{
            line-height: 1.5;
            font-size: 1.6rem;
            color: #777;
            white-space: normal;
            word-break: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            display: -moz-box;
            display: box;
            -webkit-line-clamp: 2;
            -moz-line-clamp: 2;
            -line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .Collapse-body{
            font-size: 15px;
            font-family: Gotham, sans-serif;
        }
        .Collapse-body .SchoolDetailPage-courses-detail{
            margin-top: 10px;
        }
        .NewPage-detail-header-title{
            background: linear-gradient(180deg,#1d2d47 0,#1e397e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
        @include('front::includes.header')
        @yield('content')
{{-- Script --}}
<script src="{{ asset('/frontend/assets/js/jquery-3.3.1.slim.min.js') }}" ></script>
<script src="{{ asset('/frontend/assets/js/popper.min.js') }}"></script>
        {{-- Jquery --}}
        <script src="{{ asset('/frontend/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/frontend/assets/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('/frontend/assets/js/wow.min.js') }}" ></script>
<script src="{{ asset('/frontend/assets/js/jquery.fancybox.min.js') }}"></script>

<!--Carousel-->
<script src="{{ asset('/frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/custome.js') }}"></script>
    @include('front::includes.footer')

        @if(\Request::route()->getName() != "listCompare")
       <div id="compare_item">
        @if(Session::has('compare_list'))
            @php
                $compares = Session::get('compare_list');
            @endphp
            @if($compares)
                <div class="Compare-school show">
                    <div class="container">
                        <div class="Compare-school-wrapper flex items-center justify-between flex-wrap">
                            <div class="Compare-school-wrapper-name">University Comparison</div>
                            <ul class="Compare-school-wrapper-logo flex items-center">
                                @foreach($compares as $id)
                                    @php
                                        $school = \Modules\Admin\Entities\School::find($id);
                                    @endphp
                                    <li class="Compare-school-wrapper-logo-item" >
                                        <div class="Compare-school-wrapper-logo-item-remove" onclick="removeItem(this)" data-id="{{ $id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <g fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path fill="currentColor" fill-rule="nonzero" d="M12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 Z M17,13 L7,13 L7,11 L17,11 L17,13 Z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="Compare-school-wrapper-logo-item-images"><img src="{{ $school->logo }}"></div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="Compare-school-wrapper-button">
                                <div class="Button middle bordered" data-modal-id="">
                                    <a  href="/so-sanh-truong" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">So sánh</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
            @endif
    </body>
    @yield('after_scripts')
</html>
@include('front::includes.script')
