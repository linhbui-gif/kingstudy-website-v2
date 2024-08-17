@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-header with-border">
                <h3 class="panel-title">Tạo lại mật khẩu</h3>
            </div>

            <!-- form start -->
            <form id="frm-add" method="post" action="" class="form-horizontal">
                <div class="panel-body">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="user_id" value="{!! $id !!}">
                        <div class="form-group">
                            <label for="form-field-3" class="col-sm-4" style="text-align:right">
                                Nhập mật khẩu <span class="symbol required"></span>
                            </label>
                            <div class="col-sm-8">
                                <div class="lang">
                                    <?php
                                    if (strlen ( old ( 'password_new' ) )) :
                                        $password_new = old ( 'password_new' );
                                    else:
                                        $password_new = '';
                                    endif;
                                    ?>
                                    <input type="password" name="password_new" id="password_new" value="{!! $password_new !!}" class="form-control">
                                    <label class="error">{!! $errors->first("password_new") !!}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form-field-3" class="col-sm-4" style="text-align:right">
                                Nhập lại mật khẩu <span class="symbol required"></span>
                            </label>
                            <div class="col-sm-8">
                                <div class="lang">
                                    <?php
                                    if (strlen ( old ( 'password_confirm' ) )) :
                                        $password_confirm = old ( 'password_confirm' );
                                    else:
                                        $password_confirm = '';
                                    endif;
                                    ?>
                                    <input type="password" name="password_confirm" value="{!! $password_confirm !!}" class="form-control">
                                    <label class="error">{!! $errors->first("password_confirm") !!}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="col-sm-3 col-sm-offset-3">
                            <a href='{!! route($controllerName.'.index') !!}' class="btn btn-success btn-rounded pull-left"><i class="fa fa-arrow-left"></i> Danh sách {{ $title }}</a>
                        </div>
                        <div class="col-sm-3 text-right">
                            <button class="btn btn-primary btn-labeled"><i class="fa fa-save"></i> Lưu lại</button>
                            <button type="reset" class="btn btn-default btn-labeled fa fa-refresh"> Làm lại</button>
                        </div>
                    </div>
                </div>
                <!-- /.panel-footer -->
            </form>
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('before_styles')
    <link href="/html/plugins/treeselect/css/jquery.bootstrap.treeselect.css" rel="stylesheet">
    <style>
        .select-department .dropdown-toggle {
            width: 100%;
        }
    </style>
@endsection

@section('after_scripts')
    <script src="/html/plugins/treeselect/js/jquery.bootstrap.treeselect.js"></script>

    <script type="text/javascript" src="/html/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/html/plugins/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="/html/plugins/ckeditor/adapters/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#frm-add').validate({
                ignore: ".ignore",
                rules: {
                    password_new: "required",
                    password_confirm: {
                        equalTo: "#password_new"
                    }
                },
                messages: {
                    password_new: "Nhập mật khẩu mới",
                    password_confirm: "Mật khẩu không trùng khớp",
                },
                submitHandler: function(form) {
                    ajax_loading(true);
                    form.submit();
                }
            });
        });
    </script>
@endsection
