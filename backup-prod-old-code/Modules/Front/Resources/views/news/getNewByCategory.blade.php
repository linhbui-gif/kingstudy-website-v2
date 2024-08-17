@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => 'Tin Tức',
        'meta_description' => 'Tin tức du học',
        'link' => route('news'),
        'thumbnail' =>  @$settings['og_image']['value'],
        'robots' => 1
    ])
@stop
@section('content')
    <div class="NewsPage ">
        <section class="Banner">
            <div class="Banner-wrapper">
                <div class="Banner-image" style="height: 26.4rem;"><img src="{{ @$datas[33]['image_url'] . @$datas[33]['image_location'] }}" alt=""></div>
                <div class="Banner-overlay"></div>
                <h1 class="Banner-text">{{$categoryName->name}}</h1>
            </div>
        </section>
        <div class="container">
            <div class="NewsPage-wrapper flex flex-wrap">
                <div class="NewsPage-wrapper-item">
                    <div class="Card">
                        <div class="Card-header">{{$categoryName->name}}</div>
                        <div class="Card-body" style="padding: 3.6rem 2rem;">
                            <div class="NewsPage-list flex flex-wrap">
                                @if(isset($listNewByCategory) && count($listNewByCategory) > 0)
                                    @foreach($listNewByCategory as $news)
                                        <div class="NewsPage-list-item">
                                            <div class="NewBlock vertical">
                                                <a class="NewBlock-image" href="{{route('details_news',['slug'=> $news['alias'] ])}}">
                                                    <img src="{{$news['image_location']}}" alt="{{$news['title']}}">
                                                </a>
                                                <div class="NewBlock-info">
                                                    <a class="NewBlock-info-title" href="{{route('details_news',['slug'=> $news['alias'] ])}}">{{$news['title']}}</a>
                                                    <p class="NewBlock-info-description">{{ Str::words($news['description'],30) }}</p>
                                                    <div class="NewBlock-socials flex flex-wrap">
                                                        <a class="NewBlock-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-facebook-yellow.svg')}}" alt="{{$news['title']}}"></a>
                                                        <a class="NewBlock-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-twitter-yellow.svg')}}" alt="{{$news['title']}}"></a>
                                                        <a class="NewBlock-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-instagram-yellow.svg')}}" alt="{{$news['title']}}"></a>
                                                        <a class="NewBlock-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-google-yellow.svg')}}" alt="{{$news['title']}}"></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
{{--                            @include('front::includes.paginator',['objects' => $listNewByCategory ])--}}
                        </div>
                    </div>
                </div>
                <div class="NewsPage-wrapper-item">
                    <div class="Card">
                        <div class="Card-header">Bài viết mới nhất</div>
                        <div class="Card-body">
                            <div class="NewsPage-list-hightlight">
                                @if(isset($listNewByCategory) && count($listNewByCategory) > 0)
                                    @foreach($listNewByCategory as $news)
                                        <div class="NewsPage-list-hightlight-item">
                                            <div class="NewBlock horizontal">
                                                <a class="NewBlock-image" href="{{route('details_news',['slug'=> $news['alias'] ])}}"><img src="{{$news['image_location']}}" alt="{{ $news['title'] }}"></a>
                                                <div class="NewBlock-info">
                                                    <a class="NewBlock-info-title" href="{{route('details_news',['slug'=> $news['alias'] ])}}">{{ $news['title'] }}</a>
                                                </div>
                                                <div class="NewBlock-date flex justify-between">
                                                    <span>TIN TỨC</span><span>{{date('d/m/Y',strtotime($news['created_at']))}}</span></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="NewsPage-list-hightlight-btn">
                                <div class="Button secondary small" data-modal-id="">
                                    <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem thêm</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_styles')
@stop

@section('after_scripts')

@endsection
