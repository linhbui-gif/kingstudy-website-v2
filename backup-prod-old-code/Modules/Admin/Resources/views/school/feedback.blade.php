<div class="row" id="container_feedback">
    <h4>Feed Back: </h4>
    <div class="col-sm-12">
        <button class="btn btn-success btn-rounded" id="add_feed_back">Thêm </button>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
        <label class="col-sm-12" for="form-field-1">
                Tóm tắt Feedback: <span class="required"></span>
        </label>
        <div class="col-sm-12">
            {!! Form::textarea("summary_feed_back", @$object['summary_feed_back'], ['class' => ' form-control']) !!}
        </div>
    </div>
    </div>
    @if(isset($object['feed_back']) && !empty($object['feed_back']))
        @foreach($object['feed_back'] as $k => $feedback)
        <div class="col-md-3 feedback_item" style="margin-top:30px;" id="feedback_item_{{$k}}">
            <div class="feedback_item_img form-group">
                <div class="col-sm-8 btn-file">
                <span class="btn btn-sm btn-success btn-rounded fileinput-button">
                  <i class="fa fa-folder-open-o"></i>
                  <span>Chọn hình...</span>
                  <input id="fileupload_feedback_{{$k}}" type="file" name="files[]"
                         data-is-change="#is_change_image_feed_back_{{ $k }}"
                         onchange="uploadLoadFile(event, 'preview-feedback-{{$k}}')" accept="image/*"
                         data-location="#image_feed_back_{{$k}}" data-error="#{{$k}}-error" data-object="home" data-progress="#progress-feedback-{{$k}} .progress-bar">
                </span>
                    <div style="clear: both;"></div>
                    <div id="progress-feedback-{{$k}}" class="progress" style="margin-top: 10px;">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <p><img id="preview-feedback-{{$k}}" width="200"src="{{$object['feed_back'][$k]['image']}}"/>
                    </p>
                    <input id="is_change_image_feed_back_{{$k}}" type="hidden" name="feed_back[{{$k}}][is_change_image]" value="0">
                    <input id="image_feed_back_{{$k}}" type="hidden" name="feed_back[{{$k}}][image]" value="{{$object['feed_back'][$k]['image']}}">
                </div>
                <a href="javascript:void(0)" onclick="javascript:del_item(this,'.feedback_item')"><i style="font-size:18px;"class=" fa fa-trash text-danger" aria-hidden="true"></i></a>
            </div>
            <div class='feedback_item_infor'>
                <div class="form-group">
                    <label class=" control-label " for="form-field-1">
                        Name <span class="required"></span>
                    </label>
                    <div >
                        <input type="text" class="form-control" value="{{$object['feed_back'][$k]['name']}}" name="feed_back[{{$k}}][name]" />
                    </div>
                </div>
                <div class="form-group">
                    <label class=" control-label " for="form-field-1">
                        Content <span class="required"></span>
                    </label>
                    <div >
                        <input name="feed_back[{{$k}}][content]" type="text" class="form-control" value="{{$object['feed_back'][$k]['content']}}" style="min-height:18px;" />
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>


