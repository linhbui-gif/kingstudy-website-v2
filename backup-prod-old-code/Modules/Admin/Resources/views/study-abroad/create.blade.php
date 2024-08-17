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
                            <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                                    Tiêu đề <span class="required"></span></strong>
                            </label>
                            <div class="col-md-8 mb-8" style="margin-bottom: 20px">
                                <input type="text" class="form-control valid" id="name_country" name="name_country" value="{{$object['name_country'] ?? ""}}" aria-invalid="false">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                                    Banner <span class="required"></span></strong>
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
                    <div class="col-md-12">
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
                    </div>
                   <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom: 20px;">
                      <li class="nav-item active">
                        <a class="nav-link " id="general_information-tab" data-toggle="tab" href="#general_information" role="tab" aria-controls="general_information" aria-selected="true">
                            Tổng quan
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Các trường đại học</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="education_program-tab" data-toggle="tab" href="#education_program" role="tab" aria-controls="education_program" aria-selected="false">Chưởng trình học bổng</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tuition-tab" data-toggle="tab" href="#tuition" role="tab" aria-controls="tuition" aria-selected="false">Các ngành học</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="false">Các thành phố</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" id="input-required-tab" data-toggle="tab" href="#input-required" role="tab" aria-controls="input-required" aria-selected="false">Tin tức du học</a>
                      </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="general_information" role="tabpanel" aria-labelledby="general_information-tab">
                            @include('admin::study-abroad.overview')
                      </div>
                      <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            @include('admin::study-abroad.system-schools')
                      </div>
                      <div class="tab-pane fade" id="education_program" role="tabpanel" aria-labelledby="education_program-tab">
                            @include('admin::study-abroad.scholarship')
                      </div>
                      <div class="tab-pane fade" id="tuition" role="tabpanel" aria-labelledby="tuition-tab">
                            @include('admin::study-abroad.majors')
                      </div>
                       <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab">
                            @include('admin::study-abroad.city')
                      </div>
                       <div class="tab-pane fade" id="input-required" role="tabpanel" aria-labelledby="input-required-tab">
                            @include('admin::study-abroad.news')
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
@include('admin::includes.js-ckeditor')
    <script type="text/javascript">
        $(document).ready(function () {
            initUpload('#fileupload');
            initUpload('#fileupload_overview');
            initUpload('#fileupload_schools');
            initUpload('#fileupload_scholarship');
            initUpload('#fileupload_majors');
            initUpload('#fileupload_city');
            initUpload('#fileupload_news');
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
            // Add item
            let count_ = 0;
            $('#btn_add_item').click(function(e) {
                e.preventDefault();
                let items = $(".school_item").length + 1 ;
                $("#container_school_items").append(`
                    <div class="school_item">
                        <div class="form-group">
                            <label class="col-sm-12" for="form-field-1">Title
                                <span class="required"></span>
                            </label>
                            <div class="col-sm-12">
                            <input name="system_schools_items[item_`+items+`][title]" id="" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="form-field-1">Content <span class="required"></span>
                            </label>
                            <div class="col-sm-12">
                            <textarea class="form-control summernote add_summer" name="system_schools_items[item_`+items+`][content]" id="" cols="50" rows="10">
                            </textarea>
                            </div>
                        </div>
                    </div>`)
                let value_answer = $('#value_answer').val();
                $('.add_summer').ckeditor();

            })

            //
            $('#form_update').validate({
                ignore: ".ignore",
                rules: {
                    name_country:"required",
                    title_country:'required',
                    overview_title: "required",
                    overview_img:'required',
                    overview_content:'required',
                    system_schools_title: "required",
                    system_schools_link:'required',
                    system_schools_img:'required',
                    scholarship_title: "required",
                    scholarship_link:'required',
                    scholarship_img:'required',
                    majors_title: "required",
                    majors_link:'required',
                    majors_img:'required',
                    city_title: "required",
                    city_link:'required',
                    city_img:'required',
                    news_title: "required",
                    news_link:'required',
                    news_img:'required',
                },
                messages: {
                    name_country:"Vui lòng nhập thông tin",
                    title_country:'Vui lòng nhập thông tin',
                    overview_title: "Vui lòng nhập thông tin",
                    overview_img:'Vui lòng chọn hình ảnh',
                    overview_content:'Vui lòng nhập thông tin',
                    system_schools_title: "Vui lòng nhập thông tin",
                    system_schools_link:'Vui lòng nhập thông tin',
                    system_schools_img:'Vui lòng chọn hình ảnh',
                    scholarship_title: "Vui lòng nhập thông tin",
                    scholarship_link:'Vui lòng nhập thông tin',
                    scholarship_img:'Vui lòng chọn hình ảnh',
                    majors_title: "Vui lòng nhập thông tin",
                    majors_link:'Vui lòng nhập thông tin',
                    majors_img:'Vui lòng chọn hình ảnh',
                    city_title: "Vui lòng nhập thông tin",
                    city_link:'Vui lòng nhập thông tin',
                    city_img:'Vui lòng chọn hình ảnhn',
                    news_title: "Vui lòng nhập thông tin",
                    news_link:'Vui lòng nhập thông tin',
                    news_img:'Vui lòng chọn hình ảnh',
                },
                submitHandler: function (form) {
                    // do other things for a valid form
                    var content = { name : "overview_content", value: CKEDITOR.instances.overview_content.getData() }
                    var data = $(form).serializeArray();
                    data.push(content);
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
