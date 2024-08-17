@extends('admin::layouts.master')

@section('content')
    <style>
        .label_title {
            font-weight: 700;
        }
        #introduction_banner, .part_create .wrap_images img {
            width: auto;
            height: auto;
            max-height: 200px;
        }
    </style>
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Nội dung
                    <div class="pull-right">
                        <a class="btn btn-xs btn-primary btn-rounded introduction_banner_update">
                            <i class="fa fa-pencil-square-o"></i> Cập nhật
                        </a>
                    </div>
                </h3>
            </div>
            <div class="panel-body overflow-hidden">
                <div class="banner banner-display" style="display: block;">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td class="label_title">Vimeo Client</td>
                            <td>{!! @$objects['vimeo_client']['value'] !!}</td>
                        </tr>
                        <tr>
                            <td class="label_title">Vimeo Secret</td>
                            <td>{!! @$objects['vimeo_secret']['value'] !!}</td>
                        </tr>
                        <tr>
                            <td class="label_title">Vimeo Access</td>
                            <td>{!! @$objects['vimeo_access']['value'] !!}</td>
                        </tr>
                    </table>
                </div>

                <div class="banner-update" style="display:none;">
                    <form class="form-horizontal form-create" style="padding: 20px 0 20px 0;" method="post" id="form_update" action="">
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Vimeo Client</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="vimeo_client" id="vimeo_client"
                                       value="{!! @$objects['vimeo_client']['value'] !!}" class="form-control" placeholder="Nhập Vimeo Client">
                                <label id="vimeo_client-error" class="error" for="title" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Vimeo Secret</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="vimeo_secret" id="vimeo_secret" placeholder="Nhập Vimeo Secret">{!! @$objects['vimeo_secret']['value'] !!}</textarea>
                                <label id="vimeo_secret-error" class="error" for="vimeo_secret" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Vimeo Access</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="vimeo_access" id="vimeo_access" placeholder="Nhập Vimeo Access">{!! @$objects['vimeo_access']['value'] !!}</textarea>
                                <label id="vimeo_access-error" class="error" for="vimeo_access" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <div class="action">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <button type="submit" class="btn btn-primary btn-labeled btn-rounded fa fa-save BtnUpdate"> Lưu lại</button>
                                    <button type="reset" class="btn btn-default btn-labeled btn-rounded fa fa-refresh cancel Cancel"> Hủy bỏ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    @include('admin::includes.js-summernote')
    @include('admin::includes.js-upload-image')
    <?php
    $js = \App\Helpers\General::get_version_js();
    ?>
    <script type="text/javascript" src="/js/admin/introduction.js?v=<?=$js?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            initUpload('#fileupload');

            $('#form_update').validate({
                ignore: ".ignore",
                rules: {
                },
                messages: {
                },
                submitHandler: function(form) {
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            location.reload();
                        } else if (res.errors) {
                            $.each(res.errors, function (key, msg) {
                                $('#' + key + '-error').html(msg).show();
                            });
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
