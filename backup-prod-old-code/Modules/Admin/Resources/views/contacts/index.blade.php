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
            <hr>
            <div class="panel-body">
                <table id="treeMapTable" class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                    <tr>
                        <th>Họ & tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Quốc gia du học</th>
                        <th>Trường</th>
                        <th>Bậc học</th>
                        <th>Ielts</th>
                        <th>Ngày gửi</th>
                        {{-- <th>Chức năng</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects['data'] as $index => $item)
                            @php
                            $pid = $item['id'];
                            $date = date('d/m/Y H:i:s', strtotime($item['created_at']));
                            @endphp
                        <tr data-tt-id="<?=$pid?>">
                            <td><?=@$item['name']?></td>
                            <td><?=@$item['phone']?></td>
                            <td><?=@$item['email']?></td>
                            <td><?=@$item['national_of_contact']['name']?></td>
                            <td>{{@$item['school_of_contact'] != null ? $item['school_of_contact']['name'] : "Chưa xác định" }}</td>
                            <td><?=@$item['level_courses']['name']?></td>
                            <td><?=@$item['ielts']?></td>
                            <td><?=$date?></td>
                          
                        </tr>
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
    </script>
@endsection
