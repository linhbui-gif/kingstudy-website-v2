@extends('layouts.master')

<?php
$user = \App\Helpers\Auth::getUserInfo();
$permissions = \App\Helpers\Auth::get_permissions($user);
?>

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-header with-border">
                <h3 class="panel-title"><i class="fa fa-list" aria-hidden="true"></i> Danh sách
                    <div class="pull-right">
                        <a href="{!! route($controllerName.".add") !!}"
                           class="btn btn-xs btn-primary btn-rounded"><i class="fa fa-plus"></i> Thêm mới</a>
                    </div>
                </h3>
            </div>
            <div class="panel-body overflow-hidden">
                <table id="demo-custom-toolbar" class="table table-bordered table-striped table-hover" cellspacing="0"
                       data-toggle="table"
                       data-locale="vi-VN"
                       data-toolbar="#table-toolbar"
                       data-striped="true"
                       data-url="{!! route($controllerName.".search") !!}"
                       data-search="false"
                       data-show-refresh="false"
                       data-show-toggle="false"
                       data-show-columns="false"
                       data-pagination="true"
                       data-side-pagination="server"
                       data-page-size="25"
                       data-query-params="queryParams"
                       data-cookie="true"
                       data-cookie-id-table="roles-show-all"
                       data-cookie-expire="{!! config('params.bootstrapTable.extension.cookie.cookieExpire') !!}"
                >
                    <thead>
                    <tr>
                        <th data-field="check_id" data-checkbox="true">ID</th>
                        <th data-field="name" data-sortable="true">Tên vai trò</th>
                        <th data-field="created_at" data-sortable="true" data-formatter="formatDate">Ngày tạo</th>
                        <th data-field="id" data-align="center" data-formatter="actionColumn">Chức năng</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('before_styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
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

        $('#reset-page').click(function (){
            var url = window.location.href;
            window.location = url;
        });

        function actionColumn(value, row, index) {
            var tmp;
            var editBtn = [];

            <?php
                $hp = \App\Helpers\Auth::has_permission('adminauth::role.detail', $user, $permissions);
                if ($hp) { ?>
                tmp = '<?=route($controllerName.'.detail', ['id' => 'id'])?>';
                tmp = tmp.replace("/id", "/"+value);
                editBtn.push('<a href="' + tmp + '" class="btn btn-xs btn-default" ' +
                'data-toggle="tooltip" title="Phân quyền cho người dùng"><i class="fa fa-lock" aria-hidden="true"></i></a> ');
            <?php } ?>

<?php
                $hp = \App\Helpers\Auth::has_permission('adminauth::role.postEdit', $user, $permissions);
                if ($hp) { ?>
                tmp = '<?=route($controllerName.'.edit', ['id' => 'id'])?>';
                tmp = tmp.replace("/id", "/"+value);
                editBtn.push('<a href="' + tmp + '" ' +
                'data-toggle="tooltip" class="add-tooltip btn btn-info btn-xs" data-placement="top" title="Cập nhật vai trò">' +
                '<i class="fa fa-pencil"></i></a> ');
            <?php } ?>

<?php
                $hp = \App\Helpers\Auth::has_permission('adminauth::role.destroy', $user, $permissions);
                if ($hp) { ?>
                tmp = '<?=route($controllerName.'.delete', ['id' => 'id'])?>';
                tmp = tmp.replace("/id", "/"+value);
                editBtn.push('<a href="' + tmp + '" ' +
                'class="add-tooltip btn btn-danger btn-xs btn-delete" data-toggle="tooltip" title="Xoá vai trò">' +
                '<i class="fa fa-trash-o"></i></a> ');
                <?php } ?>

            return editBtn.join(' ');
        }

        function formatDate(value, row, index) {
            if(value != null)
            {
                return moment(value).format('HH:mm:ss DD-MM-YYYY');
            }
            return value;
        }

        function queryParams(params) {
            return params;
        }

        $(document).ready(function() {
            @if(isset($message) && $message)
                show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            var $table = $('#demo-custom-toolbar');

            $table.on('load-success.bs.table', function () {
                $('.btn-delete').on('click', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    var obj = $(this);
                    malert('Bạn có thật sự muốn xoá vai trò này không?', 'Xác nhận xoá vai trò', null, function () {
                        request_ajax(url, {}, "DELETE", function (res) {
                            ajax_loading(false);
                            show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                            if (res.rs) {
                                obj.closest('tr').remove();
                            }
                        });
                    });
                    return false;
                });
            });
        });

    </script>
@endsection
