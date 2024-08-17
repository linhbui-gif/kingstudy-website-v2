<div class="row">
    <div class="col-sm-12">
        <h4>Block: Yêu cầu</h4>
        <button id="btn_add_item_required" class="btn btn-success">
            Thêm yêu cầu
        </button>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                    Tóm tắt điều kiện đầu vào: <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("summary_required", @$object['summary_required'], ['class' => ' form-control']) !!}
            </div>
        </div>
    </div>
     <div class="col-sm-12" id="container_input_requierd">
        @if(isset($object['required']))
            <?php $id  = 0;?>
            @foreach($object['required'] as $k => $val )
            <?php $id++;?>
             <div class="input_required_item">
                 <div class="form-group">
                     <a href="javascript:void(0)" onclick="javascript:del_item(this,'.input_required_item')"><i style="font-size:18px;" class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                 </div>
                <div class="form-group">
                    <label class="col-sm-12" for="form-field-1">
                        Title <span class="required"></span>
                    </label>
                    <div class="col-sm-12">
                        <input type="text" data-id="{{@$object['id']}}" name ="required[{{$k}}][title]" value="{{$val['title']}}" class = 'form-control' , id = "required_title">
                        <label id="required_title-error" class="error"
                        for="required">{!! $errors->first("required") !!}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12" for="form-field-1">
                        Content <span class="required"></span>
                    </label>
                    <div class="col-sm-12">
                        <textarea type="text" name ="required[{{$k}}][content]" class = ' form-control' , id = "required_content">{{@$val['content']}}</textarea>
                        <label id="required_content-error" class="error"
                               for="required_content">{!! $errors->first("required") !!}</label>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
