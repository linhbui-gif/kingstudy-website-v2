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
                    <div class="EditProfile">
                        <div class="Card">
                            <div class="Card-header text-center">Thông tin cá nhân</div>
                            <div class="Card-body">
                                <form id="EditProfile-form" class="EditProfile-form" action="{{ route("postProfile") }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="EditProfile-form-avatar">
                                        <div class="Avatar">
                                            <input id="fileupload" type="file" name="files[]" onchange="uploadLoadFile(event, 'preview-profile')" data-object="user" data-location="#image_location">
                                            <img id="preview-profile" onerror="this.src='/frontend/assets/images/user.png';" src="{{ $user->image_url }}" alt="">
                                            <div class="Avatar-icon"> <img src="{{ asset('frontend/assets/icons/icon-camera.svg') }}" alt=""></div>
                                            <input type="hidden" name="image_location" id="image_location">
                                        </div>
                                    </div>
                                    <div class="EditProfile-form-control flex flex-wrap">
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label">Tên của bạn:</div>
                                            <div class="Input small bordered">
                                                <input id="profile_full_name" name="profile_full_name" value="{{ $user->full_name }}" class="Input-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label">Ngày tháng năm sinh:</div>
                                            <div class="Input small bordered">
                                                <input id="profile_birthday" name="profile_birthday" value="{{ !empty($user->birthday) ? $user->birthday->format("Y-m-d") : "" }}" class="Input-control" type="date" placeholder="">
                                                <div class="Input-date-icon"> <img src="{{ asset('frontend/assets/icons/icon-calendar.svg') }}" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label">Email: </div>
                                            <div class="Input small bordered">
                                                <input id="profile_email" name="profile_email" disabled value="{{ $user->email }}" class="Input-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label">Giới tính: </div>
                                            <div class="RadioGroup bordered">
                                                <div class="RadioGroup-wrapper flex items-center flex-wrap">
                                                    <div class="Radio middle flex items-start">
                                                        <input @if($user->gender == "male") checked @endif type="radio" name="profile_gender" value="male">
                                                        <div class="Radio-control"> </div>
                                                        <div class="Radio-label">Nam</div>
                                                    </div>
                                                    <div class="Radio middle flex items-start">
                                                        <input @if($user->gender == "female") checked @endif type="radio" name="profile_gender" value="female">
                                                        <div class="Radio-control"> </div>
                                                        <div class="Radio-label">Nữ</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label">Số điện thoại: </div>
                                            <div class="Input small bordered">
                                                <input id="profile_phone" name="profile_phone" value="{{ $user->phone }}" class="Input-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label">Địa chỉ:</div>
                                            <div class="Input small bordered">
                                                <input id="profile_address" name="profile_address" value="{{ $user->address }}" class="Input-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="EditProfile-form-item flex items-center"></div>
                                        <div class="EditProfile-form-item flex items-center">
                                            <div class="ProfilePage-label"></div>
                                            <div class="Button small" data-modal-id="">
                                                <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Lưu lại</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><br>
                        <div class="Card">
                            <div class="Card-header">thông tin du học</div>
                            <div class="Card-body">
                                <div class="flex items-center justify-between" style="padding: 2rem;">
                                    <div class="ProfilePage-label">Trạng thái:
                                        <span>{{$user->status_profile_aborad == 1 ? 'Đã cập nhật' : 'Chưa cập nhật'}}</span>
                                    </div>
                                        <a class="ProfilePage-label flex items-center" href="{{route('study_abroad_information.post')}}"><span><strong>Cập nhật ngay</strong></span><img src="./assets/icons/icon-arrow-right-orange.svg" alt=""></a>
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
    <script>
        $('#EditProfile-form').validate({
            ignore: ".ignore",
            rules: {
                profile_full_name: "required",
                profile_email: "required",
                profile_phone: "required",
            },
            messages: {
                profile_full_name: "Tên không được rỗng",
                profile_email: "Email không được rỗng",
                profile_phone: "Điện thoại không được rỗng",
            },
            submitHandler: function (form) {
                // do other things for a valid form
                var data = $(form).serializeArray();
                var url = $(form).attr('action');
                request_ajax(url, data, "POST", function (res) {
                    if (res.rs == 1) {
                        location.reload();
                    }else {
                        location.reload();
                    }
                });
                return false;
            }
        });

        var uploadLoadFile = function(event,obj) {
            var image = document.getElementById(obj);
            if(!image.src){
                image.innerText = event.target.files[0].name;
            }else{
                image.src = URL.createObjectURL(event.target.files[0]);
            }
        };

        var initUpload = function(obj){
            var image_location 	= $(obj).data('location');
            console.log(image_location);
            var is_change 		= $(obj).data('is-change');
            var object 			= $(obj).data('object');
            if($(obj).data('url')){
                var url = $(obj).data('url');
            }else{
                var url = '/upload-temp';
            }
            if(object){
                url += '?object='+object;
            }

            $(obj).fileupload({
                url: url,
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $(image_location).val(file.name);
                        if($(is_change).length > 0){
                            $(is_change).val(1);
                        }
                    });
                },
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
        }
        initUpload("#fileupload");
    </script>

@stop
