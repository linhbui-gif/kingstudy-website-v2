<form id="frm_update_all" action="<?=route('admin::landing-page-position.store-all')?>">
    <div class="panel panel-bordered-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin cơ bản</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                @include('admin::landing-page.fields-basic')
            </div>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->

    <div class="panel panel-bordered-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i> Danh sách <?=strtolower($object['name'])?>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modalAddItem">
                        <i class="fa fa-plus" aria-hidden="true"></i>Thêm mới</button>
                </div>
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <table class="table table-striped object_relationship_list">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Thứ tự</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->

    <div class="panel-footer text-center">
        <input type="hidden" name="landing_page_position_id" value="<?=$position_id?>">

        <button type="reset" class="cancel Cancel btn btn-default btn-rounded" onclick="location.reload()">
            <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
        </button>

        <button type="submit" class="btn button-update BtnUpdate btn btn-primary btn-rounded">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin Block
        </button>
    </div>
</form>

<div id="modalAddItem" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="frm_add_item">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="label-action">Thêm mới brochure</span></h4>
                </div>
                <div class="modal-body">
                    <div id="frm_update_position_image" class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="title-block">Tiêu đề - Tiếng Việt</h4>
                                <input type="text" id="images_title" name="images_title" class="form-control"
                                       placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <h4 class="title-block">Tiêu đề - Tiếng Anh</h4>
                                <input type="text" id="images_title_en" name="images_title_en" class="form-control"
                                       placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <h4 class="title-block">Thứ tự</h4>
                                <input type="number" id="images_ordering" name="images_ordering" class="form-control"
                                       placeholder="" value="">
                            </div>

                            <div class="form-group">
                                <h4 class="title-block">Tên tập tin - Tiếng Việt</h4>
                                <input type="text" class="form-control" id="images_title_link" name="images_title_link" value="">
                            </div>
                            <div class="form-group">
                                <h4 class="title-block">Tên tập tin - Tiếng Anh</h4>
                                <input type="text" class="form-control" id="images_title_link_en" name="images_title_link_en" value="">
                            </div>

                            <div class="form-group">
                                <h4 class="title-block">Link liên kết</h4>
                                <input type="text" class="form-control" id="images_link" name="images_link" value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="title-block" for="form-field-1"> <strong>
                                            Hình Banner <span class="required"></span></strong>
                                    </label>
                                    <div class="btn-file">
                                        <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                                          <i class="fa fa-folder-open-o"></i>
                                          <span>Chọn hình...</span>
                                            <!-- The file input field used as target for the file upload widget -->
                                          <input id="fileuploadItems" type="file" name="files[]"
                                                 onchange="uploadLoadFile(event, 'images-preview-banner')" accept="image/*"
                                                 data-location="#images_image_location" data-error="#images_image_location-error" data-object="home"
                                                 data-is-change="#is_change_image_item"
                                                 data-progress="#images_progress .progress-bar">
                                        </span>
                                        <div>
                                            <span class="size-note">Kích thước: <b class="size"><?=!empty($position_type['item_image'])?$position_type['item_image']:'1924 x 450'?> px</b></span>
                                            <span class="size-note">Định dạng: <b class="file_type">jpg, png</b></span>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <!-- The global progress bar -->
                                        <div id="images_progress" class="progress" style="margin-top: 10px;">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <p><img id="images-preview-banner" width="200" class="preview-banner"
                                                src="{{ isset($id)?url($object['image_url'].$object['image_location']):'/images/default.png' }}"/>
                                        </p>


                                        <input type="hidden" name="images_image_url" id="images_image_url" value="">
                                        <input type="hidden" name="is_change_image_item" id="is_change_image_item" value="0">
                                        <input type="hidden" value="" name="images_image_location"
                                               id="images_image_location"
                                               data-preview=".preview-image-position-image" data-url="#images_image_url">

                                        <label id="image_location-error" class="error" for="image_location"
                                               style="display: none;"></label>
                                    </div>
                                </div>
                            </div>

                            @if($position_type['item_image_child'])
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="title-block" for="form-field-1"> <strong>
                                                Hình Banner phụ <span class="required"></span></strong>
                                        </label>
                                        {{--<h4 class="title-block"> Hình Banner <span class="required"></span></h4>--}}
                                        <div class="btn-file">
                                            <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                                              <i class="fa fa-folder-open-o"></i>
                                              <span>Chọn hình...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                              <input id="fileuploadChildItems" type="file" name="files[]"
                                                     onchange="uploadLoadFile(event, 'images-child-preview-banner')" accept="image/*"
                                                     data-location="#images_image_child_location" data-error="#images_image_child_location-error" data-object="about-us"
                                                     data-is-change="#is_change_image_child_item"
                                                     data-progress="#images_image_child_progress .progress-bar">
                                            </span>
                                            <div>
                                                <span class="size-note">Kích thước: <b class="size"><?=!empty($position_type['item_image_child'])?$position_type['item_image_child']:'1924 x 450'?> px</b></span>
                                                <span class="size-note">Định dạng: <b class="file_type">jpg, png</b></span>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <!-- The global progress bar -->
                                            <div id="images_image_child_progress" class="progress" style="margin-top: 10px;">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <p><img id="images-child-preview-banner" width="200" class="preview-banner"
                                                    src="/images/default.png"/>
                                            </p>


                                            <input type="hidden" name="images_image_child_url" id="images_image_child_url" value="">
                                            <input type="hidden" name="is_change_image_child_item" id="is_change_image_child_item" value="0">
                                            <input type="hidden" value="" name="images_image_child_location"
                                                   id="images_image_child_location"
                                                   data-preview="#images-child-preview-banner" data-url="#images_image_child_url">
                                            <label id="images_image_child_location-error" class="error" for="images_image_child_location"
                                                   style="display: none;"></label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="images_item" id="images_item" value="0">
                    <button type="reset" data-dismiss="modal"
                            class="cancel cancel_position_image btn btn-default btn-rounded">
                        <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
                    </button>

                    <button type="submit"
                            class="btn btn-primary btn-rounded">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin brochure</button>
                </div>
            </form>
        </div>
    </div>
</div>





