@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('content')
    <div class="ProfilePage">
        <div class="container">
            <div class="ProfilePage-wrapper flex flex-wrap">
                <div class="ProfilePage-wrapper-item">
                    @include("front::myAccount.sidebar")
                </div>
                <div class="ProfilePage-wrapper-item">
                    <div class="PrivacyPolicy">
                        <div class="Card">
                            <div class="Card-header text-center">{{ $object['locale_vi']['title'] }}</div>
                            <div class="Card-body" style="padding: 3.2rem;">
                                <div class="style-content">
                                   {!! $object['locale_vi']['content'] !!}
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
