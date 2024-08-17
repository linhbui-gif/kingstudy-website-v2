@extends('admin::layouts.master')
<?php
use App\Helpers\Auth;

$user = Auth::getUserInfo();
$permissions = Auth::get_permissions($user);
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list" aria-hidden="true"></i> Danh sách</h3>
            </div>
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

            <div class="panel-body">
                <div class="row text-right">
                    <button class="btn btn-purple btn-href btn-rounded" data-href="<?=route($controllerName.'.create')?>">
                        <i class="demo-pli-add icon-fw"></i> Tạo mới danh mục con
                    </button>

                    <button class="btn btn-purple btn-href btn-rounded" data-href="<?=route($controllerName.'.create',['is_main' => 1])?>">
                        <i class="demo-pli-add icon-fw"></i> Tạo mới danh mục chính
                    </button>
                </div>


                <table id="treeMapTable" class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                    <tr>
                        <th>Tên danh mục</th>
                        <th>Thứ tự</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects['data'] as $index => $item)
                        <?php
                        $pid = $item['id'];
                        ?>
                        <tr data-tt-id="<?=$pid?>">
                            <td><?=$item['name']?></td>
                            <td><?=$item['ordering']?></td>
                            <td>
                                @if($item['status'] == '1')
                                    <span class="label label-sm label-success">Đã kích hoạt</span>
                                @else
                                    <span class="label label-sm label-warning">Chưa kích hoạt</span>
                                @endif
                            </td>

                            <td>
                                <a href="<?=route('admin::categoryNew.edit', $item['id'])?>" class="add-tooltip btn btn-primary btn-xs" data-placement="top" data-original-title="Sửa">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="delete-action add-tooltip btn btn-danger btn-xs btn-delete" data-placement="top" data-original-title="Xóa" data-url="{{route('admin::categoryNew.delete',$item['id'])}}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>

                        @if (!empty($item['child']))
                            @foreach($item['child'] as $child1)

                                @include('admin::news-categories.item-index',['item' => $child1,'pid' => $pid])

                                @if (!empty($child1['child']))
                                    @foreach($child1['child'] as $child2)

                                        @include('admin::news-categories.item-index',['item' => $child2,'pid' => $child1['id']])

                                    @endforeach
                                @endif

                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>

                @include('admin::includes.paginator')

            </div>


        </div>
    </div>
@endsection

@section('after_styles')
    <link rel="stylesheet" href="/assets/plugins/jquery-treetable/css/jquery.treetable.css">
    <link rel="stylesheet" href="/assets/plugins/jquery-treetable/css/jquery.treetable.theme.default.css">
    <!-- <link rel="stylesheet" href="/assets/plugins/jquery-treetable/css/screen.css"> -->
    <!-- iCheck -->
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">

    <style type="text/css">
        table.treetable span.label{
            padding: 3px 5px;
        }
    </style>
@endsection

@section('after_scripts')
    <!-- iCheck -->
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>
    <script src="/assets/plugins/jquery-treetable/jquery.treetable.js"></script>

    <script type="text/javascript">
        $(function(){
            $('#treeMapTable').treetable({
                expandable:true,
                column:0,
                initialState:'expanded',
                onInitialized: function(){
                    $('input.flat').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });
                }
            });

            $('.delete-action').on('click', function (e) {
                e.preventDefault();
                var obj = $(this);
                malert('Bạn có chắc chắn muốn xóa không?', 'Xác nhận xoá', null, function () {
                    request_ajax(obj.attr('data-url'), {}, "delete", function (res) {
                        ajax_loading(false);
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            obj.closest('tr').remove();
                        }
                    });
                });
                return false;
            });

        })
        $(document).ready(function() {
            init_datepicker(".datepicker");
        })
    </script>
@endsection
