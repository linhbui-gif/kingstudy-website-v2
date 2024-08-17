@extends('admin::layouts.master')

@section('content')
    @php
        $link = isset($id) ? route($controllerName . '.edit', ['id' => $id]) : route($controllerName . '.create');
    @endphp
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <form action="{{$link}}" class="frm_update" method="post" enctype="multipart/form-data">
                <div class="panel-body overflow-hidden" style="padding-top: 0px;">
                    <div class="wrapper" style="padding: 0px;margin-left: -20px;">
                        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs"
                             style="position: relative;">
                            <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                                <li role="presentation" class="active">
                                    <a data-toggle="tab" href="#">
                                        <span class="text">{!! $action !!}</span>
                                    </a>
                                </li>
                            </ul>
                            <a class="pull-right" href="<?=route($controllerName . '.index')?>"
                               style="position: absolute;right: 0px;top: 10px;"><i class="fa fa-reply"></i> Quay lại</a>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom: 20px;">
                          <li class="nav-item active">
                            <a class="nav-link " id="infor_news-tab" data-toggle="tab" href="#infor_news" role="tab" aria-controls="infor_news" aria-selected="true">Thông tin bài viết</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false">Meta</a>
                          </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="infor_news" role="tabpanel" aria-labelledby="infor_news-tab">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-vi">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Tên bài viết <span class="required"></span></label>
                                                <input onchange="changeInput(this, 'meta_title')" type="text" name="title" id="title" class="form-control"
                                                       placeholder="Nhập tiêu đề bài viết cần tạo"
                                                       value="<?=@$object['title']?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tên Alias</label>
                                                <input  type="text" name="alias" id="alias" class="form-control"
                                                       placeholder="Alias sẽ được tự động theo tên danh mục"
                                                       value="<?=@$object['alias']?>">
                                                <label id="alias-error" class="error" for="alias"
                                                       style="display: none;"></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Keyword <span class="required"></span></label>
                                                <input name="keywords" id="keywords" type="text" class="form-control"
                                                       placeholder="Nhập keyword, cách nhau bởi dấu phẩy"
                                                       value="<?=@$object['keywords']?>">
                                                <label id="keywords-error" class="error" for="keywords"
                                                       style="display: none;"></label>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label" style="padding-top: 10px">
                                                        Index
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        $index = (isset($object) && $object['is_index'] == '1') || !isset($object) ? 1 : 0;
                                                        ?>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="is_index" value="1"
                                                                       class="minimal-red" {{$index==1?'checked':''}}> Index

                                                            </label>
                                                            <label>
                                                                <input type="radio" name="is_index" value="0"
                                                                       class="minimal-red" {{$index==0?'checked':''}}> No index

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label" style="padding-top: 10px">
                                                        Trạng thái
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        $status = (isset($object) && $object['status'] == '1') || !isset($object) ? 1 : 0;
                                                        ?>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="status" value="1"
                                                                       class="minimal-red" {{$status==1?'checked':''}}> Kích
                                                                hoạt
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="status" value="0"
                                                                       class="minimal-red" {{$status==0?'checked':''}}> Ngừng
                                                                kích hoạt
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="category_id">Danh mục tin tức <span class="required"></span></label>
                                                <select id="category_id" name="category_id" class="form-control"
                                                        data-placeholder="Chọn danh mục tin tức">

                                                    @foreach($categories as $tmp)
                                                        <option value="{{$tmp['id']}}"
                                                                @if(isset($object) && $tmp['id'] == $object['category_id']) selected @endif>{{$tmp['name']}}</option>
                                                    @endforeach

                                                </select>

                                                @if ($errors->has('category_id'))
                                                    <label id="category_id-error" class="error"
                                                           for="category_id">{{$errors->first('category_id')}}</label>
                                                @else
                                                    <label id="category_id-error" class="error" for="category_id"
                                                           style="display: none;"></label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                                                        Thumbnail <span class="required"></span></strong>
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
                                                        <span class="size-note">Kích thước: <b
                                                                class="size">360 x 240 px</b></span>
                                                        <span class="size-note">Dung lượng: <b
                                                                class="file_size">500kb</b></span>
                                                        <span class="size-note">Định dạng: <b
                                                                class="file_type">jpg, png</b></span>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                                                        Banner <span class="required"></span></strong>
                                                </label>
                                                <div class="col-sm-8 btn-file">
                                                    <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                                                      <i class="fa fa-folder-open-o"></i>
                                                      <span>Chọn hình...</span>
                                                        <!-- The file input field used as target for the file upload widget -->
                                                      <input id="fileupload_location_banner" type="file" name="files[]"
                                                             onchange="uploadLoadFile(event, 'preview-location-banner')" accept="image/*"
                                                             data-location="#image_location_banner" data-error="#image_location_banner-error"
                                                             data-is-change="#is_change_image_banner" data-object="home"
                                                             data-progress="#progress .progress-bar">
                                                    </span>
                                                    <div>
                                                        <span class="size-note">Kích thước: <b
                                                                class="size">360 x 240 px</b></span>
                                                        <span class="size-note">Dung lượng: <b
                                                                class="file_size">500kb</b></span>
                                                        <span class="size-note">Định dạng: <b
                                                                class="file_type">jpg, png</b></span>
                                                    </div>
                                                    <div style="clear: both;"></div>
                                                    <!-- The global progress bar -->
                                                    <div id="progress_banner" class="progress" style="margin-top: 10px;">
                                                        <div class="progress-bar progress-bar-success"></div>
                                                    </div>
                                                    <p><img id="preview-location-banner" width="200"
                                                            src="{{ isset($id)?url($object['image_url'].$object['image_banner']):'/images/default.png' }}"/>
                                                    </p>
                                                    <input id="image_location_banner" type="hidden" name="image_location_banner"
                                                           value="{{@$object['image_banner']}}">
                                                    <input id="is_change_image_banner" type="hidden" name="is_change_image_banner" value="0">
                                                    <label id="image_location_banner-error" class="error" for="image_location_banner"
                                                           style="display: none;"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Mô tả ngắn <span class="required"></span></label>
                                                <textarea onchange="changeInput(this, 'meta_description')"  rows="10" cols="5" class="form-control" name="description" id="description"
                                                          placeholder="Nhập mô tả bài viết"><?=@$object['description']?></textarea>
                                                <label id="description-error" class="error" for="description"
                                                       style="display: none;"></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Nội dung <span class="required"></span></label>
                                                <textarea class="form-control ckeditor" name="content" id="content"
                                                          placeholder="Nhập nội dung bài viết"><?=@$object['content']?></textarea>
                                                <label id="content-error" class="error" for="content"
                                                       style="display: none;"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade show " id="meta" role="tabpanel" aria-labelledby="meta-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta title: <span class="required"></span></label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control"
                                               placeholder=""
                                               value="<?=@$object['meta_title']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta description: <span class="required"></span></label>
                                        <textarea name="meta_description" id="meta_description" cols="10" rows="5" class="form-control"><?=@$object['meta_description']?></textarea>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>

                <div class="panel-footer text-center">
                    <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="id" value="<?=@$object['id']?>">
                        <input type="hidden" id="is_next" value="0">

                        <button type="submit" class="btn btn-primary btn-rounded">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu lại
                        </button>

                        <button type="button" class="btn btn-default btn-rounded btn-href"
                                data-href="<?=route($controllerName . '.index')?>">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
                        </button>
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
    @include('admin::includes.js-ckeditor')
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('input.minimal-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
            initUpload('#fileupload');
            initUpload('#fileupload_location_banner');

            $('.frm_update').validate({
                ignore: ".ignore",
                rules: {
                    title: "required",
                    keywords: "required",
                    image_location: "required",
                    description: "required",
                    content: "required",
                    meta_title: {
                        maxlength: 60
                    },
                    meta_description: {
                        maxlength: 160
                    }
                },
                messages: {
                    title: "Vui lòng nhập tiêu đề bài viết",
                    category_id: "Vui lòng chọn danh mục tin tức",
                    keywords: "Vui lòng từ khóa seo",
                    image_location: "Vui lòng chọn ảnh đại diện",
                    description: "Vui lòng nhập mô tả bài viết",
                    content: "Vui lòng nhập nội dung bài viết",
                    meta_title: "Không vượt quá 60 ký tự",
                    meta_description: "Không vượt quá 160 ký tự",
                },
                submitHandler: function (form) {
                    // do other things for a valid form
                    for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
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

        function changeInput(t, id) {
            var v = $(t).val();
            console.log(v);
            $("#" + id).val(v);
        }

    </script>
@endsection
