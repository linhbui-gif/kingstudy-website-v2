@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm
                </h3>
            </div>
            <div class="panel-body overflow-hidden">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tên</label>
                                {!! Form::text("keyword", @$_GET['keyword'], ['id'=>'keyword', 'class' => 'form-control',
                                'placeholder'=>"Nhập từ khoá tìm kiếm"]) !!}
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
        </div>

        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list" aria-hidden="true"></i> Danh sách</h3>
            </div>
            <div class="panel-body overflow-hidden">
                <?php
                $_objects = [];
                ?>
                @if ($objects['total'])
                    <div class="banner banner-display" style="display: block;">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th class="col-sm-2">Tên</th>
                                <th class="col-sm-3">Mô tả</th>
                                <th class="col-sm-4">Giá trị</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($objects['data'] as $index => $item)
                                    <?php
                                    $_objects[$item['id']] = $item;
                                    ?>
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['description']}}</td>
                                    <td>{{$item['value']}}</td>
                                    <td>
                                        @if ($item['active'])
                                            <span class="label label-sm label-success">Đã kích hoạt</span>
                                        @else
                                            <span class="label label-sm label-warning">Chưa kích hoạt</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-xs update-action add-tooltip" data-id="{{$item['id']}}"
                                           data-placement="top" data-original-title="Cập nhật">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @include('admin::includes.paginator')
                    </div>
                @endif

                <div class="banner-update" style="display: none;">
                    <form class="form-horizontal form-create" method="post" id="form_update" action="{{ route($controllerName.".add") }}">
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Tên <?=$title?> <span class="required"></span></label>
                            </div>
                            <div class="col-md-10">
                                <input readonly type="text" name="name" id="name" class="form-control" placeholder="Nhập tên <?=$title?> cần tạo">
                                <label id="name-error" class="error" for="title" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Mô tả <?=$title?> <span class="required"></span></label>
                            </div>
                            <div class="col-md-10">
                                <textarea readonly style="height: auto;" class="form-control" rows="2" name="description" id="description" placeholder="Nhập mô tả <?=$title?>"></textarea>
                                <label id="description-error" class="error" for="description" style="display: none;"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">
                                <label>Giá trị<span class="required"></span></label>
                            </div>
                            <div class="col-md-10">
                                <label id="value-error" class="error" for="value" style="display: none;"></label>
                                <div class="field field_image">
                                    <div class="col-md-6" style="padding-right: 20px;">
                                        <input type="text" value="" name="field_image" id="field_image" class="form-control" placeholder="Nhập link ảnh hoặc chọn ảnh"
                                               data-preview=".preview-banner" data-value="#value">
                                        <div class="btn-file" style="padding-top: 10px;">
                                            <span class="btn btn-sm btn-success fileinput-button btn-rounded">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Chọn hình...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="files[]" onchange="uploadLoadFile(event,'output')" accept="image/*"
                                                       data-object="setting" data-location="#field_image" data-error="#field_image-error"
                                                       data-is-change="#is_change_image" data-progress="#progress .progress-bar">
                                            </span>
                                            <label id="image_location-error" class="error" for="image_location"></label>
                                            <div style="clear: both;"></div>
                                            <!-- The global progress bar -->
                                            <div id="progress" class="progress" style="margin-top: 10px;">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <input id="is_change_image" type="hidden" name="is_change_image" value="0">
                                        </div>
                                        <span class="size-note">Chọn ảnh có kích thước phù hợp với vị trí bạn muốn hiển thị</span>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="output" class="preview-banner" src="/assets/images/default.png" style="max-width: 100%;"
                                             onerror="$(this).attr('src', '/assets/images/default.png')" alt="Banner giới thiệu">
                                    </div>
                                </div>
                                <div class="field field_textarea" style="display: none;">
                                    <textarea style="height: auto;" class="form-control" rows="10" name="value" id="value" placeholder="Nhập giá trị <?=$title?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label" style="padding-top: 0px;">
                                <label>Trạng thái <span class="required"></span></label>
                            </div>
                            <div class="col-md-10">
                                <div class="box-inline mar-rgt">
                                    <input value="0" type="hidden" name="active"/>
                                    <!--Switchery : Checked by default-->
                                    <!--===================================================-->
                                    <input id="sw-active" name="active" type="checkbox" value="1" checked data-title-true="Kích hoạt" data-title-false="Bỏ kích hoạt">
                                    <!--===================================================-->
                                </div>
                                <!--Switchery : Checking State Field-->
                                <!--===================================================-->
                                <span id="sw-active-field" class="label label-info"></span>
                                <!--===================================================-->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control-label">
                                <div class="action">
                                    <button type="reset" class="btn btn-default btn-labeled btn-rounded fa fa-refresh cancel Cancel"> Hủy bỏ</button>
                                    <input type="hidden" id="is_reload" value="0">
                                    <input type="hidden" id="is_next" value="0">
                                    <input type="hidden" name="id" id="id" value="0">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <button type="submit" class="btn btn-primary btn-labeled btn-rounded fa fa-save BtnUpdate"
                                            onclick="$('#is_next').val(0)">Lưu</button>
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

    <script type="text/javascript">
        var _objects = {!! json_encode($_objects) !!};

        $(document).ready(function() {
            var changeCheckbox = document.getElementById('sw-active'), changeField = document.getElementById('sw-active-field');
            var sw_active = new Switchery(changeCheckbox);
            changeField.innerHTML = $('#sw-active').data('title-true');
            changeCheckbox.onchange = function() {
                changeField.innerHTML = changeCheckbox.checked ? $('#sw-active').data('title-true') : $('#sw-active').data('title-false');
            };

            initUpload('#fileupload');

            $('.add-tooltip').tooltip();

            init_select2('.select2');

            $('#field_image').on('change', function () {
                $('.preview-banner').attr('src', $(this).val());
                $('#value').val($(this).val());
            });
            $('input.slider-toggle').each(function (key, msg) {
                if ($(this).is(':checked')) {
                    $(this).closest('div').find('.tooltiptext').text('Đã kích hoạt');
                } else {
                    $(this).closest('div').find('.tooltiptext').text('Chưa kích hoạt');
                }
            });

            $('.add-action').on('click', function () {
                add_action();
            });
            function add_action() {
                $('.add-action').hide();
                $('.banner-display').slideUp();
                $('.banner-update').slideDown();

                $('.TitleCreate').show();
                $('.TitleDisplay').hide();
                $('.BackAction').show();
            }
            $('.add-action-none').on('click', function () {
                $(this).parent().slideUp();
                $('.banner-update').slideDown();
                $('.BackAction').show();
            });
            $('#form_update .cancel').on('click', function (e) {
                e.preventDefault();

                if ($('#is_reload').val() == '1') {
                    location.reload();
                    return false;
                }

                $('#is_next').val(0);
                $('#form_update')[0].reset();

                $('.add-action-none').parent().slideDown();
                $('.banner-display').slideDown();

                if ($('.add-action-none').length > 0) {
                    $('.TitleCreate').show();
                    $('.TitleDisplay').hide();
                } else {
                    $('.TitleCreate').hide();
                    $('.TitleDisplay').show();
                    $('.add-action').show();
                }
                $('.BackAction').hide();
                $('.banner-update').slideUp();
            });

            $('.update-action').on('click', function () {
                var item = _objects[$(this).attr('data-id')];
                var field = $.parseJSON(item.field);

                $('label.error').hide();
                $('#form_update #is_next').val(0);
                $('#form_update #id').val(item.id);
                $('#form_update #name').val(item.name);
                $('#form_update #description').val(item.description);

                $('div.field').hide();
                if (field.type && field.type=='image') {
                    $('div.field_image').show();
                    $('#form_update #field_image').val(item.value).trigger('change');
                } else {
                    $('div.field_textarea').show();
                    $('#form_update #value').val(item.value);
                }

                if (item.active) {
                    $('#form_update #sw-active').data('title-true')
                } else {
                    $('#form_update #sw-active').data('title-false')
                }

                add_action();
            });

            $('#form_update').validate({
                ignore: ".ignore",
                rules: {
                    name: "required",
                    value: "required",
                },
                messages: {
                    name: "Vui lòng nhập tên <?=$title?>",
                    value: "Vui lòng chọn hoặc nhập giá trị <?=$title?>",
                },
                submitHandler: function(form) {
                    // do other things for a valid form
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        ajax_loading(false);
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if(res.rs == 1)
                        {
                            if ($('#is_next').val()=='1') {
                                add_action();

                                $('#is_reload').val(1);
                                $('#is_next').val(0);
                                $('#form_update')[0].reset();
                            } else {
                                location.reload();
                            }
                        } else {
                            if (res.errors) {
                                $.each(res.errors, function (key, msg) {
                                    $('#'+key+'-error').html(msg).show();
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
