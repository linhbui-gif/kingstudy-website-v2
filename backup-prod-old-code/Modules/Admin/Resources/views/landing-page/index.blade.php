@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-body" style="padding-top: 0px;">
                <div class="wrapper" style="padding: 0px;margin-left: -20px;">
                    <div class="bs-example bs-example-tabs" role="tabpanel"
                         data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                            @php
                                $previous = -1;
                                $current = -1;
                                $next = -1;
                                $count = 0;
                                foreach($positions as $key => $position) {

                                    if ($position['id'] == $position_id) {
                                        $current = $count;
                                        if ($current > 0 ) {
                                            $previous = $current - 1;
                                        }
                                        if ($current < (count($positions) - 1)) {
                                            $next = $current + 1;
                                        }
                                    }
                                    $count++;
                                }

                            @endphp
                            @foreach($positions as $key => $position)
                                @php
                                    $class = '';
                                    if ($loop->index == $previous) {
                                        $class = 'prev';
                                    }
                                    if ($loop->index == $current) {
                                        $class = 'active';
                                    }
                                    if ($loop->index == $next) {
                                        $class = 'next';
                                    }
                                @endphp
                                <li role="presentation" class="<?=$class?>">
                                    <a href="<?=route('admin::landingPagePosition.index', ['landing_page_id' => $landing_page_id, 'position_id' => $position['id']])?>"
                                    >
                                        <span class="text"><?=$position['name']?></span>
                                    </a>
                                </li>

                            @endforeach
                        </ul>

                    </div>
                </div>

                <!--Tabs Content-->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="demo-tabs-box-1">
                        @if(View::exists('admin::landing-page.'.$position_type['type'].'.index'))
                            <div class="row">
                                @include('admin::landing-page.'.$position_type['type'].'.index')
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('after_styles')
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
    <style type="text/css">
        #myTab .active a {
            border-top: 3px solid #F4A800;
        }
        .list_images {
            margin-top: 15px;
        }

        .list_images .item {
            margin-top: 15px;
            border-bottom: solid 1px #ccc;
        }

        h4.title-block {
            font-size: 13px;
        }

        div.tab a {
            padding: 10px 10px;
        }

        .block_status {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .block.col-md-12 {
            padding-left: 15px;
            padding-right: 15px;
        }

        .object_relationship_list .home_positions_objects_ordering {
            text-align: center;
            width: 70px;
        }

        label.error {
            height: unset !important;
        }

        .object_relationship_list img {
            max-height: 40px;
        }

        .edit_position_images {
            margin-right: 10px;
        }

        .preview-image-position-image {
            max-height: 150px;
        }
        img.preview-banner{
            max-height: 150px;
            width: auto;
        }
    </style>
@stop
@section('after_scripts')

    @include('admin::includes.js-upload-image')
    @include('admin::includes.js-ckeditor')
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        var $object_ids = <?=!empty($object_ids) ? json_encode($object_ids) : '[]'?>;
        var $object = <?=!empty($object) ? json_encode($object) : '{}'?>;
        var $position_image = <?=!empty($objects['position_image']) ? json_encode($objects['position_image']) : '[]'?>;
        var object_selected = [];


        $(function () {
            {{--$('.faqs .delete-action').on('click', function () {--}}
            {{--    var obj = this;--}}
            {{--    confirm_delete("Bạn có chắc chắn muốn xóa?", function () {--}}
            {{--        request_ajax('{{route('admin::faqs.delete')}}', {id: $(obj).attr('data-id')}, "POST", function (res) {--}}
            {{--            ajax_loading(false);--}}
            {{--            show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');--}}
            {{--            if (res.rs) {--}}
            {{--                obj.closest('tr').remove();--}}
            {{--            }--}}
            {{--        });--}}
            {{--    });--}}
            {{--});--}}

            if($('#fileupload').length > 0){
                initUpload('#fileupload');
            }
            if($('#fileuploadItems').length > 0){
                initUpload('#fileuploadItems');
            }
            if($('#fileuploadChildItems').length > 0){
                initUpload('#fileuploadChildItems');
            }


            $('input.minimal-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('#frm_update').validate({
                ignore: ".ignore",
                rules: {
                    "title": "required",
                    "content": "required",
                    image_location: "required",
                    youtube: "required",
                    map: "required",
                    keywords: "required",
                    width: "required",
                    height: "required",
                    link_more: "required"
                },
                messages: {
                    "title": "Nhập tiêu đề",
                    "content": "Nhập nội dung",
                    image_location: "Chọn hình ảnh",
                    youtube: "Nhập link youtube",
                    map: "Nhập mã nhúng bản đổ",
                    keywords: "Nhập Keywords",
                    width: "Nhập Width",
                    height: "Nhập Height",
                    link_more: "Nhập liên kết"
                },
                submitHandler: function (form) {
                    // var content = { name : "locales[vi][content]", value: CKEDITOR.instances.content.getData() }
                    for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                    var data = $(form).serializeArray();
                    // data.push(content);
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        ajax_loading(false);
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            location.reload();
                        } else if (data.errors) {
                            $.each(data.errors, function (key, msg) {
                                $('#' + key + '-error').html(msg).show();
                            });
                        }
                    });

                    return false;
                }
            });

            $('#frm_update_images').validate({
                submitHandler: function (form) {
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    if ($('.list_images .item').length < 1) {
                        malert('Vui lòng nhập đầy đủ thông tin!');
                        return false;
                    }
                    request_ajax(url, data, "POST", function (res) {
                        ajax_loading(false);
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            location.reload();
                        } else if (data.errors) {
                            $.each(data.errors, function (key, msg) {
                                $('#' + key + '-error').html(msg).show();
                            });
                        }
                    });

                    return false;
                }
            });

            $('#add_images').validate({
                ignore: ".ignore",
                rules: {
                    image_location: "required",
                    title: "required",
                    link: "required",
                },
                messages: {
                    image_location: "Chọn hình ảnh",
                    title: "Nhập tiêu đề",
                    link: "Nhập liên kết",
                },
                submitHandler: function (form) {
                    setHtmlImageList1();
                    $(form)[0].reset();
                    $('#add_images .preview-image-main').attr('src', '/html/cms/assets/images/img_upload.png');
                    return false;
                }
            });

            function setHtmlImageList1() {
                var image_location = $('#add_images #image_location').val();
                var title = $('#add_images #title').val();
                var link = $('#add_images #link').val();
                var ordering = $('#add_images #ordering').val();
                var description = $('#add_images #description').val();

                var item = $.now();
                var html = '<div class="row item">';
                html += '<div class="col-md-5">';
                html += '<div class="image-upload">';
                html += '<label for="file-input">';
                html += '     <img class="" src="' + image_location + '" alt=""/>';
                html += '     <input type="hidden" class="form-control image_location" placeholder="" value="' + image_location + '" name="position_images[' + item + '][image_location]">';
                html += '</label>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-md-6">';
                html += '    <div class="form-group">';
                html += '        <label for="">Tiêu đề</label>';
                html += '        <input type="text" class="form-control title" placeholder="" value="' + title + '" name="position_images[' + item + '][title]">';
                html += '    </div>';
                html += '    <div class="form-group">';
                html += '        <label for="">Liên kết</label>';
                html += '        <input type="text" class="form-control" placeholder="" value="' + link + '" name="position_images[' + item + '][link]">';
                html += '    </div>';
                html += '        <div class="form-group">';
                html += '            <label for="">Thứ tự</label>';
                html += '            <input type="number"  class="form-control" placeholder="" value="' + ordering + '" name="position_images[' + item + '][ordering]" min="0">';
                html += '        </div>';
                html += '<div class="form-group">';
                html += '            <label for="">Mô tả</label>';
                html += '            <textarea class="form-control" rows="3" name="position_images[' + item + '][description]">' + description + '</textarea>';
                html += '';
                html += '        </div>';
                html += '</div>';
                html += '<div class="col-md-1">';
                html += '    <a href="javascript:void(0)" onclick="$(this).closest(\'.row.item\').remove()"><span class="glyphicon glyphicon-remove"></span></a>';
                html += '</div>';
                html += '</div>';

                $('#frm_update_images .list_images').prepend(html);
            }


            var page_limit = 10;
            $('#object_ids').select2({
                //multiple: true,
                ajax: {
                    url: '<?=route("admin::landingPagePosition.search-relationship")?>',
                    dataType: 'json',
                    delay: 500,
                    headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                    data: function (params) {
                        var query = {
                            q: params.term,
                            position_id: <?=$position_id?>,
                            not_ids: object_selected,
                            page: params.page || 1,
                            limit: page_limit
                        }
                        return query;
                    },
                    processResults: function (results, params) {
                        params.page = params.page || 1;
                        return {
                            results: results.data,
                            pagination: {
                                more: (params.page * page_limit) < results.total
                            }
                        };
                    },
                    formatSelection: function (data) {
                        return data;
                    },
                    cache: true
                }
            });

            $('#object_ids').on('change', function () {
                var data = $(this).select2('data');
                if (data.id && data.text) {
                    object_selected.push(data.id);
                    setHtmlObjectRelation(data.id, data.text);
                } else if (data[0].id && data[0].text) {
                    object_selected.push(data[0].id);
                    setHtmlObjectRelation(data[0].id, data[0].text);
                }

                $(this).select2('data', '');
            });

            $(document).on('click', '.remove_object_relation', function () {
                $(this).closest('tr').remove();
                setSttObjectRelation();
                // if ($('.remove_object_relation').length == 0) {
                //     $('.object_relationship_list').hide();
                // }
            });

            if ($object_ids) {
                $.each($object_ids, function (k, data) {
                    object_selected.push(data.id);
                    setHtmlObjectRelation(data.id, data.text);
                });
            }

            $('#frm_update_all').validate({
                ignore: ".ignore",
                rules: {
                    "title": "required",
                    "content": "required",
                    // image_location: "required",
                    youtube: "required",
                    map: "required",
                    keywords: "required",
                    width: "required",
                    height: "required",
                    link_more: "required"
                },
                messages: {
                    "title": "Nhập tiêu đề",
                    "content": "Nhập nội dung",
                    // image_location: "Chọn hình ảnh",
                    youtube: "Nhập link youtube",
                    map: "Nhập mã nhúng bản đổ",
                    keywords: "Nhập Keywords",
                    width: "Nhập Width",
                    height: "Nhập Height",
                    link_more: "Nhập liên kết"
                },
                submitHandler: function (form) {
                    var data = $(form).serializeArray();
                    // if ($('.object_relationship_list tbody tr').length == 0) {
                    //     malert('Vui lòng thêm ' + $object.name);
                    //     return false;
                    // }
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        ajax_loading(false);
                        console.log()
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            // location.reload();
                        } else if (data.errors) {
                            $.each(data.errors, function (key, msg) {
                                $('#' + key + '-error').html(msg).show();
                            });
                        }
                    });
                    return false;
                }
            });

            $('#frm_add_item').validate({
                ignore: ".ignore",
                rules: {
                    images_title: "required",
                },
                messages: {
                    images_title: "Nhập tiêu đề",
                },
                submitHandler: function (form) {
                    var flag1 = $("#images_title").valid();
                    var flag2 = $("#images_link").valid();
                    var flag3 = $("#images_ordering").valid();
                    var flag4 = $("#images_image_location").valid();

                    var flag5 = true;
                    if($("#images_title_link").length > 0){
                        var flag5 = $("#images_title_link").valid();
                    }

                    var flag6 = true;
                    if($("#images_image_child_location").length > 0){
                        var flag6 = $("#images_image_child_location").valid();
                    }

                    if (flag1 && flag2 && flag3 && flag4 && flag5 && flag6) {
                        var image_location = $('#frm_add_item #images_image_location').val();
                        var image_url = $('#frm_add_item #images_image_url').val();
                        var is_change_image = 0;
                        if ($('#is_change_image_item').val()>0) {
                            image_url = _base_url+'/';
                            is_change_image = 1;
                        }
                        var title = $('#frm_add_item #images_title').val();
                        var subtitle = $('#frm_add_item #images_subtitle').val();
                        var title_en = $('#frm_add_item #images_title_en').val();
                        var link = $('#frm_add_item #images_link').val();
                        var ordering = $('#frm_add_item #images_ordering').val();
                        var description = $('#images_description_adminnifty').val();
                        var description_en = $('#images_description_adminnifty_en').val();

                        var image_child_location = '';
                        var image_child_url = '';
                        var title_link = '';
                        var title_link_en = '';
                        if($("#images_image_child_location").length > 0){
                            image_child_location = $('#frm_add_item #images_image_child_location').val();
                            image_child_url = $('#frm_add_item #images_image_child_url').val();
                            var is_change_image_child = 0;
                            if ($('#is_change_image_child_item').val()>0) {
                                image_child_url = _base_url+'/';
                                is_change_image_child = 1;
                            }
                        }

                        if($("#images_title_link").length > 0){
                            title_link = $('#frm_add_item #images_title_link').val();
                        }
                        if($("#images_title_link_en").length > 0){
                            title_link_en = $('#frm_add_item #images_title_link_en').val();
                        }

                        setHtmlImageList(title, subtitle,link, ordering, image_location, image_url, description, is_change_image,title_link,image_child_url,image_child_location,is_change_image_child,title_en,description_en,title_link_en);
                        $("#images_title").val('');
                        $("#images_title_en").val('');
                        $("#images_link").val('');
                        $("#images_ordering").val('');
                        $("#images_image_location").val('');
                        $('#images_description_adminnifty').val('');
                        $('#images_description_adminnifty_en').val('');
                        $("#images-preview-banner").attr('src', _base_url + '/images/default.png');
                        $('#images_progress .progress-bar').css('width', '0%');

                        $("#images_title_link").val('');
                        $("#images_title_link_en").val('');
                        $("#images_image_child_location").val('');
                        $("#images-child-preview-banner").attr('src', _base_url + '/images/default.png');
                        $('#images_image_child_progress .progress-bar').css('width', '0%');


                        $('#frm_add_item #images_item').val(0);
                        $('#frm_add_item .label-action').text('Thêm mới');
                        $('#modalAddItem').modal('hide');
                    }

                    return false;
                }
            });
            console.log($position_image);
            if ($position_image && $('#frm_update_all .object_relationship_list').length > 0) {
                $.each($position_image, function (k, v) {
                    var title_en = '';
                    var description_en = '';
                    var title_link_en = '';
                    if(v.locale_en){
                        title_en  = v.locale_en.title;
                        description_en  = v.locale_en.description;
                        title_link_en  = v.locale_en.title_link;
                    }
                    var title_vi = '';
                    var subtitle_vi = '';
                    var description_vi = '';
                    var title_link_vi = '';
                    if(v.locale_vi){
                        title_vi  = v.locale_vi.title;
                        subtitle_vi  = v.locale_vi.subtitle;
                        description_vi  = v.locale_vi.description;
                        title_link_vi  = v.locale_vi.title_link;
                    }
                    setHtmlImageList(title_vi,subtitle_vi, v.link, v.ordering, v.image_location, v.image_url, description_vi, 0, title_link_vi,v.image_child_url, v.image_child_location,0,title_en,description_en,title_link_en);
                });
            }

            $(document).on('click', '.cancel_position_image', function () {
                $("#images_title").val('');
                $("#images_link").val('');
                $("#images_ordering").val('');
                $("#images_image_location").val('');
                $('#images_description_adminnifty').val('');
                $("#frm_add_item .preview-image-position-image").attr('src', _base_url + '/images/default.png');

                $("#images_image_child_location").val('');
                $("#images_title_link").val('');

                $('#frm_add_item #images_item').val(0);
                $('#frm_add_item .label-action').text('Thêm mới');
            });

            $(document).on('click', '.edit_position_images', function () {
                var item = $(this).data('item');
                var tr = $('.item_' + item);
                var image_location = tr.find('.position_images_image_location').val();
                var image_url = tr.find('.position_images_image_url').val();

                var image_child_location = tr.find('.position_images_image_child_location').val();
                var image_child_url = tr.find('.position_images_image_child_url').val();

                $("#images_title").val(tr.find('.position_images_title').val());
                //
                $('#images_description_adminnifty').val(tr.find('.position_images_description').val());
                //
                $("#images_subtitle").val(tr.find('.position_images_subtitle').val());
                $("#images_title_en").val(tr.find('.position_images_title_en').val());
                $("#images_link").val(tr.find('.position_images_link').val());
                $("#images_ordering").val(tr.find('.home_positions_objects_ordering').val());
                $("#images_image_location").val(image_location);
                $("#frm_add_item #images_image_url").val(image_url);
                $('#is_change_image_item').val(tr.find('.is_change_image').val());

                $("#images_image_child_location").val(image_child_location);
                $("#images_image_child_url").val(image_child_url);
                $('#is_change_image_child_item').val(tr.find('.is_change_image_child').val());
                $("#images_title_link").val(tr.find('.position_images_title_link').val());
                $("#images_title_link_en").val(tr.find('.position_images_title_link_en').val());


                $("#frm_add_item .preview-image-position-image").attr('src', image_url + image_location);
                $("#frm_add_item .preview-banner").attr('src', image_url + image_location);

                $("#frm_add_item #images-child-preview-banner").attr('src', image_child_url + image_child_location);

                $('#frm_add_item #images_item').val(item);
                $('#frm_add_item .label-action').text('Cập nhật');
                $('#modalAddItem').modal('show');
            });

            function setHtmlImageList2() {
                var image_location = $('#frm_update_all #images_image_location').val();
                var title = $('#frm_update_all #images_title').val();
                var link = $('#frm_update_all #images_link').val();
                var ordering = $('#frm_update_all #images_ordering').val();
                var description = $('#frm_update_all #images_description_adminnifty').val();
                var images_category_id = 0;
                if ($('#frm_update_all #images_category_id').length > 0) {
                    images_category_id = $('#frm_update_all #images_category_id').val();
                }
                var item = $.now();
                var html = '<div class="row item">';
                html += '<div class="col-md-5">';
                html += '<div class="image-upload">';
                html += '<label for="file-input">';
                html += '     <img class="" src="' + _base_url + image_location + '" alt=""/>';
                html += '     <input type="hidden" class="form-control image_location" placeholder="" value="' + image_location + '" name="position_images[' + item + '][image_location]">';
                html += '</label>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-md-6">';
                html += '    <div class="form-group">';
                html += '        <label for="">Tiêu đề</label>';
                html += '        <input type="text" class="form-control title" placeholder="" value="' + title + '" name="position_images[' + item + '][title]">';
                html += '    </div>';
                html += '    <div class="form-group">';
                html += '        <label for="">Liên kết</label>';
                html += '        <input type="text" class="form-control" placeholder="" value="' + link + '" name="position_images[' + item + '][link]">';
                html += '    </div>';
                html += '        <div class="form-group">';
                html += '            <label for="">Thứ tự</label>';
                html += '            <input type="number" class="form-control" placeholder="" value="' + ordering + '" name="position_images[' + item + '][ordering]" min="0">';
                html += '        </div>';
                html += '<div class="form-group">';
                html += '            <label for="">Mô tả</label>';
                html += '            <textarea class="form-control description" rows="3" name="position_images[' + item + '][description]">' + description + '</textarea>';
                html += '';
                html += '        </div>';
                html += '</div>';
                html += '<input type="hidden" name="position_images[' + item + '][images_category_id]" value="' + images_category_id + '">';
                html += '<div class="col-md-1">';
                html += '    <a href="javascript:void(0)" onclick="$(this).closest(\'.row.item\').remove()"><span class="glyphicon glyphicon-remove"></span></a>';
                html += '</div>';
                html += '</div>';

                if (images_category_id) {
                    $('#frm_update_all .list_images' + images_category_id).prepend(html);
                } else {
                    $('#frm_update_all .list_images').prepend(html);
                }

            }

            function setHtmlImageList(title,subtitle, link, ordering, image_location, image_url, description, is_change_image,title_link,image_child_url,image_child_location,is_change_image_child,title_en,description_en,title_link_en) {
                var item = $.now();
                var is_change_image = is_change_image || 0;
                var image_child_url = image_child_url || '';
                var image_child_location = image_child_location || '';
                var is_change_image_child = is_change_image_child || 0;
                var title_link = title_link || '';
                var title_en = title_en || '';
                var description_en = description_en || '';
                var title_link_en = title_link_en || '';

                var html = '<tr class="item item_' + item + '"><td scope="row" class="stt">1</td>';
                html += '<td><span>' + title + '</span></td>';
                html += '<td><img class="" src="' + image_url + image_location + '" alt=""/>';

                if(image_child_location){
                    html += ' <img class="" src="' + image_child_url + image_child_location + '" alt=""/>';
                }

                html +='</td>';
                html += '<td><input type="number" name="position_images[' + item + '][ordering]" class="form-control media-res home_positions_objects_ordering" value="' + ordering + '"></td>';
                html += '<td><a class="edit_position_images" href="javascript:void(0)" data-item="' + item + '"><span class="glyphicon glyphicon-edit"></span><a class="remove_object_relation" href="javascript:void(0)"><span class="glyphicon glyphicon-trash"></span></a></td>';
                html += '<input type="hidden" class="position_images_title" value="' + title + '" name="position_images[' + item + '][locales][vi][title]">';
                html += '<input type="hidden" class="position_images_subtitle" value="' + subtitle + '" name="position_images[' + item + '][locales][vi][subtitle]">';
                html += '<input type="hidden" class="position_images_image_url" value="' + image_url + '" name="position_images[' + item + '][image_url]">';
                html += '<input type="hidden" class="position_images_image_location" value="' + image_location + '" name="position_images[' + item + '][image_location]">';
                html += '<input type="hidden" class="is_change_image" value="' + is_change_image + '" name="position_images[' + item + '][is_change_image]">';
                html += '<input type="hidden" class="position_images_link" value="' + link + '" name="position_images[' + item + '][link]">';
                html += '<input type="hidden" class="position_images_description" value="" name="position_images[' + item + '][locales][vi][description]">';

                html += '<input type="hidden" class="position_images_image_child_url" value="' + image_child_url + '" name="position_images[' + item + '][image_child_url]">';
                html += '<input type="hidden" class="position_images_image_child_location" value="' + image_child_location + '" name="position_images[' + item + '][image_child_location]">';
                html += '<input type="hidden" class="is_change_image_child" value="' + is_change_image_child + '" name="position_images[' + item + '][is_change_image_child]">';
                html += '<input type="hidden" class="position_images_title_link" value="' + title_link + '" name="position_images[' + item + '][locales][vi][title_link]">';

                // html += '<input type="hidden" class="position_images_title_en" value="' + title_en + '" name="position_images[' + item + '][locales][en][title]">';
                // html += '<input type="hidden" class="position_images_description_en" value="" name="position_images[' + item + '][locales][en][description]">';
                // html += '<input type="hidden" class="position_images_title_link_en" value="' + title_link_en + '" name="position_images[' + item + '][locales][en][title_link]">';

                html += '</tr>';
                var item_old = $('.object_relationship_list .item_' + $('#images_item').val());
                if (item_old.length > 0) {
                    item_old.replaceWith(html);
                } else {
                    $('.object_relationship_list tbody').append(html);
                    $('.object_relationship_list').show();
                }
                $('.item_' + item + ' .position_images_description').val(description);
                $('.item_' + item + ' .position_images_description_en').val(description_en);
                $('.object_relationship_list').show();
                setSttObjectRelation();
            }

            function setHtmlObjectRelation(id, text) {
                var item = $.now();
                var ordering = getMaxOrderingObjectRelation();
                var html = '<tr>';
                html += '<td scope="row" class="stt"></td>';
                html += '    <td>';
                html += '        <input type="hidden" name="home_positions_objects[' + item + '][object_id]" value="' + id + '">';

                html += '    <span>' + text + '</span></td>';
                html += '    <td><input type="number" name="home_positions_objects[' + item + '][ordering]" class="home_positions_objects_ordering" value="' + ordering + '"></td>';
                html += '    <td><a class="remove_object_relation" href="javascript:void(0)"><span class="glyphicon glyphicon-trash"></span></a></td>';
                html += '</tr>';

                $('.object_relationship_list tbody').append(html);
                $('.object_relationship_list').show();
                setSttObjectRelation();
            }

            function setSttObjectRelation() {
                var stt = 1;
                $('.object_relationship_list tbody tr').each(function () {
                    $(this).find('.stt').html(stt);
                    stt++;
                });
            }

            function getMaxOrderingObjectRelation() {
                var max = 0;
                $('.object_relationship_list .home_positions_objects_ordering').each(function () {
                    if ($(this).val() > max) {
                        max = $(this).val();
                    }
                });
                return parseInt(max) + 1;
            }
        });
    </script>
@stop
