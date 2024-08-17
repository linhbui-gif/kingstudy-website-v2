@extends('admin::layouts.master')

<?php
$user = \App\Helpers\Auth::getUserInfo();
$permissions = \App\Helpers\Auth::get_permissions($user);
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title">Hồ sơ</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="TrackProfileDetail">
                            <div class="Card">
                                <div class="Card-header">Thông tin hồ sơ</div>
                                <div class="Card-body" style="padding: 3.2rem 0">
                                    <div class="SubmitFilePage-step-body-item">
                                        <div class="Collapse style-content active">
                                            <div class="Collapse-header">
                                                <h4 class="Collapse-title">Hồ sơ học thuật</h4>
                                            </div>
                                            <div class="Collapse-body">
                                                <div class="SubmitFilePage-upload-list flex flex-wrap row">
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
                                                            <div class="SubmitFilePage-upload-list-item col-md-2">
                                                                <div class="SubmitFilePage-upload-list-item-image"> <img src="{{ $src_icon }}" alt=""></div>
                                                                <div class="SubmitFilePage-upload-list-item-info">
                                                                    <h5 class="SubmitFilePage-upload-list-item-title">{{ $item->name }}
                                                                        <a target="_blank" href="{{ route('downloadFile') }}?fileName={{ $item->url }}&name={{ $item->name }}&t={{ time() }}">Tải về</a></h5>

                                                                </div>
                                                            </div>
                                                        @endforeach
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
                                                <div class="SubmitFilePage-upload-list flex flex-wrap row">
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
                                                            <div class="SubmitFilePage-upload-list-item col-md-2">
                                                                <div class="SubmitFilePage-upload-list-item-image"> <img src="{{ $src_icon }}" alt=""></div>
                                                                <div class="SubmitFilePage-upload-list-item-info">
                                                                    <h5 class="SubmitFilePage-upload-list-item-title">{{ $item->name }} <a target="_blank" href="{{ route('downloadFile') }}?fileName={{ $item->url }}&name={{ $item->name }}&t={{ time() }}">Tải về</a></h5>

                                                                </div>
                                                            </div>
                                                        @endforeach
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
                                                <div class="SubmitFilePage-upload-list flex flex-wrap row">
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
                                                            <div class="SubmitFilePage-upload-list-item col-md-2">
                                                                <div class="SubmitFilePage-upload-list-item-image"> <img src="{{ $src_icon }}" alt=""></div>
                                                                <div class="SubmitFilePage-upload-list-item-info">
                                                                    <h5 class="SubmitFilePage-upload-list-item-title">{{ $item->name }} <a target="_blank" href="{{ route('downloadFile') }}?fileName={{ $item->url }}&name={{ $item->name }}&t={{ time() }}">Tải về</a></h5>

                                                                </div>
                                                            </div>
                                                        @endforeach
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
                    <div class="col-md-4">
                        <div class="Card ProfilePage-table-content">
                            <div class="Card-header">Thông tin của bạn</div>
                            <div class="Card-body" style="padding: 2rem;">
                                @php
                                    $country = \Modules\Admin\Entities\Country::find($profile->country_id);
                                    $level = \Modules\Admin\Entities\LevelCourse::find($profile->level);
                                    $school = \Modules\Admin\Entities\School::where("id", $profile->school_id)->first();
                                    $course = \Modules\Admin\Entities\Course::where("id", $profile->course_id)->first();
                                @endphp
                                <div class="TrackProfile-text">Tên của bạn: <strong>{{ $profile->name }}</strong></div><br>
                                <div class="TrackProfile-text">Quốc gia du học: <strong>{{ @$country->name }}</strong></div><br>
                                <div class="TrackProfile-text">Trường học: <strong>@if($school) {{ $school->name }} @endif</strong></div><br>
                                <div class="TrackProfile-text">Khóa học: <a href="{{ @$course->link_course }}" target="_blank"><strong>@if($course) {{ $course->name }} @endif</strong></a></div><br>
                                <div class="TrackProfile-text">Số điện thoại: <strong>{{ $profile->phone }}</strong></div><br>
                                <div class="TrackProfile-text">Bậc học: <strong>{{ $level->name }}</strong></div><br>
                                <div class="TrackProfile-text">Email: <strong>{{ $profile->email }}</strong></div><br>
                                <div class="TrackProfile-text">Ielts: <strong>{{ $profile->english_skill }}</strong></div><br>
                                <div class="TrackProfile-text">Thời gian gửi: <strong>{{ $profile->created_at->format('h:i - d/m/Y') }}</strong></div><br>
{{--                                '0' => 'processing',--}}
{{--                                '1'=> 'Applied',--}}
{{--                                '2'=> 'Chase',--}}
{{--                                '3'=>  'Conditional Offer',--}}
{{--                                '4'=> 'Unconditional Offer',--}}
{{--                                '5'=> 'Cancel',--}}
{{--                                '6'=> 'Acept Offer',--}}
{{--                                '7'=> 'Fail',--}}
{{--                                '8'=> 'Successfull'--}}
                                <div class="TrackProfile-text">Trạng thái: {!! \App\Helpers\General::renderStatus($profile->status) !!}</div>
                                <br>
                                <form id="frmUpdate" action="{{ route('adminauth::profile.postView',['id' => $id]) }}" method="POST">
                                    <div class="form-group">
                                        <label for="">Cập nhật trạng thái</label>
                                        {!! Form::select("status",
                                               [
                                                    '0' => 'Processing',
                                                    '1'=> 'Applied',
                                                    '2'=> 'Chase',
                                                    '3'=>  'Conditional Offer',
                                                    '4'=> 'Unconditional Offer',
                                                    '5'=> 'Cancel',
                                                    '6'=> 'Accept Offer',
                                                    '7'=> 'Fail',
                                                    '8'=> 'Successful'
                                                ]
                                                , $profile->status, [ 'id' => 'status', 'class' => 'form-control']) !!}
                                    </div>
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('before_styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
    <style>
        .email.text-wrap {
            width: 40%;
            word-break: break-all;
            white-space: normal;
        }
        .SubmitFilePage-upload-list-item.col-md-2 {
            overflow: hidden;
        }
    </style>
@endsection

@section('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-vi-VN.min.js"></script>

    <style type="text/css">
        .bootstrap-select {
            margin: 0;
        }
    </style>

    <script type="text/javascript">

        $("select[name='status']").on('change', function(){
            $("#frmUpdate").submit();
        })

        $('#department_filter').val($.cookie("studentShowAll.bs.table.department_filter"));
        $('#reset-page').click(function (){
            $.removeCookie("studentShowAll.bs.table.department_filter");
            $.removeCookie("studentShowAll.bs.table.searchText");
            location.reload();
        });
        function formatSchool(value, row, index) {
            if(value != null)
            {
               return value.name;
            }
            return "";
        }
        function formatDateDayTime(value, row, index) {
            if(value != null)
            {
                return moment(value).format('H:mm DD-MM-YYYY');
            }
            return value;
        }
        function actionColumn(value, row, index) {
            var tmp;
            var changePasswordBtn = [];



            var editBtn = [];





            editBtn.push('<a href="/admin/profile/view/'+value+'" class="add-tooltip btn btn-xs btn-warning" data-id="' + value + '" data-toggle="tooltip" title="Xem hồ sơ">' +
                '<i class="fa fa-eye" aria-hidden="true"></i></a>');


                return [changePasswordBtn.join(' '), editBtn.join(' ')].join(' ');
        }

        function queryParams(params) {
            params.search = $('#keyword').val();
            params.vendor_id = $('#vendor_id').val();
            return params;
        }

        function formatImage(value, row, index) {
            if (!value) {
                value = '/images/user.png';
            }
            value = row['image_url'] + value;
            var url = '<img src="' + value +'" height="100" width="100" onerror="this.src=\'/images/user.png\';">';

            return url;
        }

        function formatAbility(value, row, index) {
            if(!value)
                value = 0;
            return '<div style="width: 125px;text-align: center;"> <input value="' + value + '" type="hidden" class="cus_rating rating-input" data-min=0 data-max=5 data-step=0.5 data-size="xs" data-disabled="true"></div>';
        }

        $(document).ready(function() {
            init_select2('.select2');

            @if(isset($message) && $message)
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            var $table = $('#demo-custom-toolbar');

            $table.on('load-success.bs.table', function () {
                init_action();
            });

            $table.on( 'column-switch.bs.table', function () {
                init_action();
            });

            // select_filter
            $('.custom_filter').on('change', function(evt, params) {
                $.cookie("studentShowAll.bs.table.department_filter", $('#department_filter').val());
                $table.bootstrapTable('refresh');
            });
        });

        function init_action() {
            $('.btn-reset-sga').on('click', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                malert('Bạn có thật sự muốn. ' + $(this).attr('data-original-title'), 'Xác nhận', null, function () {
                    location.href = href;
                });
                return false;
            });

            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                var obj = $(this);
                malert('Bạn có thật sự muốn xoá nhân sự này không?', 'Xác nhận xoá nhân sự', null, function () {
                    var url = obj.attr('href');
                    var data = {
                        '_token': '{{ csrf_token() }}',
                        'id': obj.attr('data-id')
                    };
                    request_ajax(url, data, "POST", function (res) {
                        ajax_loading(false);
                        $('#demo-custom-toolbar').bootstrapTable('refresh');
                        if(res.rs == 1)
                        {
                            $('#success_msg').html(res.msg);
                            $('#success_div').css("display", "block");
                            $(window).scrollTop(0);
                        }
                        else
                        {
                            $('#error_msg').html(res.msg);
                            $("#error_div").css("display", "block");
                            $(window).scrollTop(0);
                        }
                    });
                });
                return false;
            });
        }

    </script>
@endsection
