@if($position_type['is_title'])
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h4 class="title-block">Tiêu đề <span class="required"></span></h4>
                    <input type="text" id="title" name="locales[vi][title]" class="form-control" placeholder=""
                           value="<?=@$object['locale_vi']['title']?>">
                </div>
            </div>
        </div>
    </div>
@endif

@if($position_type['is_link_more'])
    <div class="col-md-12">
        <div class="form-group">
            <h4 class="title-block">Liên kết xem thêm <span class="required"></span></h4>
            <input type="text" id="link_more" name="link_more" class="form-control" placeholder=""
                   value="<?=$object['link_more']?>">
        </div>
    </div>
@endif

@if($position_type['is_description'])
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nội dung <span class="required"></span></label>
                    <textarea class="form-control" name="locales[vi][description]" id="description" cols="30" rows="5"
                              placeholder="Nhập nội dung"><?=@$object['locale_vi']['description']?></textarea>
                    <label id="description-error" class="error" for="description" style="display: none;">Nhập nội dung</label>
                </div>
            </div>
        </div>
    </div>
@endif

@if($position_type['is_content'])
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nội dung <span class="required"></span></label>
                    <textarea class="form-control ckeditor" name="locales[vi][content]" id="content" cols="30" rows="5"
                              placeholder="Nhập nội dung"><?=@$object['locale_vi']['content']?></textarea>
                    <label id="content-error" class="error" for="content" style="display: none;">Nhập nội dung</label>
                </div>
            </div>
        </div>
    </div>
@endif

@if($position_type['is_youtube'])
    <div class="block block-video col-md-12">
        <h4 class="title-block">Video giới thiệu</h4>
        <div class="wp-input">
            <div class="form-group">
                <label for="">Link URL Youtube</label>
                <input type="text" id="youtube" name="youtube" class="form-control" placeholder=""
                       value="<?=$object['youtube']?>">
            </div>
            @if($position_type['is_width'])
                <div class="form-group box_input">
                    <label for="">Width (px)</label>
                    <input type="text" name="width" id="width" class="form-control" placeholder=""
                           value="<?=$object['width']?>">
                </div>
            @endif
            @if($position_type['is_height'])
                <div class="form-group box_input">
                    <label for="">Height (px)</label>
                    <input type="text" name="height" id="height" class="form-control" placeholder=""
                           value="<?=$object['height']?>">
                </div>
            @endif
        </div>
    </div>
@endif

@if($position_type['is_map'])
    <div class="block col-md-12">
        <div class="form-group">
            <h4 class="title-block">Mã nhúng bản đồ</h4>
            <textarea class="form-control" name="map" id="map" placeholder="Nhập mã nhúng bản đồ"
                      rows="5"><?=$object['map']?></textarea>
        </div>
    </div>
@endif

@if($position_type['is_keywords'])
    <div class="block col-md-6">
        <div class="form-group">
            <h4 class="title-block">Keywords</h4>
            <input type="text" name="keywords" id="keywords" class="form-control"
                   placeholder="Nhập keyword, cách nhau bởi dấu phẩy" value="<?=$object['keywords']?>">
        </div>
    </div>
@endif

<div class="col-md-6">
    <div class="form-group">
        <h4 class="title-block"> Trạng thái</h4>
        <div class="col-sm-9">
            <?php
            $status = old('status', @$object['status']);
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

@if($position_type['is_image'])
    <div class="col-md-6">
        <div class="row">
            <div class="form-group">
                <label class="col-sm-2 control-label title-block" for="form-field-1">
                    Hình ảnh đại diện <span class="required"></span>
                </label>

                <div class="col-sm-8 btn-file">
                    <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                      <i class="fa fa-folder-open-o"></i>
                      <span>Chọn hình...</span>
                        <!-- The file input field used as target for the file upload widget -->
                      <input id="fileupload" type="file" name="files[]"
                             onchange="uploadLoadFile(event, 'preview-image-main')" accept="image/*"
                             data-location="#image_location" data-error="#image_location-error"
                             data-is-change="#is_change_image" data-object="home"
                             data-progress="#progress .progress-bar">
                    </span>
                    <div>
                        <span class="size-note">Kích thước: <b class="size"><?=$position_type['is_image']?> px</b></span>
                        <span class="size-note">Định dạng: <b class="file_type">jpg, png</b></span>
                    </div>
                    <div style="clear: both;"></div>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress" style="margin-top: 10px;">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>

                    <p><img id="preview-image-main" width="200" class="preview-image-main"
                            src="{{ !empty($object['image_location'])?url($object['image_url'].$object['image_location']):'/images/default.png' }}" onerror="this.src='/images/default.png'" />
                    </p>

                    <input type="hidden" name="is_change_image" id="is_change_image" value="0">
                    <input type="hidden" name="images_image_url" id="images_image_url" value="<?=@$object['image_url']?>">
                    <input type="hidden" value="<?=@$object['image_location']?>" name="image_location"
                           id="image_location"
                           data-preview=".preview-image-position-image" data-url="#images_image_url">

                    <label id="image_location-error" class="error" for="image_location"
                           style="display: none;"></label>
                </div>
            </div>
        </div>
    </div>
@endif

<div style="clear: both;"></div>



