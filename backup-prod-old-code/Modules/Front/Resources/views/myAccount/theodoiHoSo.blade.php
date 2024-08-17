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
                    <div class="TrackProfile">
                        <div class="Card">
                            <div class="Card-header text-center">Danh sách Hồ sơ</div>
                            <div class="Card-body">
                                @if(!empty($data))
                                @foreach($data as $id => $item)
                                    @php
                                        $school = \Modules\Admin\Entities\School::find($id);
                                    @endphp
                                @if(isset($school))
                                <div class="TrackProfile-item-wrapper Collapse">
                                    <div class="Collapse-header">
                                        <div class="TrackProfile-header flex items-center justify-between @if($school->type_school == 3) {{'odd'}} @elseif($school->type_school == 2) {{'even'}} @else {{'custom_red'}} @endif" style="width: 100%;">
                                            <div class="TrackProfile-header-logo"> <img src="{{ asset($school->logo) }}" alt=""></div>
                                            <div class="TrackProfile-header-info">
                                                <h1 class="TrackProfile-header-info-title flex items-center">
                                                   {{ $school->name }}<span class="SchoolBlock-tag">@if($school->type_school == 3) {{'Available'}} @elseif($school->type_school == 2) {{'Partner'}} @else {{'Close'}} @endif</span></h1>
                                                <p class="TrackProfile-header-info-description">{{ $school->heading }}</p>
                                            </div>
                                            <div class="TrackProfile-text flex items-center justify-end arrow"><img src="{{ asset('frontend/assets/icons/icon-angle-down-orange.svg') }}" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="Collapse-body">
                                        <div class="TrackProfile-body">
                                            @foreach($item as $i)
                                                @php
                                                    $country = \Modules\Admin\Entities\Country::find($i->country_id);
                                                    $course = \Modules\Admin\Entities\Course::find($i->course_id);
                                                @endphp
                                            <div class="TrackProfile-item">
                                                <div class="TrackProfile-item-row flex flex-wrap justify-between">
                                                    <div class="TrackProfile-item-col">
                                                        <div class="TrackProfile-text">Tên của bạn: <strong>{{ $i->name }}</strong></div>
                                                    </div>
                                                    <div class="TrackProfile-item-col">
                                                        <div class="TrackProfile-text">Quốc gia du học: <strong>{{ @$country->name }}</strong></div>
                                                    </div>


                                                    <div class="TrackProfile-item-col">
                                                        <div class="TrackProfile-text">Khóa học: <strong>{{ @$course->name }}</strong></div>
                                                    </div>
                                                    <div class="TrackProfile-item-col">
                                                        <div class="TrackProfile-text">Thời gian gửi: <strong>{{ $i->created_at->format('h:i - d/m/Y') }}</strong></div>
                                                    </div>
                                                    <div class="TrackProfile-item-col">
                                                        <div class="TrackProfile-text">Trạng thái:
                                                            {!! \App\Helpers\General::renderStatus($i->status) !!}
                                                        </div>
                                                    </div>
                                                    <div class="TrackProfile-item-col"><a class="TrackProfile-text flex items-center justify-end arrow" href="{{ route('hosoDetail', ['id' => $i->id ]) }}">Xem chi tiết<img src="{{ asset('frontend/assets/icons/icon-arrow-right-orange.svg') }}" alt=""></a></div>
                                                </div>
                                            </div>
                                            @endforeach
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

@stop
