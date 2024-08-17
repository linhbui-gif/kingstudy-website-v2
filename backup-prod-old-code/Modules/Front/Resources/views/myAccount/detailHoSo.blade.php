@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('content')
    <div class="ProfilePage">
        <div class="container">
            <div class="ProfilePage-wrapper flex flex-wrap flex-row-reverse">
                <div class="ProfilePage-wrapper-item">
                    <div class="Card ProfilePage-table-content">
                        <div class="Card-header text-center">THông tin của bạn</div>
                        <div class="Card-body" style="padding: 2rem;">
                            @php
                            if($profile){
                                $country = \Modules\Admin\Entities\Country::find($profile->country_id);
                                $level = \Modules\Admin\Entities\LevelCourse::find($profile->level);
                                $course = \Modules\Admin\Entities\Course::find($profile->course_id);
                            }else{
                                $country = "";
                                $level = "";
                                $course = "";
                            }
                            @endphp
                            <div class="TrackProfile-text">Tên của bạn: <strong>{{ @$profile->name }}</strong></div><br>
                            <div class="TrackProfile-text">Quốc gia du học: <strong>{{ @$country->name  }}</strong></div><br>
                            <div class="TrackProfile-text">Khóa học: <strong>{{ @$course->name  }}</strong></div><br>
                            <div class="TrackProfile-text">Số điện thoại: <strong>{{ @$profile->phone }}</strong></div><br>
                            <div class="TrackProfile-text">Bậc học: <strong>{{ @$level->name }}</strong></div><br>
                            <div class="TrackProfile-text">Email: <strong>{{ @$profile->email }}</strong></div><br>
                            <div class="TrackProfile-text">Ielts: <strong>{{ @$profile->english_skill }}</strong></div><br>
                            <div class="TrackProfile-text">Thời gian gửi: <strong>{{ @$profile->created_at->format('h:i - d/m/Y') }}</strong></div><br>
                            <div class="TrackProfile-text">Trạng thái: {!! \App\Helpers\General::renderStatus($profile->status) !!}</div>

                        </div>
                    </div>
                </div>
                <div class="ProfilePage-wrapper-item">
                    <div class="TrackProfileDetail">
                        <div class="Card">
                            <div class="Card-header text-center">THông tin hồ sơ</div>
                            <div class="Card-body" style="padding: 3.2rem 0">
                                <div class="SubmitFilePage-step-body-item">
                                    <div class="Collapse style-content active">
                                        <div class="Collapse-header">
                                            <h4 class="Collapse-title">Hồ sơ học thuật</h4>
                                        </div>
                                        <div class="Collapse-body">
                                            <div class="SubmitFilePage-upload-list flex flex-wrap">
                                                @if($profile)
                                                @php
                                                    $attachment_1 = json_decode($profile->attachment_1);
                                                @endphp
                                                @if($attachment_1 && is_array($attachment_1))
                                                    @foreach($attachment_1 as $item)
                                                        @php
                                                            $ext = pathinfo($item->url, PATHINFO_EXTENSION);
                                                            $src_icon = "/frontend/assets/icons/icon-pdf.svg";
                                                            if($ext == "docx"){
                                                                $src_icon = "/frontend/assets/icons/file-word-solid.png";
                                                            }
                                                        @endphp
                                                        <div class="SubmitFilePage-upload-list-item">
                                                    <div class="SubmitFilePage-upload-list-item-image"> <img src="{{ $src_icon }}" alt=""></div>
                                                    <div class="SubmitFilePage-upload-list-item-info">
                                                        <h5 class="SubmitFilePage-upload-list-item-title">{{ $item->name }}</h5>

                                                    </div>
                                                </div>
                                                    @endforeach
                                                @else
                                                    <p>Chưa có dữ liệu</p>
                                                @endif
                                                @else
                                                    <p>Chưa có dữ liệu</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Collapse style-content active">
                                        <div class="Collapse-header">
                                            <h4 class="Collapse-title">Hồ sơ cá nhân</h4>
                                        </div>
                                        <div class="Collapse-body">
                                            <div class="SubmitFilePage-upload-list flex flex-wrap">
                                                @if($profile)
                                                @php
                                                    $attachment_2 = json_decode($profile->attachment_2);
                                                @endphp
                                                @if($attachment_2 && is_array($attachment_2))
                                                    @foreach($attachment_2 as $item)
                                                        @php
                                                            $ext = pathinfo($item->url, PATHINFO_EXTENSION);
                                                            $src_icon = "/frontend/assets/icons/icon-pdf.svg";
                                                            if($ext == "docx"){
                                                                $src_icon = "/frontend/assets/icons/file-word-solid.png";
                                                            }
                                                        @endphp
                                                        <div class="SubmitFilePage-upload-list-item">
                                                            <div class="SubmitFilePage-upload-list-item-image"> <img src="{{ $src_icon }}" alt=""></div>
                                                            <div class="SubmitFilePage-upload-list-item-info">
                                                                <h5 class="SubmitFilePage-upload-list-item-title">{{ $item->name }}</h5>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                <p>Chưa có dữ liệu</p>
                                                @endif
                                                @else
                                                    <p>Chưa có dữ liệu</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Collapse style-content active">
                                        <div class="Collapse-header">
                                            <h4 class="Collapse-title">Hồ sơ tài chính</h4>
                                        </div>
                                        <div class="Collapse-body">
                                            <div class="SubmitFilePage-upload-list flex flex-wrap">
                                                @if($profile)
                                                @php
                                                    $attachment_3 = json_decode($profile->attachment_3);
                                                @endphp
                                                @if($attachment_3 && is_array($attachment_3))
                                                    @foreach($attachment_3 as $item)
                                                        @php
                                                            $ext = pathinfo($item->url, PATHINFO_EXTENSION);
                                                            $src_icon = "/frontend/assets/icons/icon-pdf.svg";
                                                            if($ext == "docx"){
                                                                $src_icon = "/frontend/assets/icons/file-word-solid.png";
                                                            }
                                                        @endphp
                                                        <div class="SubmitFilePage-upload-list-item">
                                                            <div class="SubmitFilePage-upload-list-item-image"> <img src="{{ $src_icon }}" alt=""></div>
                                                            <div class="SubmitFilePage-upload-list-item-info">
                                                                <h5 class="SubmitFilePage-upload-list-item-title">{{ $item->name }}</h5>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>Chưa có dữ liệu</p>
                                                @endif
                                                @else
                                                    <p>Chưa có dữ liệu</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
    <script src="/assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>
@stop
