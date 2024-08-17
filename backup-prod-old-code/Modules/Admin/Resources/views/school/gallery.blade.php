<div class="row" id="container_gallery">
    <h4>Thư viện ảnh: </h4>
    <div class="col-md-12">
        <button class="btn btn-success btn-rounded" id="add_image_gallery">Thêm hình ảnh</button>
    </div>
    @if(isset($object['gallery']) && !empty($object['gallery']))
        @foreach($object['gallery'] as $k => $gallery)
        <div class="col-md-3 gallery_item" id="gallery_item_{{$k}}" style="margin-top:30px;">
            <div class="col-sm-8 btn-file">
            <span class="btn btn-sm btn-success btn-rounded fileinput-button">
              <i class="fa fa-folder-open-o"></i>
              <span>Chọn hình...</span>
              <input id="fileupload_{{$k}}" type="file" name="files[]"
                     onchange="uploadLoadFile(event, 'preview-gallery-{{$k}}')" accept="image/*"
                     data-is-change="#is_change_image_gallery_{{ $k }}"
                     data-location="#image_location_gallery_{{$k}}" data-error="#{{$k}}-error" data-object="home" data-progress="#progress-{{$k}} .progress-bar">
            </span>
                <div style="clear: both;"></div>
                <div id="progress-{{$k}}" class="progress" style="margin-top: 10px;">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <p><img id="preview-gallery-{{$k}}" width="200" src="{{$object['gallery'][$k]['image'] ?? "" }}"/>
                </p>
                <input id="is_change_image_gallery_{{$k}}" type="hidden" name="gallery[{{$k}}][is_change_image]" value="0">
                <input id="image_location_gallery_{{$k}}" type="hidden" name="gallery[{{$k}}][image]" value="{{$object['gallery'][$k]['image'] ?? ""}}">
            </div>
            <a href="javascript:void(0)" onclick="javascript:del_item(this,'.gallery_item')"><i style="font-size:18px;" class=" fa fa-trash text-danger" aria-hidden="true"></i></a>
        </div>
        @endforeach
    @endif
</div>


