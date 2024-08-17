@extends('admin::layouts.master')

<?php
$user = \App\Helpers\Auth::getUserInfo();
$permissions = \App\Helpers\Auth::get_permissions($user);
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm
                    <div class="pull-right">
                        <a href="<?=route($controllerName.'.create')?>" class="btn btn-xs btn-success btn-rounded"
                           data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Thêm {{ $title }}</span></a>
                    </div>
                </h3>
            </div>
            <div class="panel-body overflow-hidden">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Từ khóa tìm kiếm</label>
                                {!! Form::text("keyword", @$_GET['keyword'], ['id'=>'keyword', 'class' => 'form-control',
                                'placeholder'=>"Nhập từ khoá tìm kiếm"]) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-fw fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                                    <a class="btn btn-default btn-rounded" href="{{route($controllerName.'.index')}}"><i class="fa fa-refresh" aria-hidden="true"></i> Làm lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table id="demo-custom-toolbar" class="table table-bordered table-striped table-hover" cellspacing="0"
                       data-toggle="table"
                       data-locale="vi-VN"
                       data-toolbar="#table-toolbar"
                       data-striped="true"
                       data-url="{!! route($controllerName.'.search') !!}"
                       data-search="false"
                       data-show-refresh="false"
                       data-show-toggle="false"
                       data-show-columns="false"
                       data-pagination="true"
                       data-side-pagination="server"
                       data-page-size="25"
                       data-query-params="queryParams"
                       data-cookie="true"
                       data-sort-order="desc"
                       data-cookie-id-table="{{$controllerName}}-index"
                       data-cookie-expire="{!! config('params.bootstrapTable.extension.cookie.cookieExpire') !!}"
                >
                    <thead>
                    <tr>
                        <th data-field="check_id" data-checkbox="true">ID</th>
                        <th data-field="username" data-sortable="true">Tài khoản</th>
                        <th data-field="full_name" data-sortable="true">Họ tên</th>
                        <th data-field="image_location" data-sortable="true" data-formatter="formatImage">Hình</th>
                        <th class="email text-wrap" data-field="email" data-sortable="true">Email</th>
                        <th data-field="phone" data-sortable="true">Số điện thoại</th>
                        <th data-field="id" data-align="center" data-formatter="actionColumn">Chức năng</th>
                    </tr>
                    </thead>
                </table>
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
        $('#department_filter').val($.cookie("usersShowAll.bs.table.department_filter"));
        $('#reset-page').click(function (){
            $.removeCookie("usersShowAll.bs.table.department_filter");
            $.removeCookie("usersShowAll.bs.table.searchText");
            location.reload();
        });

        function actionColumn(value, row, index) {
            var tmp;
            var changePasswordBtn = [];

            <?php
            $hp = \App\Helpers\Auth::has_permission('users.show-reset-password', $user, $permissions);
            if ($hp) { ?>
                tmp = '<?=route($controllerName.'.show-reset-password', ['id' => 'id'])?>';
                tmp = tmp.replace("/id", "/"+value);
                changePasswordBtn.push('<a href="'+tmp+'" ',
                'class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Tạo lại mật khẩu">',
                '<i class="fa fa-key"></i></a>');
                <?php } ?>

            var editBtn = [];

            <?php
                $hp = \App\Helpers\Auth::has_permission($controllerName.'.edit', $user, $permissions);
                if ($hp) {
                ?>
                tmp = '<?=route($controllerName.'.edit', ['id' => 'id'])?>';
            tmp = tmp.replace("/id", "/"+value);
            editBtn.push('<a href="' + tmp + '" ',
                'class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Cập nhật">',
                '<i class="fa fa-pencil"></i></a>');
            <?php } ?>

                <?php
        $hp = \App\Helpers\Auth::has_permission('users.index', $user, $permissions);
        if ($hp) { ?>
editBtn.push('<a href="{{ route($controllerName.'.delete') }}" ' +
                'class="add-tooltip btn btn-danger btn-xs btn-delete" data-id="' + value + '" data-toggle="tooltip" title="Xoá nhân sự">' +
                '<i class="fa fa-trash-o"></i></a>');
            <?php } ?>

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
                $.cookie("usersShowAll.bs.table.department_filter", $('#department_filter').val());
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
