@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
<style>
    .btn-remove {
        font-size: 1.6rem;
        padding: 0.4rem 1.2rem;
        border-radius: 1.6rem;
        color: #fff;
        background: linear-gradient(180deg, #d41f30 0, #80141f 100%);
    }

</style>
@section('content')
    <div class="ProfilePage">
        <div class="container">
            <div class="ProfilePage-wrapper flex flex-wrap">
                <div class="ProfilePage-wrapper-item">
                   @include("front::myAccount.sidebar")
                </div>
                <div class="ProfilePage-wrapper-item">
                    <div class="SchoolFavoriteList">
                        <div class="Card">
                            <div class="Card-header text-center">Danh sách trường</div>
                            <div class="Card-body">
                                <div class="SchoolFavoriteList-list flex flex-wrap">
                                    @if($items && count($items) > 0)
                                    @foreach($items as $item)
                                            @if(isset($item))
                                        <div class="SchoolFavoriteList-list-item">
                                        <div class="SchoolBlock @if($item->type_school == 3) {{'odd'}} @elseif($item->type_school == 2) {{'even'}} @else {{'custom_red'}} @endif ">
                                            <div class="SchoolBlock-image"> <a href="{{ route('details_school', ['slug' => $item->slug]) }}"> <img src="{{ asset($item->logo) }}" alt=""></a></div>
                                            <div class="line"></div>
                                            <div class="SchoolBlock-info"><a class="SchoolBlock-title" href="{{ route('details_school', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                                <p class="SchoolBlock-description">{{ $item->heading }}</p>
                                                <div class="SchoolBlock-row flex justify-between items-center">
                                                    <div class="SchoolBlock-country flex items-center">
                                                        <div class="SchoolBlock-country-flag"> <img src="{{@$item['country']['icon']}}" alt=""></div>{{@$item['country']['name']}}
                                                    </div>
                                                    <div class="SchoolBlock-tag">@if($item->type_school == 3) {{'Available'}} @elseif($item->type_school == 2) {{'Partner'}} @else {{'Close'}} @endif</div>
                                                    <a href="{{ route('removeWishlist', [ 'id' => $item->id ]) }}" class="btn-remove">Xóa</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="not-result">
                                            <img src="https://ebook-demo.netlify.app/static/media/image-empty.2b0b05a6.png" style="margin:auto" alt="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after_scripts')

@stop
