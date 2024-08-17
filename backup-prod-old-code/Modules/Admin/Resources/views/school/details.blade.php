<div class="row">
    <div class="col-md-12">
         <h3>Block: About</h3>
         <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                Content
                <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("about", @$object['about'], ['class' => ' form-control']) !!}
                <label id="about-error" class="error"
                for="about">{!! $errors->first("about") !!}</label>
            </div>
        </div>
     </div>
    <div class="col-md-12">
        <h3>Block: Thông tin nổi bật</h3>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                Content <span class="required"></span>
            </label>
            <div class="row">
                @if(!empty($object['featured']))
                    @foreach($object['featured'] as $k => $item)
                        <div class="col-sm-4" style="margin-bottom: 10px;">
                            {!! Form::text("featured[$k]", $item, ['class' => ' form-control' , "id" => "featured"]) !!}
                        </div>
                    @endforeach
                @else
                    @foreach([0,1,2,3,4,5] as $k => $item)
                        <div class="col-sm-4" style="margin-bottom: 10px;">
                            {!! Form::text("featured[$k]", '', ['class' => ' form-control' , "id" => "featured"]) !!}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                    Tóm tắt thông tin nổi bật: <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("summary_highlight_infor", @$object['summary_highlight_infor'], ['class' => ' form-control']) !!}
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="col-md-12">
        <h3>Block: Chương trình hoc</h3>
        <div class="form-group">
            <label class="col-sm-12 " for="form-field-1">
                Content <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("infrastructure", @$object['infrastructure'], ['class' => ' form-control' , "id" => "infrastructure"]) !!}
                <label id="infrastructure-error" class="error"
                       for="infrastructure">{!! $errors->first("infrastructure") !!}</label>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-sm-12" for="form-field-1">
                    Tóm tắt chương trình học: <span class="required"></span>
                </label>
                <div class="col-sm-12">
                    {!! Form::textarea("summary_study_program", @$object['summary_study_program'], ['class' => ' form-control']) !!}
                </div>
            </div>
        </div>
{{--        <div class="form-group">--}}
{{--            <label class="col-sm-12 " for="form-field-1">--}}
{{--                    Tóm tắt chương trình giảng dạy: <span class="required"></span>--}}
{{--            </label>--}}
{{--            <div class="col-sm-12">--}}
{{--                {!! Form::textarea("summary_infrastructure", @$object['summary_infrastructure'], ['class' => ' form-control']) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    {{-- City --}}
     <div class="col-md-12">
        <h3>Block: Thành phố</h3>
        <div class="form-group">
            <label class="col-sm-12 " for="form-field-1">
                Title <span class="required"></span>
            </label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name='map[title]' value="{{@$object['map']->title}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12 " for="form-field-1">
                Iframe <span class="required"></span>
            </label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="map[iframe]" value="{{@$object['map']->iframe}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12 " for="form-field-1">
                Content <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("map[content]", @$object['map']->content, ['class' => ' form-control' , "id" => "map"]) !!}
                <label id="map-error" class="error"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12 " for="form-field-1">
                Link Map <span class="required"></span>
            </label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="map[link]" value="{{@$object['map']->link}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                    Tóm tắt thành phố: <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("summary_city", @$object['summary_city'], ['class' => ' form-control']) !!}
            </div>
        </div>
    </div>
</div>
