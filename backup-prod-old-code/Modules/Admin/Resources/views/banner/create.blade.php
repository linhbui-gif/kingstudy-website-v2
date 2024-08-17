@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin banner</h3>
            </div>
            @php
                $link = isset($id) ? route($controllerName . '.edit', ['id' => $id]) : route($controllerName . '.create');
            @endphp
            <form class="form-horizontal" method="post" id="form_update" action="{{ $link }}">
                <div class="panel-body overflow-hidden">
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Tên banner <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                <input name="name" id="name" type="text" class="form-control"
                                       value="{{@$object['name']}}"
                                       placeholder="Nhập tên banner mới cần tạo">
                                <label id="name-error" class="error" for="name" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Tên sub banner <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                <input name="title_sub" id="title_sub" type="text" class="form-control"
                                       value="{{@$object['title_sub']}}"
                                       placeholder="Nhập tên sub banner mới cần tạo">
                                <label id="title_sub-error" class="error" for="title_sub" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Mô tả <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                <input name="description" id="description" type="text" class="form-control"
                                       value="{{@$object['description']}}"
                                       placeholder="Nhập mô tả mới cần tạo">
                                <label id="description-error" class="error" for="description" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Vị trí <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select("position_id", $positions_options, @$object['position_id'],
                                ['id' => 'position_id', 'class' => 'form-control']) !!}
                                <label id="position_id-error" class="error" for="position_id"
                                       style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Thứ tự hiển thị <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select("ordering",\App\Helpers\General::get_ordering_options(), @$object['ordering'], ['id' => 'ordering', 'class' => 'form-control']) !!}
                                <label id="ordering-error" class="error" for="ordering" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 text-right">
                                <label>Link <span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="url" id="url" class="form-control" value="{{@$object['url']}}"
                                       placeholder="Nhập link liên kết">
                                <label id="url-error" class="error" for="url" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Trạng thái
                            </label>
                            <div class="col-sm-9">
                                <?php
                                    $status = isset($object) ? old('status', @$object['status']) : 1;

                                ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1"
                                               class="minimal-red" {{$status==1?'checked':''}}> Kích hoạt
                                    </label>
                                    <label>
                                        <input type="radio" name="status" value="0"
                                               class="minimal-red" {{$status==0?'checked':''}}> Ngừng kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                                    Hình Banner <span class="required"></span></strong>
                            </label>
                            <div class="col-sm-8 btn-file">
                            <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                              <i class="fa fa-folder-open-o"></i>
                              <span>Chọn hình...</span>
                                <!-- The file input field used as target for the file upload widget -->
                              <input id="fileupload" type="file" name="files[]"
                                     onchange="uploadLoadFile(event, 'preview-banner')" accept="image/*"
                                     data-location="#image_location" data-error="#image_location-error"
                                     data-is-change="#is_change_image" data-object="home"
                                     data-progress="#progress .progress-bar">
                            </span>
                                <div>
                                    <span class="size-note">Kích thước: <b class="size">470 x 570 px</b></span>
                                    <span class="size-note">Dung lượng: <b class="file_size">500kb</b></span>
                                    <span class="size-note">Định dạng: <b class="file_type">jpg, png</b></span>
                                </div>
                                <div style="clear: both;"></div>
                                <!-- The global progress bar -->
                                <div id="progress" class="progress" style="margin-top: 10px;">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <p><img id="preview-banner" width="200"
                                        src="{{ isset($id)?url($object['image_url'].$object['image_location']):'/images/default.png' }}"/>
                                </p>
                                <input id="image_location" type="hidden" name="image_location"
                                       value="{{@$object['image_location']}}">
                                <input id="is_change_image" type="hidden" name="is_change_image" value="0">
                                <label id="image_location-error" class="error" for="image_location"
                                       style="display: none;"></label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-body -->
                <div class="panel-footer text-center">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" id="page" name="page" value="">
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
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        var _positions = {!! @json_encode($positions) !!};

        $(document).ready(function () {
            initUpload('#fileupload');

            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            $('input.minimal-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('#position_id').on('change', function () {
                var item = _positions[$(this).val()];
                $('.file_size').text(item.max_file_size);
                $('.file_type').text(item.file_type);
                $('.size').text(item.size);
                $('#page').val(item.page);
            });
            $('#position_id').trigger('change');

            $('input.slider-toggle').each(function (key, msg) {
                if ($(this).is(':checked')) {
                    $(this).closest('div').find('.tooltiptext').text('Đã kích hoạt');
                } else {
                    $(this).closest('div').find('.tooltiptext').text('Chưa kích hoạt');
                }
            });

            $('#form_update').validate({
                ignore: ".ignore",
                rules: {
                    name: "required",
                    position_id: "required",
                    ordering: "required",
                    url: "required",
                    image_location: "required"
                },
                messages: {
                    name: "Vui lòng nhập tên banner",
                    position_id: "Vui lòng chọn vị trí hiển thị",
                    ordering: "Vui lòng chọn thứ tự hiển thị",
                    url: "Vui lòng nhập link liên kết",
                    image_location: "Vui lòng chọn hình ảnh"
                },
                submitHandler: function (form) {
                    // do other things for a valid form
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            if (res.redirect_url) {
                                location.href = res.redirect_url;
                            } else {
                                location.reload();
                            }
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
