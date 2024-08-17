@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin</h3>
            </div>
            @php
                $link = isset($id) ? route($controllerName . '.edit', ['id' => $id]) : route($controllerName . '.create');
            @endphp
            <form class="form-horizontal" method="post" id="form_update" action="{{ $link }}">
                <div class="panel-body overflow-hidden">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Tiêu đề:<span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                    <input type="text" class="form-control" id="title" name="title" value="{{@$object->title}}">
                                    <label id="name-error" class="error" for="name" style="display: none;"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                             <label for="content">Nội dung <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control summernote" name="content" id="content"
                                          placeholder="Nhập nội dung bài viết"><?=@$object['content']?></textarea>
                                <label id="content-error" class="error" for="content"
                                       style="display: none;"></label>
                            </div>

                        </div>
                    </div>
                </div><!-- /.panel-body -->
                <div class="panel-footer text-center">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" id="is_next" value="0">
                            <input type="hidden" name="id" id="id" value="0">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                            <a href="{{route($controllerName . '.index')}}" class="btn btn-info btn-rounded">
                                <i class="fa fa-undo" aria-hidden="true"></i> Trở về trang danh sách
                            </a>

                            <button type="submit" class="btn btn-primary btn-rounded" onclick="$('#is_next').val(0)">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu lại
                            </button>

                            <button type="reset" class="btn btn-default btn-rounded" onclick="$('#is_next').val(0)">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.panel -->
    </div>
@endsection

@section('after_styles')
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
@stop
@section('after_scripts')
    @include('admin::includes.js-upload-image')
    {{--    @include('admin::includes.js-summernote')--}}
    @include('admin::includes.js-summernote')
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('input.minimal-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
            initUpload('#fileupload');

            $('.frm_update').validate({
                ignore: ".ignore",
                rules: {
                    title: "required",
                    content: "required",

                },
                messages: {
                    title: "Tiêu đề không được rỗng",
                    content: "Nội dung không được rỗng"
                },
                submitHandler: function (form) {
                    // do other things for a valid form
                    var url = $(form).attr('action');
                    var data = $(form).serializeArray();

                    request_ajax(url, data, "POST",
                        function (data) {
                            if (data.rs == 1) {
                                alert_success(data.msg, function () {
                                    location.href = '<?=route("$controllerName.index")?>';
                                });
                            } else {
                                malert(data.msg);
                                if (data.errors) {
                                    $.each(data.errors, function (key, msg) {
                                        $('#' + key + '-error').html(msg).show();
                                    });
                                }
                            }
                        });

                    return false;
                }
            });
        });
    </script>
@endsection
