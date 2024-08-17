@extends('admin::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$permissions = Auth::get_permissions($user);
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">

            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm.
                    <div class="pull-right" style="margin-top: 13px;">
                        @if (\App\Helpers\Auth::has_permission($controllerName.'.create', $user, $permissions))
                            <a class="btn btn-primary btn-rounded btn-xs pull-right" href="{{route($controllerName.'.create',@$_GET)}}">
                                <span class="ladda-label"><i class="fa fa-plus"></i> Thêm mới</span>
                            </a>
                        @endif
                    </div>
                    <div class="pull-right" style="margin-top: 13px;margin-right:16px">
                        @if (\App\Helpers\Auth::has_permission($controllerName.'.create', $user, $permissions))
                            <a class="btn btn-success btn-rounded btn-xs pull-right" data-toggle="modal" data-target="#modalAddItem">
                                <span class="ladda-label"><i class="fa fa-plus" style="margin-right:4px"></i>Import Excel</span>
                            </a>
                        @endif
                    </div>
                    {{-- Modal --}}
                    <div id="modalAddItem" class="modal fade in" role="dialog" >
                        <div class="modal-dialog modal-lg" style="width:400px">
                            <div class="modal-content" style="border-radius: 6px;">
                                @if (\App\Helpers\Auth::has_permission($controllerName.'.create', $user, $permissions))
                                <form action="{{route($controllerName.'.import_excel')}}"  method="POST" enctype="multipart/form-data">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title" style="margin: 10px 0;"><span class="label-action">
                                            <a class="btn btn-rounded btn_custom" href="{{route('admin::question.download_excel')}}">
                                            <span class="ladda-label"></i>Tải file mẫu</span>
                                            </a></span>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div id="import_excel_question">
                                            <div class="text-center">
                                                <div class="wrapper_question_excel">
                                                    <label for="questions_excel">
                                                        <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size:50px;color:#6990F2;"></i>
                                                    </label>
                                                    <input class="form-control hidden" type="file" name="questions_excel" id="questions_excel"/>
                                                    <p>Chọn tập tin upload</p>
                                                    <p id="file_name"></p>
                                                </div>
                                                <label id="questions_excel-error" class="error" style="display:none">Chọn tập tin cần upload </label>                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="reset" id="close-modal" data-dismiss="modal" class="cancel cancel_position_image btn btn-default btn-rounded">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>Close
                                        </button>
                                        <button id="btn_submit_add" type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>Save</button>
                                    </div>
                                    @csrf
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
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
                                <a class="btn btn-default btn-rounded" href="{{route($controllerName.'.index')}}"><i class="fa fa-refresh" aria-hidden="true"></i> Làm mới</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.panel-body -->
        </div><!-- /.panel -->
        <div class="panel panel-bordered-primary">

            @include("admin::includes.data-table",[
                'user'              => $user,
                'permissions'       => $permissions,
                'controllerName'    => $controllerName,
                'url_create'        => route($controllerName.'.create',['type' => $params['type']]),
                'change_status'     => true,
                'fields' => [
                    ['field' => 'name','title' => 'Câu hỏi'],
                    ['field' => 'created_at','title' => 'Ngày tạo','formatter' => 'formatDate'],
                    ['field' => 'status','title' => 'Trạng thái','formatter' => 'formatStatus','sortable' => 'true'],
                ]
            ])
        </div>
    </div>
@endsection
@section('after_styles')
@stop

@section('after_scripts')
    @include("admin::includes.data-table-scripts")
    <style type="text/css">
        .bootstrap-select {
            margin: 0;
        }
        .wrapper_question_excel {
          margin: 20px 10px;
          height:220px;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          border-radius: 5px;
          border: 2px dashed #6990F2;
        }
        .wrapper_question_excel label {
            cursor: pointer;
        }
        .btn_custom{
            background-image: radial-gradient(100% 100% at 100% 0, #5adaff 0, #5468ff 100%);
            color: #fff;
        }
        .btn_custom:hover {
            font-size: 16px;
            color:#fff;
        }
    </style>
    <script type="text/javascript">

        $('#reset-page').click(function (){
            var url = window.location.href;
            window.location = url;
        });

        function queryParams(params) {
            params.keyword = $('#keyword').val();
            params.status = $('#status_filter').val();
            params.date_from = $('#date_from').val();
            params.date_to = $('#date_to').val();
            params.cate_id = {{ isset($_GET['cate_id']) ? $_GET['cate_id'] : 0 }};
            return params;
        }
        $(document).ready(function() {

            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            init_select2('.select2');
            init_datepicker(".datepicker");
             $('#btn_submit_add').click(function(e) {
               let check = $('#questions_excel').val();
               if(check === '') {
                 e.preventDefault();
                 $('#questions_excel-error').css('display','block');
               }
            });
             $('#questions_excel').change(function(e) {
                if(this.value) {
                    var files = e.target.files
                    $('#questions_excel-error').css('display','none');
                    $('#file_name').html(files[0].name);
                }else {
                     $('#file_name').html('');
                }
            });

        });

    </script>
@endsection
