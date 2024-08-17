@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('content')
    <div class="SubmitFilePage">
        <div class="ModalSubmitFileSuccess Modal"  id="ModalSubmitFileSuccess">
            <div class="Modal-overlay"> </div>
            <div class="Modal-main" style="max-width: 62.8rem;">
                <div class="Modal-header">
                    THông báo</div>
                <div class="Modal-body">
                    <div class="style-content">
                        <p class="text-center">Hồ sơ của bạn đã được tiếp nhận.<br>Chúng tôi sẽ liên hệ với bạn khi hồ sơ được <br>xét duyệt thành công!<br></p>
                        <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                            <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                                <div class="Button secondary small" data-modal-id="">
                                    <a href="{{ route('theodoiHoSo') }}" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem hồ sơ</span>
                                    </a>
                                </div>
                            </div>
                            <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                                <div class="Button Modal-close small" data-modal-id="">
                                    <a href="{{ route('trang-chu') }}" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Đồng ý</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="Banner">
            <div class="Banner-wrapper">
                <div class="Banner-image" style="height: 26.4rem;"><img src="{{ asset('frontend/assets/images/image-banner-school-list.png') }}" alt=""></div>
                <div class="Banner-overlay"></div>
                <h1 class="Banner-text">Nộp hồ sơ</h1>
            </div>
        </section>
        <div class="container">
            <form class="SubmitFilePage-wrapper" action="{{ route('postNopHoSo') }}" method="POST" id="formPostProfile">
                <div class="SubmitFilePage-step-header flex items-center justify-between">
                    <div class="SubmitFilePage-step-header-item flex items-center justify-center">1</div>
                    <div class="SubmitFilePage-step-header-item flex items-center justify-center">2</div>
                    <div class="SubmitFilePage-step-header-item flex items-center justify-center">3</div>
                </div>
                <div class="SubmitFilePage-step-body">
                    <div class="SubmitFilePage-step-body-item">
                        <h3 class="SubmitFilePage-title">THông tin của bạn</h3>
                        <div class="SubmitFilePage-form">
                            <div class="SubmitFilePage-form-control flex flex-wrap">
                                @php
                                    $option_country = \Modules\Admin\Entities\Country::get_options();
                                    $profileLasted = \Modules\Admin\Entities\ProfileSubmited::where('user_id', $user->id)->orderBy('created_at','desc')->first();
                                @endphp
                                <div class="SubmitFilePage-form-item">
                                    <div class="Input small bordered">
                                        <input value="{{ @$profileLasted->name }}" name="full_name" id="full_name" class="Input-control" type="text" placeholder="Tên của bạn">
                                    </div>
                                </div>
                                <div class="SubmitFilePage-form-item">
                                    <div class="Select small bordered">
                                        {!! Form::select("country_id", ["" => "Quốc gia du học"] + $option_country, @$profileLasted->country_id, ['id' => 'country_id', 'class' => 'Select-control']) !!}
                                        <div class="Select-arrow"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="SubmitFilePage-form-item">
                                    <div class="Input small bordered">
                                        <input value="{{ @$profileLasted->phone }}" name="phone" id="phone" class="Input-control" type="text" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="SubmitFilePage-form-item">
                                    <div class="Select small bordered">
                                        @php
                                            $option_level = \Modules\Admin\Entities\LevelCourse::get_options();
                                        @endphp
                                        {!! Form::select("level_id", ["" => "Bậc học"] + $option_level, @$profileLasted->level, ['id' => 'level_id', 'class' => 'Select-control']) !!}
                                        <div class="Select-arrow"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="SubmitFilePage-form-item">
                                    <div class="Input small bordered">
                                        <input value="{{ @$profileLasted->email }}" name="email_user" id="email_user" class="Input-control" type="text" placeholder="Email">
                                    </div>
                                </div>
                                <div class="SubmitFilePage-form-item">
                                    <div class="Select small bordered">
                                        @php
                                            $option_english = [ "IELTS" => "IELTS","5" => "Dưới 5.5","6" => "5.5 đến 7.0", "7" => "Trên 7.0" ];
                                        @endphp
                                        {!! Form::select("english_skill", $option_english, @$profileLasted->english_skill, ['id' => 'english_skill', 'class' => 'Select-control']) !!}
                                        <div class="Select-arrow"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="SubmitFilePage-form-submit flex justify-center">
                                <div class="Button secondary small bordered" data-modal-id="">
                                    <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp theo</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="SubmitFilePage-step-body-item">
                        <h3 class="SubmitFilePage-title">{{ $object['locale_vi']['title'] }}</h3>
                        <div class="style-content">
                            {!! $object['locale_vi']['content'] !!}
                            <div class="SubmitFilePage-form-submit flex justify-center">
                                <div class="Button secondary small bordered" data-modal-id="">
                                    <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp theo</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="SubmitFilePage-step-body-item">
                        <div class="Collapse style-content active">
                            <div class="Collapse-header">
                                <h4 class="Collapse-title">Upload file hồ sơ học thuật</h4>
                            </div>
                            <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                            <div class="Collapse-body">
                                <div class="SubmitFilePage-upload-list flex flex-wrap">
                                    <div class="SubmitFilePage-upload-list-item upload flex flex-col items-center justify-center">
                                        <input id="attachment_1" data-location=".file_url" data-name=".file_name" data-object="attachment" type="file" onchange="uploadLoadFile(event, 'preview_file_1')"><img src="{{ asset('frontend/assets/icons/icon-upload.svg') }}" alt="">Upload file
                                    </div>
                                    <div id="preview_file_1" class="SubmitFilePage-upload-list flex flex-wrap">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="Collapse style-content active">
                            <div class="Collapse-header">
                                <h4 class="Collapse-title">Upload file hồ sơ cá nhân</h4>
                            </div>
                            <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                            <div class="Collapse-body">
                                <div class="SubmitFilePage-upload-list flex flex-wrap">
                                    <div class="SubmitFilePage-upload-list-item upload flex flex-col items-center justify-center">
                                        <input id="attachment_2" data-location=".file_url" data-name=".file_name" data-object="attachment" type="file" onchange="uploadLoadFile(event, 'preview_file_2')"><img src="{{ asset('frontend/assets/icons/icon-upload.svg') }}" alt="">Upload file
                                    </div>
                                    <div id="preview_file_2" class="SubmitFilePage-upload-list flex flex-wrap">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Collapse style-content active">
                            <div class="Collapse-header">
                                <h4 class="Collapse-title">Upload file hồ sơ tài chính</h4>
                            </div>
                            <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                            <div class="Collapse-body">
                                <div class="SubmitFilePage-upload-list flex flex-wrap">
                                    <div class="SubmitFilePage-upload-list-item upload flex flex-col items-center justify-center">
                                        <input id="attachment_3" data-location=".file_url" data-name=".file_name" data-object="attachment" type="file" onchange="uploadLoadFile(event, 'preview_file_3')"><img src="{{ asset('frontend/assets/icons/icon-upload.svg') }}" alt="">Upload file
                                    </div>
                                    <div id="preview_file_3" class="SubmitFilePage-upload-list flex flex-wrap">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="SubmitFilePage-form-submit flex justify-center">
                            <div class="Button secondary js-open-modal small bordered">
                                <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Hoàn thành</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="school_id" value="{{ @$_GET['id'] }}">
                <input type="hidden" name="course_id" value="{{ @$_GET['course_id'] }}">
            </form>
        </div>
    </div>

