    @include('admin::includes.js-upload-image')
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <!-- iCheck -->
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>
    <link href="/html/plugins/switchery/switchery.min.css" rel="stylesheet">
    <script src="/html/plugins/switchery/switchery.min.js"></script>
    @include('admin::includes.js-ckeditor')
    {{-- Feedback --}}
    @if(isset($object['feed_back']))
        @foreach($object['feed_back'] as $k  => $feedback)
         <script type="text/javascript">
                initUpload('#fileupload_feedback_{{$k}}')
        </script>
        @endforeach
    @endif
    @if(isset($object['gallery']))
        @foreach($object['gallery'] as $k  => $gallery)
         <script type="text/javascript">
                initUpload('#fileupload_{{$k}}')
            </script>
        @endforeach
    @endif
    {{--  --}}
    <script type="text/javascript">
        function del_item(element,parent){
           let parent_ = $(element).parents(parent);
            parent_.remove();
        }
        $(document).ready(function () {
            let value_answer = $('#value_answer').val();
            $('body textarea').ckeditor();
            init_select2('.select2');
            init_datepicker("#birthday", "dd-mm-yyyy");
            initUpload('#fileupload_logo');
            // initUpload('#fileupload_meta_thumbnail');
            initUpload('#fileupload_icon');
            initUpload('#fileupload_gallery');
            // Formatnumber
            $("#survey_tuition").on('keyup', function(){
                let number = formatNumberInput($(this).val());
                $(this).val(number);
            });
            function formatNumberInput(n) {
              return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
            // get_provinces('.province');
            $('.province.change').on('change', function () {
                get_districts_by_province($(this));
            });
            $('.district_change').on('change', function () {
                get_wards_by_district($(this));
            });

            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif
            //
            let count_ = 0;
            $('#btn_add_item').click(function(e) {
                e.preventDefault();
                let items = $(".scholarship_item").length + 1 ;
                $("#container_scholarship").append(`
                    <div class="scholarship_item">
                     <div class="form-group">
                     <a href="javascript:void(0)" onclick="javascript:del_item(this,'.scholarship_item')"><i style="font-size:18px;" class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                 </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="form-field-1">Title <span class="required"></span></label>
                            <div class="col-sm-12">
                            <input name="scholarship[hocbong_`+items+`][title]" id="" class="form-control"/>
                            <label id="scholarship_title-error" class="error"for="scholarship">
                            {!! $errors->first("scholarship") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="form-field-1">Link học bổng<span class="required"></span></label>
                            <div class="col-sm-12">
                            <input name="scholarship[hocbong_`+items+`][link]" id="" class="form-control"/>
                            <label id="scholarship_link-error" class="error"for="scholarship">
                            {!! $errors->first("scholarship") !!}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="form-field-1">Content <span class="required"></span></label>
                            <div class="col-sm-12">
                            <textarea class="form-control summernote add_summer" name="scholarship[hocbong_`+items+`][content]" id="" cols="50" rows="10">
                            </textarea>
                            <label id="scholarship_content-error" class="error"for="scholarship_content">
                            {!! $errors->first("scholarship") !!}</label>
                            </div>
                        </div>
                    </div>`)
                let value_answer = $('#value_answer').val();
                $('.add_summer').ckeditor();

            })
            //
            // Required
            $('#btn_add_item_required').click(function(e) {
                e.preventDefault();
                let items = $(".input_required_item").length + 1 ;
                $("#container_input_requierd").append(`
                <div class="input_required_item">
                <div class="form-group">
                <label class="col-sm-3 control-label" for="form-field-1">
                Title<span class="required"></span>
                </label><div class="col-sm-9">
                <input name="required[yeucau_`+items+`][title]" id="" class="form-control">
                <label id="required_title-error" class="error" for="required">
                   {!! $errors->first("required") !!}
                </label>
                </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label" for="form-field-1">
                Content
                <span class="required">
                </span>
                </label>
                <div class="col-sm-9">
                <textarea class="form-control add_summer_required" name="required[yeucau_`+items+`][content]" id="" cols="50" rows="10"></textarea>
                <label id="required_content-error" class="error" for="required_content">{!! $errors->first("required") !!}</label>
                </div>
                </div>
                 <a href="javascript:void(0)" onclick="javascript:del_item(this,'.input_required_item')"><i style="font-size:18px;" class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                </div>
                `)
                let value_required = $('#value_answer').val();
                $('.add_summer_required').ckeditor();
            })
            //
            var url = '<?=route('upload-temp')?>?object=user-avatar';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                done: function (e, data) {
                    if (data['result']['error']) {
                        $('#image_location-error').html(data['result']['error']);
                        $('#image_location').val("");
                        return false;
                    }
                    $('#avatar-error').html('');
                    $.each(data.result.files, function (index, file) {
                        $('#image_location').val(file.name);
                        $('#is_change_image').val(1);
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');

            $('#frm-add').validate({
                ignore: ".ignore",
                rules: {
                    // name: "required",
                    // heading: "required",
                    'number_info[]': "required",
                    // about: "required",
                    // featured: "required",
                    // infrastructure: "required",
                    // "map[title]": 'required',
                    // "map[content]": 'required',
                    // "map[iframe]": 'required',
                    // "map[link]": 'required',
                    // 'program[college]':'required',
                    // 'program[after_college]':'required',
                    // 'tuition[tuition]':'required',
                    // 'tuition[request]': 'required',
                    'courses[]':'required',
                    'majors[]': 'required',
                    'levels[]' : 'required',
                    'rankings[]' : 'required',
                    // 'image_location': 'required',
                    // 'image_location_logo':'required',
                    // 'image_location_icon':'required',
                    // 'survey_mark_gpa':'required',
                    // 'survey_mark_dh':'required',
                    // 'survey_mark_ts':'required',
                    // 'survey_mark_ct':'required',
                    // 'survey_mark_thpt':'required',
                    // 'survey_mark_ielts':'required',
                    // 'survey_tuition':'required',
                },
                messages: {
                    // name: "Not empty",
                    // heading: "Not empty",
                    'number_info[]': "Not empty",
                    // "map[title]": 'Not empty',
                    // "map[content]": 'Not empty',
                    // "map[iframe]": 'Not empty',
                    // "map[link]": 'Not empty',
                    // about: "Not empty",
                    // featured: "Not empty",
                    // infrastructure: "Not empty",
                    // 'program[college]':'Not empty',
                    // 'program[after_college]':'Not empty',
                    // 'tuition[tuition]':'Not empty',
                    // 'tuition[request]': 'Not empty',
                    'courses[]':'Not empty',
                    'majors[]': 'Not empty',
                    'levels[]' : 'Not empty',
                    'rankings[]' : 'Not empty',
                    // 'image_location': 'Not empty',
                    // 'image_location_logo':'Not empty',
                    // 'image_location_icon':'Not empty',

                },
                submitHandler: function (form) {
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        ajax_loading(false);
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            console.log(res.redirect_url);
                            if (res.redirect_url) {
                                location.href = res.redirect_url;
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
        // Feed back
        let check = 0;
        //let item   = document.querySelector('#container_feedback div:last-child');
        let item = $('#container_feedback').children('.feedback_item').last()
        check = $(item).attr('id');
        if(check) {
            check = check.replace(/\D/g, '');
        }
        $('#add_feed_back').click(function(e) {
            e.preventDefault();
            let index_feedback = 0;
                   index_feedback  = $('.feedback_item').length + 1;
            if(check > 0) {
                index_feedback  =  Number(check) + 1;
            }
            let html = `<div class="col-md-3 feedback_item" style="margin-top:30px;">
                            <div class="feedback_item_img form-group">
                                <div class="col-sm-8 btn-file">
                                <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                                  <i class="fa fa-folder-open-o"></i>
                                  <span>Chọn hình...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                  <input id="fileupload_feedback_`+index_feedback+`" type="file" name="files[]"
                                        data-is-change="#is_change_image_feed_back_`+index_feedback+`"
                                         onchange="uploadLoadFile(event, 'preview-feedback-`+index_feedback+`')" accept="image/*"
                                         data-location="#image_feed_back_`+index_feedback+`" data-error="#image_feed_back_`+index_feedback+`-error"data-object="home" data-progress="#progress-`+index_feedback+` .progress-bar">
                                </span>
                                    <div style="clear: both;"></div>
                                    <div id="progress-`+index_feedback+`" class="progress" style="margin-top: 10px;">
                                        <div class="progress-bar progress-bar-success"></div>
                                    </div>
                                    <p><img id="preview-feedback-`+index_feedback+`" width="200"src=""/>
                                    </p>
<input id="is_change_image_feed_back_`+index_feedback+`" type="hidden" name="feed_back[`+index_feedback+`][is_change_image]" value="0">
                                    <input id="image_feed_back_`+index_feedback+`" type="hidden" name="feed_back[`+index_feedback+`][image] "value="">
                                </div>
                                <a href="javascript:void(0)" onclick="javascript:del_item(this,'.feedback_item')"><i style="font-size:18px;" class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                            </div>
                            <div class='feedback_item_infor'>
                                <div class="form-group">
                                    <label class=" control-label " for="form-field-1">
                                        Name <span class="required"></span>
                                    </label>
                                    <div >
                                        <input type="text" class="form-control" value="" name="feed_back[`+index_feedback+`][name]" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label " for="form-field-1">
                                        Content <span class="required"></span>
                                    </label>
                                    <div >
                                        <input name="feed_back[`+index_feedback+`][content]" type="text" class="form-control" value="" style="min-height:18px;" />
                                    </div>
                                </div>
                            </div>
                        </div>`
            $('#container_feedback').append(html);
            initUpload('#fileupload_feedback_'+index_feedback);
            index_feedback++;
            check ++;
        })
        // End
        {{-- Gallery --}}
        let item_2  = $('#container_gallery').children('.gallery_item').last()
        let check_2 = $(item_2).attr('id');
        if(check_2) {
            check_2 = check_2.replace(/\D/g, '');
        }
        $('#add_image_gallery').click(function(e) {
            e.preventDefault();
            let index_gallery = 0;
                index_gallery   = $('.gallery_item').length + 1;
            if(check_2 > 0 ) {
                index_gallery   = Number(check_2) + 1;
            }
            let html = `<div class="col-md-3 gallery_item" style="margin-top:30px;">
                            <div class="col-sm-8 btn-file">
                            <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                              <i class="fa fa-folder-open-o"></i>
                              <span>Chọn hình...</span>
                                <!-- The file input field used as target for the file upload widget -->
                              <input id="fileupload_`+index_gallery+`" type="file" name="files[]"
                                    data-is-change="#is_change_image_gallery_`+index_gallery+`"
                                     onchange="uploadLoadFile(event, 'preview-gallery-`+index_gallery+`')" accept="image/*"
                                     data-location="#image_location_gallery_`+index_gallery+`" data-error="#image_location_gallery_`+index_gallery+`-error"data-object="home" data-progress="#progress-`+index_gallery+` .progress-bar">
                            </span>
                                <div style="clear: both;"></div>
                                <div id="progress-`+index_gallery+`" class="progress" style="margin-top: 10px;">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <p><img id="preview-gallery-`+index_gallery+`" width="200"src=""/>
                                </p>
<input id="is_change_image_gallery_`+index_gallery+`" type="hidden" name="gallery[`+index_gallery+`][is_change_image]" value="0">
                                <input id="image_location_gallery_`+index_gallery+`" type="hidden" name="gallery[`+index_gallery+`][image] "value="">
                            </div>
                            <a href="javascript:void(0)" onclick="javascript:del_item(this,'.gallery_item')"><i style="font-size:18px;" class="del_gallery_item fa fa-trash text-danger" aria-hidden="true"></i></a>
                        </div>`
            $('#container_gallery').append(html);
            initUpload('#fileupload_'+index_gallery);
            index_gallery++;
            check_2++;
        })
        {{-- Number info --}}
        $('#add_number_info').click(function(e) {
            e.preventDefault();
            let items = $(".number_info_item").length + 1 ;
            let number = `<div class="form-group number_info_item">
                                <div class="col-md-12">
                                    <label class="col-sm-3 control-label" for="form-field-1">
                                        Title <span class="required"></span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class='form-control' name="number_info[`+items+`][title]"/>
                                        <label id="number_info-error" class="error"
                                               for="number_info">{!! $errors->first("number_info") !!}</label>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="javascript:void(0)" onclick="javascript:del_item(this,'.number_info_item')"><i style="font-size:18px; margin-left:18px"class=" fa fa-trash text-danger" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-sm-3 control-label" for="form-field-1">
                                        Number <span class="required"></span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" class='form-control' name="number_info[`+items+`][number]"/>
                                        <label id="number_info-error" class="error"
                                               for="number_info">{!! $errors->first("number_info") !!}</label>
                                    </div>
                                </div>
                            </div>`;
                $('#container_number_').append(number);
        })
        // Opening time
        $('#add_opening_time').click(function(e) {
            e.preventDefault();
            let items = $(".opening_time_item").length + 1 ;
            let opening_item = `<div class="col-sm-4 opening_time_item" style="margin-top:10px;">
                                    <input min ="1" max="12"
                                    type="number" name="opening_time[]" class="form-control" placeholder="Tháng khai giảng">
                                </div>`;
            $('#container_opening_time').append(opening_item);
        })
        });
        get_country("#country_id");
        $('#country_id').on('change', function () {
            get_city_by_country($(this));
        });
        function get_country(destination) {
            destination = destination || '#country_id';
            var id = $(destination).attr('data-id');

            $.get(_base_url+'/admin/location/get-country', function (res) {
                var html = '<option value="">Chọn quốc gia</option>';
                $.each(res.data, function( id, name ) {
                    html += '<option value="'+id+'">'+name+'</option>';
                });
                $(destination).html(html).val(id).trigger('change');
            }, 'json');
        }

        function get_city_by_country(obj_country, select2) {
            var select2 = select2 || false;
            var destination = $(obj_country).attr('data-destination');
            var id = $(destination).attr('data-id');

            $.get('/admin/location/get-city', {province_id: $(obj_country).val()}, function (res) {
                var html = '<option value="">Chọn thành phố</option>';
                $.each(res.data, function( id, name ) {
                    html += '<option value="'+id+'">'+name+'</option>';
                });
                $(destination).html(html).val(id).trigger('change');


            }, 'json');
        }
    </script>
