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
                            <td class="label_title">Meta title</td>
                            <td>{!! @$objects['og_title']['value'] !!}</td>
                        </tr>
                        <tr>
                            <td class="label_title">Hình ảnh</td>
                            <td><img id="introduction_banner" src="{!! @$objects['og_image']['value'] !!}" alt=""></td>
                        </tr>
                        <tr>
                            <td class="label_title">Meta keywords</td>
                            <td>{!! @$objects['og_keywords']['value'] !!}</td>
                        </tr>
                        <tr>
                            <td class="label_title">Meta description</td>
                            <td>{!! @$objects['og_description']['value'] !!}</td>
                        </tr>
                    </table>
                </div>

                <div class="banner-update" style="display:none;">
                    <form class="form-horizontal form-create" style="padding: 20px 0 20px 0;" method="post" id="form_update" action="">
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Meta title</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="og_title" id="og_title"
                                       value="{!! @$objects['og_title']['value'] !!}" class="form-control" placeholder="Nhập meta title">
                                <label id="og_title-error" class="error" for="title" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Meta Image</label>
                            </div>
                            <div class="col-md-10">
                                <div class="btn-file">
                                    <span class="btn btn-sm btn-success fileinput-button btn-rounded">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Chọn hình...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input id="fileupload" type="file" name="files[]" onchange="uploadLoadFile(event,'output')" accept="image/*"
                                               data-object="meta-seo" data-location="#image_location" data-error="#image_location-error"
                                               data-is-change="#is_change_image" data-progress="#progress .progress-bar">
                                    </span>
                                    <label id="image_location-error" class="error" for="image_location"></label>
                                    <div style="clear: both;"></div>
                                    <!-- The global progress bar -->
                                    <div id="progress" class="progress" style="margin-top: 10px;">
                                        <div class="progress-bar progress-bar-success"></div>
                                    </div>
                                    <p><img id="output" width="200" onerror="this.src='/assets/images/1920x450.png';"
                                            src="{!! @$objects['og_image']['value'] !!}"/></p>
                                    <input id="image_location" type="hidden" name="image_location" value="{!! @$objects['og_image']['value'] !!}">
                                    <input id="is_change_image" type="hidden" name="is_change_image" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Meta keywords</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="og_keywords" id="og_keywords" placeholder="Nhập meta keywords">{!! @$objects['og_keywords']['value'] !!}</textarea>
                                <label id="og_keywords-error" class="error" for="og_keywords" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Meta description</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" name="og_description" id="og_description" placeholder="Nhập meta description">{!! @$objects['og_description']['value'] !!}</textarea>
                                <label id="og_description-error" class="error" for="og_description" style="display: none;"></label>
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