@endsection

@section('after_scripts')
    <script src="/assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>

    <script>
        var uploadLoadFile = function(event,obj) {
            var image = document.getElementById(obj);
            console.log(event.target.files[0]);
           // image.src = URL.createObjectURL(event.target.files[0]);
            var nameFile = event.target.files[0]['name'];
            var type = nameFile.split('.').pop();
            var srcIcon = "/frontend/assets/icons/icon-pdf.svg";
            if(type == "docx"){
                srcIcon = "/frontend/assets/icons/file-word-solid.png";
            }
            var htmlFile = `<div class="SubmitFilePage-upload-list-item">
                                            <div class="SubmitFilePage-upload-list-item-image"> <img src="`+srcIcon+`" alt=""></div>
                                            <div class="SubmitFilePage-upload-list-item-info">
                                                <h5 class="SubmitFilePage-upload-list-item-title">`+nameFile+`</h5>
                                                <div onclick="deleteItem(this)" class="SubmitFilePage-upload-list-item-delete flex items-center">
                                                    <div class="SubmitFilePage-upload-list-item-delete-icon"> <img src="{{ asset('frontend/assets/icons/icon-delete.svg') }}" alt=""></div>Xóa
                                                    <input name="`+obj+`_file_url[]" class="file_url" type="hidden">
                                                    <input name="`+obj+`_file_name[]" class="file_name" type="hidden" value="`+nameFile+`">
                                                </div>
                                            </div>
                                        </div>`;

            $("#" + obj).append(htmlFile);
        };

        function deleteItem(t){
            $(t).parents(".SubmitFilePage-upload-list-item").remove();
        }
        var initUpload = function(obj) {
            var image_location = $(obj).data('location');
            var object = $(obj).data('object');
            var name = $(obj).data('name');
            console.log(image_location);
            console.log(object);
            console.log(name);
            if($(obj).data('url')){
                var url = $(obj).data('url');
            }else{
                var url = '/upload-temp-all-file';
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
                    });
                },
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
        }

        initUpload("#attachment_1");
        initUpload("#attachment_2");
        initUpload("#attachment_3");

        $('#formPostProfile').validate({
            ignore: ".ignore",
            submitHandler: function (form) {
                // do other things for a valid form
                var data = $(form).serializeArray();
                var url = $(form).attr('action');
                request_ajax(url, data, "POST", function (res) {
                    if(res.rs == 1){
                        openModalSuccess();
                    }

                });
                return false;
            }
        });

        function openModalSuccess(){
            $("#ModalSubmitFileSuccess").addClass("active");
        }
    </script>
@stop
