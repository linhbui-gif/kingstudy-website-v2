@extends('layouts.master')

@section('after_styles')
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/jquery-easyui-1.5.3/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/jquery-easyui-1.5.3/themes/icon.css">
@endsection

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-header with-border">
                <h3 class="panel-title">Thêm người dùng với {{$title}}
                    <div class="pull-right">
                        <a href='{!! route($controllerName.'.getShowAll') !!}' class="btn btn-primary btn-xs btn-rounded"><i class="fa fa-reply"></i> Quay lại</a></a>
                    </div>
                </h3>
            </div>
            <div class="panel-body">
            <form role="form" class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-lg-4 col-sm-3 control-label" for="form-field-1">Vai trò</label>
                    <div class="col-lg-8 col-sm-9">
                        <label class="control-label">{{$object['name']}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="panel panel-bordered-primary" style="border: 1px solid #42a5f5;">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-list" aria-hidden="true"></i>
                                    Danh sách người dùng
                                </h3>
                            </div>
                            <div class="panel-body overflow-hidden">
                                <div class="row text-center">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <select id="search" class="easyui-combogrid form-control" style="width:100%"></select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-success btn-rounded add-users"><i class="fa fa-check-square-o" aria-hidden="true"></i> Thêm nhân sự</button>
                                    </div>
                                </div>
                                <hr>
                                <table id="danhsachnhanvien" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên nhân sự</th>
                                        <th class="text-center">Email</th>
                                        <th>Điện thoại</th>
                                        <th class="text-center">Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $item)
                                        <tr>
                                            <td>{{$item['id']}}</td>
                                            <td>{{$item['full_name']}}</td>
                                            <td class="text-center">{{$item['email']}}</td>
                                            <td>{{$item['phone']}}</td>
                                            <td>
                                                <a href="{{route($controllerName.'.remove-user', ['role_id' => $object['id'], 'user_id' => $item['id']])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="form-field-1">
                            Các chức năng được quyền thao tác
                        </label>
                        <table class="table table-bordered" id="permissions-table">
                            <thead>
                            <tr class="header_table">
                                <th>STT</th>
                                <th>Nhóm</th>
                                <th>Chức năng</th>
                                <th>Cho phép</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($has_permissions as $item)
                                    <tr>
                                        <td class="group-permission">{{ $item['parent_ordering'] }}</td>
                                        <td class="group-permission">
                                            {{ $item['parent_name'] }}
                                        </td>
                                        <td>{{ $item['name_label'] }}</td>
                                        <td><input disabled="disabled" type="checkbox" checked/></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <style>
        .group-permission {
            vertical-align: middle !important;
            font-weight: 700;
        }
    </style>
    <!--DataTables [ OPTIONAL ]-->
    <link href="/html/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/html/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    <script src="/html/plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="/html/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script src="/html/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="/html/plugins/datatables/extensions/dataTables.rowsGroup.js"></script>

    <!-- iCheck -->
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/jquery-easyui-1.5.3/jquery.easyui.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#permissions-table').DataTable({
                paging: false,
                "order": [[0, "asc"]],
                rowsGroup: [0, 1]
            });

            $('.add-users').on('click', function () {
                var vals = $('#search').combogrid('getValues');
                if (!vals || vals=='') {
                    malert('Vui lòng chọn nhân sự.');
                    return false;
                }

                request_ajax('{{route($controllerName.'.add-users')}}', {role_id: '{{$object['id']}}', user_ids: vals},
                    "POST", function (res) {
                    ajax_loading(false);
                    show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                    if (res.rs) {
                        location.reload();
                    }
                });
            });

            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('#search').combogrid({
                panelWidth:'50%',
                showOn: true,
                url: '{{route('adminauth::user.get-combogrid-data')}}',
                idField:'id',
                textField:'name',
                mode:'remote',
                fitColumns:true,
                multiple: true,
                columns:[[
                    {field:'id',title:'ID',width:60},
                    {field:'name',title:'Tên nhân sự',width:150},
                    {field:'phone',title:'Điện thoại',width:60},
                    {field:'email',title:'Email',align:'right',width:150},
                    {field:'department_name',title:'Bộ phận',align:'right',width:100}
                ]]
            });
        });
        // ask for confirmation before deleting an item
        $(document).on('click', "[data-button-type=delete]", function(e) {
            e.preventDefault();
            var delete_button = $(this);
            var delete_url = $(this).attr('href');

            malert("Bạn có muốn xoá nhân sự ra khỏi vai trò này không?", 'Xác nhận xóa', null, function () {
                request_ajax(delete_url, {}, "DELETE", function (res) {
                    ajax_loading(false);
                    show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                    if (res.rs) {
                        delete_button.parentsUntil('tr').parent().remove();
                    }
                });
            });
        });
    </script>
@endsection
