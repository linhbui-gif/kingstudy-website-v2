<div id="tab1" class="tabcontent active" style="display: block;">
    
    <div class="block part_create">
        <form id="add_images">
        <h4 class="title-block">Hình ảnh đại diện</h4>
        <div class="body-block block-logo">
            <div class="col-md-6">
                <div class="image-upload">
                    <label for="file-input">
                        <img class="preview-image-main" src="<?=!empty($object['image_location'])?$object['image_url'].$object['image_location']:'/html/cms/assets/images/img_upload.png'?>" alt=""/>

                        <div class="wrap-bg" style="display: none;">
                            <img class="display btn-loadfile browse-image" src="{{url('/html/cms/assets/images/icon-camera.png')}}" data-target="image_location" alt="your image">
                        </div>
                    </label>
                    <input type="hidden" id="image_url" >
                    <input type="hidden"id="image_location" name="image_location" data-preview="#add_images .preview-image-main" data-url="#image_url">
                </div>
                <div class="infor-img">
                    <b class="red note">Lưu ý:</b>
                    @if ($landing_page_id==1)
                        <span class="size-note">Hình 1 Kích thước: <b>263 x 263 px</b></span>
                    @else
                        <span class="size-note">Hình 1 Kích thước: <b>360 x 440 px</b></span>
                        <span class="size-note">Hình còn lại Kích thước: <b>360 x 205 px</b></span>
                    @endif
                    <span class="size-note">Dung lượng: <b>350kb</b></span>
                    <span class="size-note">Định dạng: <b>jpg, jpeg, png</b></span>
                </div> 
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" id="title" class="form-control" placeholder="" name="title">
                </div>
                <div class="form-group">
                    <label for="">Liên kết</label>
                    <input type="text" id="link" class="form-control" placeholder="" name="link">
                </div>
                <div class="form-group">        
                    <label for="">Mô tả</label>        
                    <textarea class="form-control" rows="3" id="description" name="description"></textarea>   
                </div>
                <div class="form-group">
                    <label for="">Thứ tự</label>
                    <input type="number" id="ordering" class="form-control" placeholder="" name="ordering" min="0">
                </div>
            </div>
        </div>
        <div class="action text-right">                          
            <button id="add_images" type="submit" class="btn button-update BtnUpdate" >Thêm</button>
        </div>
        </form>
        <form id="frm_update_images" action="<?=route('admin::landing-page-position.store-position-images')?>">
            <div class="body-block list_images">
                @if(!empty($objects))
                @foreach($objects as $key => $item)
                <?php $key_id = 'p'.$key; ?>
                <div class="row item">
                    <div class="col-md-5">
                        <div class="image-upload">
                            <label for="file-input">     
                                <img class="" src="<?=$item['image_url'].$item['image_location']?>" alt="">     
                                <input type="hidden" class="form-control image_location" placeholder="" value="<?=$item['image_location']?>" name="position_images[<?=$key_id?>][image_location]">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group">        
                            <label for="">Tiêu đề</label>        
                            <input type="text" class="form-control title" placeholder="" value="<?=$item['title']?>" name="position_images[<?=$key_id?>][title]">    
                        </div>    
                        <div class="form-group">        
                            <label for="">Liên kết</label>        
                            <input type="text" class="form-control" placeholder="" value="<?=$item['link']?>" name="position_images[<?=$key_id?>][link]">    
                        </div>
                        <div class="form-group">        
                            <label for="">Mô tả</label>        
                            <textarea class="form-control" rows="3" name="position_images[<?=$key_id?>][description]"><?=$item['description']?></textarea>   
                        </div>
                        
                        <div class="form-group">        
                            <label for="">Thứ tự</label>        
                            <input type="number" class="form-control" placeholder="" value="<?=$item['ordering']?>" name="position_images[<?=$key_id?>][ordering]" min="0">    
                        </div>
                    </div>
                    <div class="col-md-1">    
                        <a href="javascript:void(0)" onclick="$(this).closest('.row.item').remove()"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="action text-right">
                <input type="hidden" name="landing_page_position_id" value="<?=$position_id?>">
                <span class="cancel Cancel" onclick="location.reload()">Hủy bỏ</span>
                <button type="submit" class="btn button-update BtnUpdate" >Cập nhật thông tin</button>
            </div>
        </form>
    </div>
    

    
</div>
