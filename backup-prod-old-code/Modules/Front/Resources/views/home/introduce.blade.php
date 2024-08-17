@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => @$datas[26]['locale_vi']['title'],
        'meta_description' => @$datas['26']['locale_vi']['description'],
        'link' => route('introduce'),
        'thumbnail' =>  asset('frontend/assets/images/thumbnail.png'),
        //'thumbnail' =>  @$settings['og_image']['value'],
        'robots' => 1
    ])

@stop
@section('content')
    <section class="Banner">
      <div class="Banner-wrapper">
        <div class="Banner-image"><img src="{{asset('frontend/assets/images/image-about-1.png')}}" alt=""></div>
      </div>
    </section>
     <section class="About">
      <div class="container">
        <div class="About-wrapper flex flex-wrap items-end">
          <div class="About-wrapper-item">
            <div class="About-image"> <img src="{{ $datas[19]['image_url'] . $datas[19]['image_location'] }}" alt=""></div>
          </div>
          <div class="About-wrapper-item">
            <div class="About-title flex items-center justify-center wow animate__animated animate__fadeInUp">
              <h2>{{$datas[19]['locale_vi']['title']}}</h2>
            </div>
            <div class="About-description">
                {!! $datas[19]['locale_vi']['content'] !!}
            </div>
            <div class="About-btns flex flex-wrap">
              <div class="Button secondary js-open-modal small" data-modal-id="#ModalContactInformation">
                <button class="Button-control flex items-center justify-center" type="button">
                    <span class="Button-control-title">
                    {{$items[19][0]['locale_vi']['title']}}
                    </span>
                </button>
              </div>
              <div class="Button small" data-modal-id="">
                <a href="{{$items[19][1]['link']}}" class="Button-control flex items-center justify-center" type="button">
                    <span class="Button-control-title">
                    {{$items[19][1]['locale_vi']['title']}}
                    </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="CoreValues">
      <div class="container">
        <div class="CoreValues-wrapper">
          <div class="CoreValues-title wow animate__animated animate__fadeInUp">
            <h2>{{$datas[20]['locale_vi']['title'] ?? ''}}</h2>
          </div>
          <div class="CoreValues-carousel owl-carousel" id="CoreValues-carousel">
            @if(isset($items) && count($items[20]) > 0)
            @foreach($items[20] as $item)
            <div class="item">
              <div class="CoreValues-carousel-item">
                <div class="CoreValues-carousel-item-image"><img src="{{$item['image_url'].$item['image_location']}}" alt=""></div>
                <h3 class="CoreValues-carousel-item-title">{{ $item['locale_vi']['title']}}</h3>
                <p class="CoreValues-carousel-item-description">{{ $item['locale_vi']['description'] }}</p>
              </div>
            </div>
            @endforeach
            @endif

          </div>
        </div>
      </div>
    </section>
    <section class="Vision">
      <div class="Vision-bg"> <img src="{{ $datas[21]['image_url']. $datas[21]['image_location'] }}" alt=""></div>
      <div class="container">
        <div class="Vision-wrapper">
          <div class="Vision-title flex items-center justify-center">
            <h2>{{$datas[21]['locale_vi']['title'] ?? ''}}</h2>
          </div>
          <p class="Vision-description">{!! $datas[21]['locale_vi']['content'] ?? '' !!}</p>
          <div class="Vision-button flex justify-center">
            <div class="Button small" data-modal-id="">
              <a href="{{$items[21][0]['link'] ?? '#'}}" class="Button-control flex items-center justify-center" type="button">
                <span class="Button-control-title">{{$items[21][0]['locale_vi']['title'] ?? ''}}</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="HistoryGrowth">
      <div class="container">
        <div class="HistoryGrowth-wrapper">
          <h2 class="HistoryGrowth-title">{{$datas[22]['locale_vi']['title'] ?? ''}}</h2>
          <p class="HistoryGrowth-description"> {!! $datas[22]['locale_vi']['content'] ?? '' !!}</p>
          <div class="HistoryGrowth-timeline flex flex-wrap">
            <div class="HistoryGrowth-timeline-col">
              @if(isset($items) && count($items[22]) > 0)
              @foreach($items[22] as $item)
              <div class="HistoryGrowth-timeline-item wow animate__animated animate__fadeInUp">
                <h5 class="HistoryGrowth-timeline-item-year"> {{ $item['locale_vi']['title'] }} </h5>
                <div class="HistoryGrowth-description">{{ $item['locale_vi']['description'] }} </div>
              </div>
              @endforeach
              @endif
            </div>
            <div class="HistoryGrowth-timeline-col">
              <div class="HistoryGrowth-timeline-image"> <img src="{{ $datas[22]['image_url']. $datas[22]['image_location'] }}" alt=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="Rewards">
      <div class="container">
        <div class="Rewards-wrapper">
          <div class="Rewards-title wow animate__animated animate__fadeInUp">
            <h2>{{$datas[23]['locale_vi']['title'] ?? ''}}</h2>
          </div>
          <div class="Rewards-list flex flex-wrap">
            @if(isset($items) && count($items[23]) > 0)
            @foreach($items[23] as $item)
            <div class="Rewards-list-item">
              <div class="Rewards-list-item-icon"> <img src="{{ $item['image_url']. $item['image_location'] }}" alt=""></div>
              <h3 class="Rewards-list-item-title">{{ $item['locale_vi']['title']}} </h3>
              <div class="line"></div>
              <div class="Rewards-list-item-description">{{ $item['locale_vi']['description'] }}</div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </section>
    <section class="Customers dark">
        <div class="Customers-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="Customers-title wow animate__animated animate__fadeInUp">
                            <h2>{{$datas[24]['locale_vi']['title'] ?? ''}}</h2>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel" id="Customers-carousel">
                    @if(isset($items) && count($items[24]) > 0)
                        @foreach($items[24] as $item)
                            <div class="item">
                                <div class="Customers-carousel-item flex items-center">
                                    <div class="Customers-carousel-item-image"><img src="{{ $item['image_url'] . $item['image_location'] }}" alt="">
                                        <div class="Customers-carousel-item-text">
                                            <h5 class="Customers-carousel-item-info-title"> {{ $item['locale_vi']['title']}} </h5>
                                            <h6 class="Customers-carousel-item-info-subtitle">{{ $item['locale_vi']['subtitle']}}</h6>
                                        </div>
                                    </div>
                                    <div class="Customers-carousel-item-info">
                                        <div class="Customers-carousel-item-info-description">{!! $item['locale_vi']['description'] !!} </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <br><br>
    {{-- <section class="Banner">
      <div class="Banner-wrapper">
        <div class="Banner-image"><img src="./assets/images/image-banner-about.png" alt=""></div>
      </div>
    </section><br><br> --}}
    <section class="Advisory">
        <div class="container">
            <div class="Advisory-wrapper">
                <div class="Advisory-title wow animate__animated animate__fadeInUp">
                    <h2>{{$datas[25]['locale_vi']['title'] ?? ''}}</h2>
                </div>
                <div class="Advisory-list flex flex-wrap justify-center">
                    @if(isset($items) && count($items[25]) > 0)
                        @foreach($items[25] as $item)
                            <div class="Advisory-list-col">
                                <div class="Advisory-list-item">
                                    <div class="Advisory-list-item-avatar"> <img src="{{ $item['image_url'] . $item['image_location'] }}" alt=""></div>
                                    <h4 class="Advisory-list-item-title">{{ $item['locale_vi']['title']}}</h4>
                                    <p class="Advisory-list-item-description">{{ $item['locale_vi']['subtitle']}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>


    <section class="Banner">
        <div class="Banner-wrapper">
            <div class="Banner-image"><img src="{{asset('frontend/assets/images/image-about-2.png')}}" alt=""></div>
        </div>
    </section>
@endsection

@section('after_scripts')

@stop
