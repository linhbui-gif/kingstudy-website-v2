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
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Tên khóa học<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                            <input type="text" class="form-control" id="name" name="name" value="{{@$object->name}}">
                                            <label id="name-error" class="error" for="name" style="display: none;"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Ký hiệu</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="kyhieu" name="kyhieu" value="{{@$object->kyhieu}}">
                                        <label id="kyhieu-error" class="error" for="kyhieu" style="display: none;"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Chuyên Ngành:<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="majors_id" id="majors_id" class="form-control select2">
                                           <option value="">-- Chọn ngành --</option>
                                           @if(isset($majors))
                                            @foreach($majors as $major)
                                            @php
                                            $selected = $major['id'] == @$object->majors_id ? 'selected' :'';
                                            @endphp
                                            <option {{$selected}} value="{{$major['id']}}">{{$major['name']}}</option>
                                            @endforeach
                                           @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Bậc học:<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="type" id="type" class="form-control select2">
                                            <option value="">--Chọn bậc học--</option>
                                            @php
                                                $levels  = [ 1 => "Đại học", 2 => "Sau đại học", 3 => "Cao đẳng", 4 => "Khác" ];
                                            @endphp
                                            @foreach($levels as $k => $level)
                                                @php
                                                    $selected = $k == @$object->type ? 'selected' :'';
                                                @endphp
                                                <option {{$selected}} value="{{$k}}">{{$level}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Title:<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="title" name="title" value="{{@$object->title}}">
                                        <label id="title-error" class="error" for="title" style="display: none;"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Description:<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="description" name="description" rows="10" cols="5">
                                            {{@$object->description}}
                                        </textarea>
{{--                                        <label id="description-error" class="error" for="description" style="display: none;"></label>--}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Content:<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control ckeditor" id="content" name="content">{{@$object->content}}</textarea>
                                        <label id="content-error" class="error" for="content" style="display: none;"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 control-label">
                                        <label>Link:<span class="required"></span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input value="{{@$object->link_course}}" type="text"
                                        class="form-control" id="link_course" name="link_course">
                                        <label id="link_course-error" class="error" for="link_course" style="display: none;"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                                            Picture <span class="required"></span></strong>
                                    </label>
                                    <div class="col-sm-8 btn-file">
                                    <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                                      <i class="fa fa-folder-open-o"></i>
                                      <span>Chọn hình...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                      <input id="fileupload" type="file" name="files[]"
                                             onchange="uploadLoadFile(event, 'preview-picture')" accept="image/*"
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
                                        <div id="progress" class="progress" style="margin-top: 10px;">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <p><img id="preview-picture" width="200"
                                                src="{{ isset($object['image_url'])?url($object['image_url']):'/images/default.png' }}"/>
                                        </p>
                                        <input id="image_location" type="hidden" name="image_location"value="{{@$object['image_url']}}">
                                        <input id="is_change_image" type="hidden" name="is_change_image" value="0">
                                        <label id="image_location-error" class="error" for="image_location"style="display: none;"></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Hiển thị trang chủ
                            </label>
                            <div class="col-sm-9">
                                <?php
                                $show_home = isset($object) ? old('show_home', @$object['show_home']) : 0;
                                ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="show_home" value="1"
                                               class="minimal-red" {{$show_home==1?'checked':''}}> Hiển thị
                                    </label>
                                    <label>
                                        <input type="radio" name="show_home" value="0"
                                               class="minimal-red" {{$show_home==0 ?'checked':''}}> Không hiển thị
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

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
                                               class="minimal-red" {{$status==0 ?'checked':''}}> Ngừng kích hoạt
                                    </label>
                                </div>
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
   @include('admin::includes.js-ckeditor')
   @include('admin::includes.js-upload-image')
    <script type="text/javascript">
        $(document).ready(function () {
            initUpload('#fileupload');
            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

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
                    title: "required",
                    // description: "required",
                    content: "required",
                    // image_location: "required",
                    majors_id:'required',
                    link_course:'required',

                },
                messages: {
                    name: "Vui lòng nhập tên khóa học",
                    title: "Not empty",
                    // description: "Not empty",
                    content: "Not empty",
                    // image_location: "Chọn ảnh",
                    majors_id:'Chọn chuyên ngành',
                    link_course:'Nhập link khóa học',
                },
                submitHandler: function (form) {
                    // do other things for a valid form
                    for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
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
