@extends('admin::layouts.master')

<?php
$action_name = isset($action) ? 'Thông tin của bạn' : (isset($id) ? 'Cập nhật' : 'Thêm mới');
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-header with-border">
                <h3 class="panel-title"><?=$action_name?> {{isset($action)?'':$title}}</h3>
            </div>
            <!-- /.panel-header -->
            <!-- form start -->
            <?php
            $link = isset($id) ? route($controllerName . '.update', ['id' => $id]) : route($controllerName . '.create');
            if (isset($action) && $action == 'profile') {
                $link = '';
            }
            ?>
            <form id="frm-add" method="post" action="<?=$link?>" class="form-horizontal">
                <div class="panel-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="username">
                                Tên đăng nhập <span class="required"></span></label>
                            <div class="col-sm-9">
                                {!! Form::text("username", @$object['username'],
                                    ["id" => "username", 'class' => 'form-control', 'placeholder' => "Nhập tên đăng nhập"]) !!}
                                <label id="username-error" class="error" for="username">{!! $errors->first("username") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="full_name">
                                Họ tên <span class="required"></span>
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text("full_name", @$object['full_name'], ['class' => 'form-control', 'placeholder' => "Nhập họ và tên"]) !!}
                                <label id="full_name-error" class="error"
                                       for="full_name">{!! $errors->first("full_name") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Email <span class="required"></span>
                            </label>
                            <div class="col-sm-9">
                                {!! Form::email("email", @$object['email'], ['class' => 'form-control']) !!}
                                <label id="email-error" class="error"
                                       for="email">{!! $errors->first("email") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-6 control-label" for="form-field-1">
                                        Giới tính
                                    </label>
                                    <div class="col-sm-6">
                                        {!! Form::select("gender", \App\Helpers\General::getOptionGender(), @$object['gender'], ['class' => 'form-control' , "id" => "gender"]) !!}
                                        <span class="help-block has-error">{!! $errors->first("gender") !!}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-5 control-label" for="form-field-1">
                                        Ngày sinh
                                    </label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            {!! Form::text("birthday", @$object['birthday'], ['class' => 'form-control' , "id" => "birthday", "autocomplete"=>"off"]) !!}
                                        </div>
                                    </div>
                                    <span class="help-block has-error">{!! $errors->first("birthday") !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Số điện thoại <span class="required"></span>
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text("phone", @$object['phone'], ['class' => 'form-control' , "id" => "phone"]) !!}
                                <label id="phone-error" class="error"
                                       for="phone">{!! $errors->first("phone") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="">Tỉnh/ Thành <span class="required"></span></label>
                            <div class="col-sm-9">
                                {!! Form::select("province_id", ['' => ''], @$object['province_id'],
                            ['class' => 'form-control select2 province change', 'data-id'=> @$object['province_id'],
                            "data-destination" => "#district_id",
                            "id" => "province_id", "data-placeholder"=>"Chọn Tỉnh/Thành phố"]) !!}
                                <label id="province_id-error" class="error"
                                       for="province_id">{!! $errors->first("province_id") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="">Quận/ Huyện </label>
                            <div class="col-sm-9">
                                {!! Form::select("district_id", ['' => ''], @$object['district_id'],
                            ['class' => 'form-control select2 district_change', 'data-id'=>@$object['district_id'],
                            "data-destination" => "#ward_id", "data-destination-street" => "#street_id",
                            "id" => "district_id", "data-placeholder"=>"Chọn Quận/Huyện"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="">Phường/Xã </label>
                            <div class="col-sm-9">
                                {!! Form::select("ward_id", ['' => ''], @$object['ward_id'],
                                ['class' => 'form-control select2', 'data-id'=>@$object['ward_id'], "id" => "ward_id", "data-placeholder"=>"Chọn Phường/Xã"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Địa chỉ
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text("address", @$object['address'], ['class' => 'form-control' , "id" => "address"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="form-field-1">Trạng thái: </label>
                            <div class="col-sm-9">

                                <label class="control" style="padding-right: 20px; margin: 7px">
                                    <input class="flat" type="radio" name="is_enabled"
                                           value="1" <?=@$object['is_enabled'] == 1 ? 'checked' : ''?>> Kích
                                    hoạt</label>
                                <label class="control">
                                    <input class="flat" type="radio" name="is_enabled"
                                           value="0" <?=@$object['is_enabled'] == 0 ? 'checked' : ''?>> Bỏ kích
                                    hoạt</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if(!isset($id))
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1">
                                    Mật khẩu <span class="required"></span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <label id="password-error" class="error"
                                           for="password">{!! $errors->first("password") !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1">
                                    Xác nhận mật khẩu <span class="required"></span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_confirm" id="password_confirm"
                                           class="form-control">
                                    <label id="password_confirm-error" class="error"
                                           for="password_confirm">{!! $errors->first("password_confirm") !!}</label>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="form-field-1"> <strong>Hình
                                    Avatar</strong>
                            </label>
                            <div class="col-sm-9 btn-file">
                                  <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                                      <i class="glyphicon glyphicon-plus"></i>
                                      <span>Chọn tập tin...</span>
                                      <!-- The file input field used as target for the file upload widget -->
                                      <input id="fileupload" type="file" name="files[]" onchange="loadFile(event)"
                                             accept="image/*">
                                  </span>
                                <div id="files" class="files" style="float: right;max-width: 450px;"></div>
                                <div style="clear: both;"></div>
                                <!-- The global progress bar -->
                                <div id="progress" class="progress" style="margin-top: 10px;">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <p><img id="output" width="200" onerror="this.src='/images/user.png';"
                                        src="{{ isset($id) ? url($object['image_url'].$object['image_location']):'/images/user.png' }}"/>
                                </p>
                                <input id="image_location" type="hidden" name="image_location"
                                       value="{{@$object['image_location']}}">
                                <input id="is_change_image" type="hidden" name="is_change_image" value="0">
                                <label id="image_location-error" class="error" for="image_location"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="col-sm-6">
                            <a href='{!! route($controllerName.'.index') !!}'
                               class="btn btn-success btn-rounded pull-left"><i class="fa fa-arrow-left"></i> Danh
                                sách {{ $title }}</a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-primary btn-rounded"><i class="fa fa-save"></i> Lưu lại</button>
                            <button type="reset" class="btn btn-default btn-rounded"><i class="fa fa-refresh"></i> Làm
                                lại
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.panel-footer -->
            </form>
        </div>
    </div>
@endsection

@section('before_styles')
    <link rel="stylesheet" href="/assets/plugins/jQuery-File-Upload/css/jquery.fileupload.css">
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
@endsection

@section('after_scripts')
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/assets/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <!-- iCheck -->
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>
    <link href="/html/plugins/switchery/switchery.min.css" rel="stylesheet">
    <script src="/html/plugins/switchery/switchery.min.js"></script>
    <script type="text/javascript">
        var loadFile = function (event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        $(document).ready(function () {
            init_select2('.select2');
            init_datepicker("#birthday", "dd-mm-yyyy");
            get_provinces('.province');

            $('.province.change').on('change', function () {
                get_districts_by_province($(this));
            });
            $('.district_change').on('change', function () {
                get_wards_by_district($(this));
            });

            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            var url = '<?=route('upload-temp')?>?object=user-avatar';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                done: function (e, data) {
                    if (data['result']['error']) {
                        $('#image_location-error').html(data['result']['error']);
                        $('#image_location').val("");
                        return false;
                    }
                    $('#avatar-error').html('');
                    $.each(data.result.files, function (index, file) {
                        $('#image_location').val(file.name);
                        $('#is_change_image').val(1);
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');

            $('#frm-add').validate({
                ignore: ".ignore",
                rules: {
                    username: "required",
                    full_name: "required",
                    province_id: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 11,
                    },

                    @if (!isset($id))
                    password: "required",
                    password_confirm: {
                        equalTo: "#password"
                    },
                    @endif
                },
                messages: {
                    username: "Nhập tên đăng nhập",
                    full_name: "Nhập tên {{ $title }}",
                    province_id: "Tỉnh/Thành không hợp lệ",
                    'email': {
                        required: 'Vui lòng nhập email',
                        email: 'Email không đúng định dạng'
                    },
                    'phone': {
                        required: 'Nhập số điện thoại',
                        minlength: "Số điện thoại tối thiểu 10 số",
                        maxlength: "Số điện thoại tối đa 11 số",
                    },
                    password: "Nhập mật khẩu",
                    password_confirm: "Mật khẩu không trùng khớp",
                },
                submitHandler: function (form) {
                    ajax_loading(true);
                    form.submit();
                }
            });
        });
    </script>
@endsection
