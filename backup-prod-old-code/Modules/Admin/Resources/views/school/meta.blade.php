    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label class="col-sm-3 control-label"  for="slug">Slug: </label>
                <div class="col-sm-9">
                    <input type="text" name="slug" id="slug" class="form-control"
                       placeholder="Slug sẽ được tạo tự động theo tên trường" disabled
                       value="{{@$object['slug']}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="keywords">Keywords: <span class="required"></span></label>
                <div class="col-sm-9">
                    <input type="text" name="keywords" id="keywords" class="form-control"
                       placeholder="Nhập keyword cách nhau bởi dấu phẩy"
                       value="{{@$object['keywords']}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="meta_title">Meta title: <span class="required"></span></label>
                <div class="col-sm-9">
                    <input type="text" name="meta_title" id="meta_title" class="form-control"
                       placeholder=""
                       value="{{@$object['meta_title']}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="meta_description">Meta description: <span class="required"></span></label>
                <div class="col-sm-9">
                    <input name="meta_description" id="meta_description" cols="10" rows="5" class="form-control"
                    value="{{ @$object['meta_description'] }}">
                </div>
            </div>
{{--            <div class="form-group">--}}
{{--                <label class="col-sm-2 control-label" for="form-field-1"> <strong>--}}
{{--                        Thumbnail SEO <span class="required"></span></strong>--}}
{{--                </label>--}}
{{--                <div class="col-sm-8 btn-file">--}}
{{--            <span class="btn btn-sm btn-success btn-rounded fileinput-button">--}}
{{--              <i class="fa fa-folder-open-o"></i>--}}
{{--              <span>Chọn hình...</span>--}}
{{--              <input id="fileupload_meta_thumbnail" type="file" name="files[]"--}}
{{--                     onchange="uploadLoadFile(event, 'preview-meta_thumbnail')" accept="image/*"--}}
{{--                     data-location="#image_location_meta_thumbnail" data-error="#image_location_meta_thumbnail-error"--}}
{{--                     data-is-change="#is_change_image_meta_thumbnail" data-object="home"--}}
{{--                     data-progress="#progress_meta_thumbnail .progress-bar">--}}
{{--            </span>--}}
{{--                    <div style="clear: both;"></div>--}}
{{--                    <div id="progress_meta_thumbnail" class="progress" style="margin-top: 10px;">--}}
{{--                        <div class="progress-bar progress-bar-success"></div>--}}
{{--                    </div>--}}
{{--                    <p><img id="preview-meta_thumbnail" width="200"--}}
{{--                            src="{{ isset($object['meta_thumbnail'])?url($object['meta_thumbnail']):'/images/default.png' }}"/>--}}
{{--                    </p>--}}
{{--                    <input id="image_location_meta_thumbnail" type="hidden" name="image_location_meta_thumbnail"value="{{@$object['meta_thumbnail']}}">--}}
{{--                    <input id="is_change_image_meta_thumbnail" type="hidden" name="is_change_image_meta_thumbnail" value="0">--}}
{{--                    <label id="image_location_meta_thumbnail-error" class="error" for="image_location_meta_thumbnail"style="display: none;"></label>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
