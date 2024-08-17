@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-info">
            <div class="panel-header with-border">
                <h3 class="panel-title">Đổi mật khẩu</h3>
            </div>
            <!-- /.panel-header -->
            <!-- form start -->
            <form id="frm-add" method="post" action="" class="form-horizontal">
                <div class="panel-body">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="password_old">
                                Nhập mật khẩu cũ <span class="symbol required"></span>
                            </label>
                            <div class="col-sm-8">
                                <?php
                                if (strlen ( old ( 'password_old' ) )) :
                                    $password_old = old ( 'password_old' );
                                else:
                                    $password_old = '';
                                endif;
                                ?>
                                <input type="password" name="password_old" value="{!! $password_old !!}" class="form-control">
                                <label class="error">{!! $errors->first("password_old") !!}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="password_new">
                                Nhập mật khẩu <span class="symbol required"></span>
                            </label>
                            <div class="col-sm-8">
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
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="password_confirm">
                                Nhập lại mật khẩu <span class="symbol required"></span>
                            </label>
                            <div class="col-sm-8">
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
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="text-center">
                        <button class="btn btn-primary btn-rounded"><i class="fa fa-save"></i> Lưu lại</button>
                        <button type="reset" class="btn btn-default btn-rounded"><i class="fa fa-refresh"></i> Làm lại</button>
                    </div>
                </div>
                <!-- /.panel-footer -->
            </form>
        </div>
        <!-- Default panel -->
    </div>
@endsection

@section('before_styles')
@endsection

@section('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            $('#frm-add').validate({
                ignore: ".ignore",
                rules: {
                    password_old: "required",
                    password_new: "required",
                    password_confirm: {
                        equalTo: "#password_new"
                    }
                },
                messages: {
                    password_old: "Nhập mật khẩu cũ",
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
