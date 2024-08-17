@extends('admin::layouts.master')
<?php
$user = \App\Helpers\Auth::getUserInfo();
$permissions = \App\Helpers\Auth::get_permissions();
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</h3>
            </div>
            <div class="panel-body overflow-hidden">
                <form method="get">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="search" class="control-label">Từ khoá</label>
                            <div class="form-group">
                                {!! Form::text("keyword", @$_GET['keyword'], ['id'=>'keyword', 'class' => 'form-control',
                                'placeholder'=>"Nhập từ khoá tìm kiếm"]) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="date_from" class="control-label">Từ ngày</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text("date_from", @$_GET['date_from'],
                                    ['class' => 'form-control datepicker' , "id" => "date_from", "autocomplete"=>"off",
                                        'placeholder' => 'Từ ngày']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="date_from" class="control-label">Đến ngày</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text("date_to", @$_GET['date_to'],
                                    ['class' => 'form-control datepicker' , "id" => "date_to", "autocomplete"=>"off",
                                        'placeholder' => 'Đến ngày']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-success btn-rounded"><i class="fa fa-fw fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                                <a class="btn btn-default btn-rounded" href="{{route($controllerName.'.index')}}"><i class="fa fa-refresh" aria-hidden="true"></i> Làm lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-bordered-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list" aria-hidden="true"></i> Danh sách</h3>
            </div>
            <div id="table-toolbar">
                <?php
                $hp = \App\Helpers\Auth::has_permission($controllerName.'.create', $user, $permissions);
                if ($hp) {
                ?>
                <a href="<?=route($controllerName.'.create')?>" class="btn btn-primary btn-rounded">
                    <span class="ladda-label"><i class="fa fa-plus"></i> Thêm tin tức</span></a>
                <?php } ?>

                <?php
                $hp = \App\Helpers\Auth::has_permission($controllerName.'.active', $user, $permissions);
                if ($hp) {
                ?>
                <button id="demo-active-row" class="btn btn-success btn-rounded" disabled><i class="fa fa-check"></i> Kích hoạt</button>
                <?php } ?>

                <?php
                $hp = \App\Helpers\Auth::has_permission($controllerName.'.inactive', $user, $permissions);
                if ($hp) {
                ?>
                <button id="demo-inactive-row" class="btn btn-warning btn-rounded" disabled><i class="fa fa-times"></i> Ngừng kích hoạt</button>
                <?php } ?>

                <?php
                $hp = \App\Helpers\Auth::has_permission($controllerName.'.delete', $user, $permissions);
                if ($hp) {
                ?>
                <button id="demo-delete-row" class="btn btn-danger btn-rounded" disabled><i class="fa fa-trash-o"></i> Xóa</button>
                <?php } ?>
            </div>
            <div class="panel-body overflow-hidden">
                <table id="demo-custom-toolbar" class="table table-bordered table-striped table-hover" cellspacing="0"
                       data-toggle="table"
                       data-locale="vi-VN"
                       data-toolbar="#table-toolbar"
                       data-striped="true"
                       data-url="{!! route($controllerName.'.search') !!}"
                       data-search="false"
                       data-sort-name="updated_at"
                       data-sort-order="desc"
                       data-show-refresh="false"
                       data-show-toggle="false"
                       data-show-columns="false"
                       data-pagination="true"
                       data-side-pagination="server"
                       data-page-size="25"
                       data-query-params="queryParams"
                       data-cookie="true"
                       data-cookie-id-table="{{$controllerName}}-index"
                       data-cookie-expire="{!! config('params.bootstrapTable.extension.cookie.cookieExpire') !!}"
                >
                    <thead>
                    <tr>
                        <th data-field="check_id" data-checkbox="true">ID</th>
                        <th data-field="title">Tiêu đề</th>
                        <th data-field="keywords">Keywords</th>
                        <th data-field="created_at" data-formatter="formatDate">Ngày tạo</th>
                        <th data-field="updated_at" data-formatter="formatDate">Ngày cập nhật</th>
                        <th data-field="status" data-sortable="true" data-formatter="formatStatus">Trạng thái</th>
                        <?php
                        $hp = \App\Helpers\Auth::has_permission($controllerName.'.edit', $user, $permissions);
                        if ($hp) {
                        ?>
                        <th data-field="id" data-align="center" data-formatter="actionColumn">Chức năng</th>
                        <?php } ?>
                    </tr>
                    </thead>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <!-- /.content -->
    </div>
@endsection

@section('after_scripts')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
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

        @if($message=json_decode(session('msg'), 1))
            show_pnotify("{!! $message['title'] !!}", "{!! $message['text'] !!}", "{!! $message['type'] !!}");
        @endif

        function actionColumn(value, row, index) {
            var tmp = '';
            var editBtn = [];

            <?php
                $hp = \App\Helpers\Auth::has_permission($controllerName.'.edit', $user, $permissions);
                if ($hp) {
                ?>
                tmp = '<?=route($controllerName.'.edit', ['id' => 'id'])?>';
                tmp = tmp.replace("/id", "/"+value);
                editBtn.push(
                '<a href="' + tmp + '" ' +
                'class="add-tooltip btn btn-primary btn-xs" data-placement="top" data-original-title="Chỉnh sửa {{$title}}">' +
                '<i class="fa fa-edit"></i></a>');
            <?php } ?>

             <?php
            $hp = \App\Helpers\Auth::has_permission($controllerName.'.delete', $user, $permissions);
            if ($hp) { ?>
            editBtn.push('<a href="<?=route($controllerName.'.delete')?>?id=' + value + '" ' +
                'class="add-tooltip btn btn-danger btn-xs btn-delete" data-toggle="tooltip" data-original-title="Xoá {{$title}}">' +
                '<i class="fa fa-trash-o"></i></a>');
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

        function formatStatus(value, row, index) {
            if(value)
            {
                return '<span class="label label-sm label-success">Kích hoạt</span>'
            }
            else
            {
                return '<span class="label label-sm label-warning">Không kích hoạt</span>';
            }
        }

        function queryParams(params) {
            params['keyword'] = $('#keyword').val();
            params.is_active = $('#status_filter').val();
            params.date_from = $('#date_from').val();
            console.log('params', params)
            params.date_to = $('#date_to').val();
            params['category_id'] = $('#category_id').val();

            return params;
        }

        //---------------------------------
        function activeItems(items, e) {
            if (e) e.preventDefault();
            malert('Bạn có thật sự muốn kích hoạt {{$title}} này không?', 'Xác nhận đã xem {{$title}}', null, function () {
                var url = '{{ route($controllerName.'.active') }}';
                var data = {
                    '_token': '{{ csrf_token() }}',
                    'ids': items
                };
                request_ajax(url, data, "POST", function (data) {
                    $('#demo-custom-toolbar').bootstrapTable('refresh');
                    $('#demo-active-row').prop('disabled', true);
                    $('#demo-inactive-row').prop('disabled', true);
                    $('#demo-delete-row').prop('disabled', true);
                    if(data.rs == 1)
                    {
                        $('#success_msg').html(data.msg);
                        $('#success_div').css("display", "block");
                        $(window).scrollTop(0);
                    }
                    else
                    {
                        $('#error_msg').html(data.msg);
                        $("#error_div").css("display", "block");
                        $(window).scrollTop(0);
                    }
                });
            });
        }

        //---------------------------------
        function inactiveItems(items, e) {
            if (e) e.preventDefault();
            malert('Bạn có thật sự muốn hủy đã xem {{$title}} này không?', 'Xác nhận hủy đã xem {{$title}}', null, function () {
                var url = '{{ route($controllerName.'.inactive') }}';
                var data = {
                    '_token': '{{ csrf_token() }}',
                    'ids': items
                };
                request_ajax(url, data, "POST", function (data) {
                    $('#demo-custom-toolbar').bootstrapTable('refresh');
                    $('#demo-active-row').prop('disabled', true);
                    $('#demo-inactive-row').prop('disabled', true);
                    $('#demo-delete-row').prop('disabled', true);
                    if(data.rs == 1)
                    {
                        $('#error_msg').html(data.msg);
                        $("#error_div").show();
                        $(window).scrollTop(0);
                    }
                });
            });
        }

        //---------------------------------
        function deleteItems(items, e) {
            if (e) e.preventDefault();
            malert('Bạn có thật sự muốn xoá {{$title}} này không?', 'Xác nhận xoá {{$title}}', null, function () {
                var url = '{{ route($controllerName.'.delete') }}';
                var data = {
                    '_token': '{{ csrf_token() }}',
                    'ids': items
                };
                request_ajax(url, data, "POST", function (data) {
                    $('#demo-custom-toolbar').bootstrapTable('refresh');
                    $('#demo-active-row').prop('disabled', true);
                    $('#demo-inactive-row').prop('disabled', true);
                    $('#demo-delete-row').prop('disabled', true);
                    if(data.rs == 1)
                    {
                        $('#danger_msg').html(data.msg);
                        $('#danger_div').show();
                        $(window).scrollTop(0);
                    }
                });
            }, 'alert-danger');
        }


        $(document).ready(function() {

            @if (session('msg'))
                notifyMsg('{{ session('msg') }}');
            @endif

            init_select2('.select2');

            init_datepicker(".datepicker");

            var $table = $('#demo-custom-toolbar');

            $table.on('load-success.bs.table', function () {
                $('[data-toggle="tooltip"]').tooltip({
                    container: 'body'
                });
            });

            var $table = $('#demo-custom-toolbar');

            $table.on('load-success.bs.table', function () {
                $('[data-toggle="tooltip"]').tooltip({
                    container: 'body'
                });


                $('.btn-delete').on('click', function (e) {
                    e.preventDefault();
                    var obj = $(this);
                    malert('Bạn có thật sự muốn xoá {{$title}} này không?', 'Xác nhận xoá {{$title}}', null, function () {
                        request_ajax(obj.attr('href'), {}, "DELETE", function (res) {
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

            //-------------------------------

            var $active = $('#demo-active-row');

            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
                $active.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }).on('load-success.bs.table', function () {
                var tooltip = $('.add-tooltip');
                if (tooltip.length)tooltip.tooltip();
            });

            $active.click(function () {
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });
                activeItems(ids);
            });

            //-------------------------------

            var $inactive = $('#demo-inactive-row');

            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
                $inactive.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }).on('load-success.bs.table', function () {
                var tooltip = $('.add-tooltip');
                if (tooltip.length)tooltip.tooltip();
            });

            $inactive.click(function () {
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });
                inactiveItems(ids);
            });


            //------------------------------------

            var $delete = $('#demo-delete-row');

            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
                $delete.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }).on('load-success.bs.table', function () {
                var tooltip = $('.add-tooltip');
                if (tooltip.length)tooltip.tooltip();
            });

            $delete.click(function () {
                var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id;
                });
                deleteItems(ids);
            });
        });

    </script>
@endsection
