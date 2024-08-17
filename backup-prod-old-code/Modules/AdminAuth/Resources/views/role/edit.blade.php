@extends('layouts.master')

<?php
$action_name = isset($object) ? 'Chỉnh sửa' : 'Thêm mới';
?>

@section('content')
    <style>
        .group-permission {
            cursor: pointer;
        }
        .function_name label {
            font-weight: 100;
            cursor: pointer;
        }
    </style>

    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-header with-border">
                <h3 class="panel-title"><?=$action_name?> {{$title}}
                    <div class="pull-right">
                        <a href='{!! route($controllerName.'.getShowAll') !!}' class="btn btn-primary btn-xs btn-rounded"><i class="fa fa-reply"></i> Quay lại</a></a>
                    </div>
                </h3>
            </div>

            <form role="form" class="form-horizontal" method="post">
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <div class="col-md-6 col-sm-6">
                                <label for="name">Tên vai trò</label>
                                {!! Form::text("name", old('name', $object['name'] ?? ''), ['class' => 'form-control', 'required']) !!}
                                <span class="help-block has-error">{!! $errors->first("name") !!}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="form-field-1">
                                Quyền
                            </label>
                            <?php
                            function output_permissions($permissions, $all, $allowed=[]) {
                                foreach($permissions as $index => $item) {
                                    echo '<tr class="treegrid-'.$item['id'].($item['parent_id'] ? " treegrid-parent-".$item['parent_id'] : "").'">
                                        <td><label for="permission-'.$item['id'].'">'.(($index+1).'. '.$item['name_label']).'</label></td>';
                                    if (isset($all[$item['id']])) {
                                        echo '<td><input type="checkbox" id="permission-'.$item['id'].'"
                                               value="'.$item['id'].'" class="flat group-permission"/></td>';
                                    } else {
                                        echo '<td><input type="checkbox" name="permissions[]" id="permission-'.$item['id'].'"
                                               value="'.$item['id'].'" class="flat group-'.$item['parent_id'].'" '.(isset($allowed[$item['id']]) ? 'checked': '').'/></td>';
                                    }
                                    echo '</tr>';

                                    if (isset($all[$item['id']])) {
                                        output_permissions($all[$item['id']], $all, $allowed);
                                    }
                                }
                            }
                            ?>
                            <table class="table table-bordered default tree">
                                <thead>
                                <tr class="header_table">
                                    <th>Chức năng</th>
                                    <th>Cho phép</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php output_permissions($permissions[0], $permissions, $object['permissions'] ?? []); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <a href='{!! route($controllerName.'.getShowAll') !!}'
                       class="btn btn-success btn-rounded pull-left"><i class="fa fa-arrow-left"></i> Danh sách vài trò</a>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <button class="btn btn-primary btn-rounded"><i class="fa fa-save"></i> Lưu lại</button>
                    <button type="reset" class="btn btn-default btn-rounded"><i class="fa fa-refresh"></i> Làm lại</button>
                </div>
            </form>
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
    <link href="/html/plugins/treegrid/css/jquery.treegrid.css" rel="stylesheet">
    <script src="/html/plugins/treegrid/js/jquery.cookie.js"></script>
    <script src="/html/plugins/treegrid/js/jquery.treegrid.min.js"></script>
    <script src="/html/plugins/treegrid/js/jquery.treegrid.bootstrap3.js"></script>
    <!-- iCheck -->
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            $('.tree').treegrid({
                initialState: 'collapsed',
                saveState: true
            });

            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
            $('.group-permission').on('ifChanged', function(e){
                var isChecked = e.currentTarget.checked;

                var g = $(this).val();
                $('.group-'+g).each(function() {
                    if (isChecked) {
                        $(this).iCheck('check');
                    } else {
                        $(this).iCheck('uncheck');
                    }
                });
            });
        });

    </script>
@endsection
