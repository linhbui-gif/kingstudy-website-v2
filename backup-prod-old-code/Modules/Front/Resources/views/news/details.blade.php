@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => @$details['meta_title'],
        'meta_description' => @$details['meta_description'],
        'link' => route('details_news',['slug' => @$details->alias]),
        'thumbnail' =>  @$details->image_url . @$details->image_banner,
        //'thumbnail' =>  @$settings['og_image']['value'],
        'robots' => @$details->is_index
    ])
@stop
@section('content')
  <div class="NewPage">
{{--      <section class="Banner">--}}
{{--        <div class="Banner-wrapper">--}}
{{--          <div class="Banner-image" style="height: 50rem;"><img src="{{$details->image_url . $details->image_banner}}" alt="{{@$details->title}}"></div>--}}
{{--        </div>--}}
{{--      </section>--}}
      <div class="container">
          <div class="NewsPage-wrapper flex flex-wrap">
              <div class="NewsPage-wrapper-item">
                  <div class="Card">
                      <div class="Card-header">Tin tức và sự kiện</div>
                      <div class="Card-body" style="padding: 3.6rem 2rem;">
                          @if(isset($details))
                                      <div class="NewPage-detail">
                                          <img src="{{$details->image_url . $details->image_banner}}" alt="{{@$details->title}}">
                                        <div class="NewPage-detail-header mt-5">
                                          <h1 class="NewPage-detail-header-title">{{$details->title}}</h1>
                                          <div class="NewPage-detail-header-row flex justify-between items-center">
                                            <div class="NewPage-detail-socials flex flex-wrap">
                                              <a class="NewPage-detail-socials-item" href="https://www.facebook.com/sharer/sharer.php?u=https://kingstudy.vn&display=popup" target="_blank"><img src="{{asset('frontend/assets/icons/icon-facebook-yellow.svg')}}" alt="{{@$details->title}}"></a>
{{--                                              <a class="NewPage-detail-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-twitter-yellow.svg')}}" alt="{{@$details->title}}"></a>--}}
                                              <a class="NewPage-detail-socials-item" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://kingstudy.vn/post/777_.html" target="_blank"><img src="{{asset('frontend/assets/icons/icon-instagram-yellow.svg')}}" alt="{{@$details->title}}"></a>
                                              <a class="NewPage-detail-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-google-yellow.svg')}}" alt="{{@$details->title}}"></a>
                                            </div>
                                            <h6 class="NewPage-detail-header-date">Tin tức | {{date('d/m/Y',strtotime($details->created_at))}}</h6>
                                          </div>
                                        </div>
                                        <div class="NewPage-detail-content style-content">
                                            {!! $details->content !!}
                                        </div>
                                      </div>
                                      @endif
                      </div>
                  </div>
              </div>
              <div class="NewsPage-wrapper-item">
                  <div class="Card">
                      <div class="Card-header">Tin tức và sự kiện</div>
                      <div class="Card-body">
                          <div class="NewsPage-list-hightlight">
                              @if(isset($list_news))
                                  @foreach($list_news as $news)
                                      <div class="NewsPage-list-hightlight-item">
                                          <div class="NewBlock horizontal">
                                              <a class="NewBlock-image" href="{{route('details_news',['slug'=> $news['alias'] ])}}"><img src="{{$news['image_location']}}" alt="{{ $news['title'] }}"></a>
                                              <div class="NewBlock-info">
                                                  <a class="NewBlock-info-title" href="{{route('details_news',['slug'=> $news['alias'] ])}}">{{ $news['title'] }}</a>
                                              </div>
{{--                                              <div class="NewBlock-date flex justify-between">--}}
{{--                                                  <span>TIN TỨC</span><span>{{date('d/m/Y',strtotime($news['created_at']))}}</span></div>--}}
                                          </div>
                                      </div>
                                  @endforeach
                              @endif
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
{{--      <div class="container">--}}
{{--        <div class="NewPage-wrapper">--}}
{{--          <div class="NewPage-wrapper-item" style="max-width: 100%;">--}}
{{--            @if(isset($details))--}}
{{--            <div class="NewPage-detail">--}}
{{--              <div class="NewPage-detail-header">--}}
{{--                <h1 class="NewPage-detail-header-title">{{$details->title}}</h1>--}}
{{--                <div class="NewPage-detail-header-row flex justify-between items-center">--}}
{{--                  <div class="NewPage-detail-socials flex flex-wrap">--}}
{{--                    <a class="NewPage-detail-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-facebook-yellow.svg')}}" alt="{{@$details->title}}"></a>--}}
{{--                    <a class="NewPage-detail-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-twitter-yellow.svg')}}" alt="{{@$details->title}}"></a>--}}
{{--                    <a class="NewPage-detail-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-instagram-yellow.svg')}}" alt="{{@$details->title}}"></a>--}}
{{--                    <a class="NewPage-detail-socials-item" href="#"><img src="{{asset('frontend/assets/icons/icon-google-yellow.svg"')}}" alt="{{@$details->title}}"></a>--}}
{{--                  </div>--}}
{{--                  <h6 class="NewPage-detail-header-date">Tin tức | {{date('d/m/Y',strtotime($details->created_at))}}</h6>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="NewPage-detail-content style-content">--}}
{{--                  {!! $details->content !!}--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
    </div>
  @include("front::study-abroad.form")
@endsection

@section('after_styles')
@stop

@section('after_scripts')

@endsection
