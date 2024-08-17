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
                    <div class="ProfileManagement">
                        <div class="Card">
                            @php
                                if($profile){
                                    $country = \Modules\Admin\Entities\Country::find($profile->country_id);
                                    $level = \Modules\Admin\Entities\LevelCourse::find($profile->level);
                                    $englishSkill = @$profile->english_skill;
                                }else{
                                    $country = "";
                                    $level = "";
                                }
                            @endphp
                            <div class="Card-header">THông tin của bạn</div>
                            <div class="Card-body">
                                <div class="ProfileManagement-info flex flex-wrap">
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">Tên của bạn: <strong>{{ @$profile->name }}</strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">Số điện thoại: <strong>{{ @$profile->phone }}</strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">Quốc gia du học: <strong>{{ @$country->name }}</strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">Email: <strong>{{ @$profile->email }}</strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">Bậc học: <strong>{{ @$level->name }}</strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">IELTS: <strong>
                                                @if(isset($englishSkill))
                                                @if($englishSkill == "5")
                                                    Dưới 5.5
                                                @elseif($englishSkill == "6")
                                                    5.5 đến 7.0
                                                @else
                                                    Trên 7.0
                                                @endif
                                                @endif
                                            </strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item">
                                        <div class="ProfilePage-label">Thời gian gửi: <strong>
                                                @if($profile)
                                                    {{ $profile->created_at->format('h:i - d/m/Y')  }}
                                                    @endif
                                            </strong></div>
                                    </div>
                                    <div class="ProfileManagement-info-item"><a class="flex items-center justify-end" href="{{ route('formNopHoSo') }}"><span><strong>Chỉnh sửa</strong></span><img src="./assets/icons/icon-arrow-right-orange.svg" alt=""></a></div>
                                </div>
                            </div>
                        </div><br>
                        <div class="Card">
                            <div class="Card-header">THông tin hồ sơ</div>
                            <div class="Card-body">
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
                                                <p>Chưa có thông tin</p>
                                                @endif
                                                @else
                                                    <p>Chưa có thông tin</p>
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
                                                    <p>Chưa có thông tin</p>
                                                @endif
                                                @else
                                                    <p>Chưa có thông tin</p>
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
                                                    <p>Chưa có thông tin</p>
                                                @endif
                                                @else
                                                    <p>Chưa có thông tin</p>
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
