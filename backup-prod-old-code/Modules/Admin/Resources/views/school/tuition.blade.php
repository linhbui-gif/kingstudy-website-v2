<div class="row">
    <div class="col-sm-12">
        <h3>Block: Học phí</h3>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                Đại học <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("tuition[tuition]", @$object['tuition']->tuition, ['class' => ' form-control' , "id" => "tuition"]) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                Sau đại học <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("tuition[request]", @$object['tuition']->request, ['class' => ' form-control' , "id" => "tuition_request"]) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                    Tóm tắt block học phí: <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("summary_tuition", @$object['summary_tuition'], ['class' => ' form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-12" id="container_scholarship">
        <h3>Block: Học bổng</h3>
        <button id="btn_add_item" class="btn btn-success">
            Thêm học bổng
        </button>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                    Tóm tắt block học bổng: <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("summary_scholarship", @$object['summary_scholarship'], ['class' => ' form-control']) !!}
            </div>
        </div>
        @if(isset($object['scholarship']))
            <?php $id  = 0;?>
            @foreach($object['scholarship'] as $k => $val )
            <?php $id++;?>
             <div class="scholarship_item">
                 <div class="form-group">
                     <a href="javascript:void(0)" onclick="javascript:del_item(this,'.scholarship_item')"><i style="font-size:18px;" class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                 </div>
                <div class="form-group">
                    <label class="col-sm-12" for="form-field-1">
                        Title <span class="required"></span>
                    </label>
                    <div class="col-sm-12">
                        <input type="text" data-id="{{@$object['id']}}" name ="scholarship[{{$k}}][title]" value="{{$val['title']}}" class = 'form-control' , id = "scholarship_title">
                        <label id="scholarship_title-error" class="error"
                        for="scholarship">{!! $errors->first("scholarship") !!}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12" for="form-field-1">
                        Link học bổng <span class="required"></span>
                    </label>
                    <div class="col-sm-12">
                        <input type="text" data-id="{{@$object['id']}}" name ="scholarship[{{$k}}][link]" value="{{@$val['link']}}" class = 'form-control' id = "scholarship_link">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12" for="form-field-1">
                        Content <span class="required"></span>
                    </label>
                    <div class="col-sm-12">
                        <textarea type="text" name ="scholarship[{{$k}}][content]" class = ' form-control' id = "scholarship_content">{{@$val['content']}}</textarea>
                        <label id="scholarship_content-error" class="error"
                               for="scholarship_content">{!! $errors->first("scholarship") !!}</label>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

    </div>
</div>
