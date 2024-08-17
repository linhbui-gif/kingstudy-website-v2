@extends('admin::layouts.master')
<?php
use App\Helpers\Auth;

$user = Auth::getUserInfo();
$permissions = Auth::get_permissions($user);
?>
@section('content')
    <style>
        .active_country{
            background: #104d8d;
            color: #ffffff;
        }
    </style>
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
                <div class="row">
                <div class="col-lg-4">
                    <div class="list-group">
                        <span class="list-group-item text-center active_country">
                            Tỉnh thành phố
                        </span>
                        @foreach($objects['data'] as $index => $item)
                            @if(isset($_GET['province']) && $item['id'] == $_GET['province'])
                                <a href="/admin/province?province=<?=$item['id']?>" class="list-group-item active"><?=$item['id']?>-  <?=$item['_name']?>  -  <?=$item['_code']?></a>
                            @else
                                <a href="/admin/province?province=<?=$item['id']?>" class="list-group-item"><?=$item['id']?>-  <?=$item['_name']?>  -  <?=$item['_code']?></a>
                            @endif
                        @endforeach
                    </div>
                </div>
                    @if(isset($provinces))
                    <div class="col-lg-4">
                        <div class="list-group">
                            <span class="list-group-item text-center active_country">
                            Quận huyện
                        </span>
                            @foreach($provinces as $index => $item)
                                @if(isset($_GET['district']) && $item['id'] ==  $_GET['district'])
                                <a href="/admin/province?province=<?=$item['_province_id']?>&district=<?=$item['id']?>" class="list-group-item active"><?=$item['id']?>-  <?=$item['_prefix']?> <?=$item['_name']?></a>
                                @else
                                    <a href="/admin/province?province=<?=$item['_province_id']?>&district=<?=$item['id']?>" class="list-group-item"><?=$item['id']?>-  <?=$item['_prefix']?> <?=$item['_name']?></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(isset($districts))
                        <div class="col-lg-4">
                            <div class="list-group">
                                <span class="list-group-item text-center active_country">
                            Phường xã
                        </span>
                                @foreach($districts as $index => $item)
                                    <a href="#" class="list-group-item"><?=$item['id']?>-  <?=$item['_prefix']?> <?=$item['_name']?></a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
{{--                @include('admin::includes.paginator')--}}

            </div>


        </div>
    </div>
@endsection

@section('after_styles')
    <link rel="stylesheet" href="/assets/plugins/jquery-treetable/css/jquery.treetable.css">
    <link rel="stylesheet" href="/assets/plugins/jquery-treetable/css/jquery.treetable.theme.default.css">
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
@endsection
