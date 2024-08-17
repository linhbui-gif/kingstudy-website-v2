<div class="row">
    <div class="col-md-7">
        <div class="form-group">
        <label class="col-sm-3 control-label" for="name">
            Tên trường <span class="required"></span></label>
        <div class="col-sm-9">
            {!! Form::text("name", @$object['name'],
                ["id" => "name", 'class' => 'form-control', 'placeholder' => "Nhập tên trường"]) !!}
            <label id="name-error" class="error" for="name">{!! $errors->first("name") !!}</label>
        </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="name">
                Video Url <span class="required"></span></label>
            <div class="col-sm-9">
                {!! Form::text("video_url", @$object['video_url'],
                    ["id" => "video_url", 'class' => 'form-control', 'placeholder' => "Nhập video tổng quan"]) !!}
                <label id="video_url-error" class="error" for="video_url">{!! $errors->first("video_url") !!}</label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="name">
                Price <span class="required"></span></label>
            <div class="col-sm-9">
                {!! Form::text("price", @$object['price'],
                    ["id" => "price", 'class' => 'form-control', 'placeholder' => "Nhập giá"]) !!}
                <label id="price-error" class="error" for="video_url">{!! $errors->first("price") !!}</label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="heading">
                Heading <span class="required"></span>
            </label>
            <div class="col-sm-9">
                {!! Form::text("heading", @$object['heading'], ['class' => 'form-control', 'placeholder' => "Nhập heading"]) !!}
                <label id="heading-error" class="error"
                       for="heading">{!! $errors->first("heading") !!}
               </label>
            </div>
        </div>
        <div class="col-md-12" id="container_number_">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="form-field-1">
                    Number Info
                    <span class="required"></span>
                </label>
                <div class="col-sm-1">
                    <a href="" class="btn btn-success" id="add_number_info"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            @if(isset($object['number_info']))
                @foreach($object['number_info'] as $k => $number)
                <div class="form-group number_info_item">
                    <div class="col-md-12">
                        <label class="col-sm-3 control-label" for="form-field-1">
                            Title <span class="required"></span>
                        </label>
                        <div class="col-sm-8">
                            {!! Form::text("number_info[$k][title]",$number['title'], ['class' => 'form-control']) !!}
                            <label id="number_info-error" class="error"
                                   for="number_info">{!! $errors->first("number_info") !!}</label>
                        </div>
                        <a href="javascript:void(0)" onclick="javascript:del_item(this,'.number_info_item')"><i style="font-size:18px; margin-left:18px"class=" fa fa-trash text-danger" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-12">
                        <label class="col-sm-3 control-label" for="form-field-1">
                            Number <span class="required"></span>
                    </label>
                    <div class="col-sm-8">
                        {!! Form::number("number_info[$k][number]",$number['number'], ['class' => 'form-control']) !!}
                        <label id="number_info-error" class="error"
                               for="number_info">{!! $errors->first("number_info") !!}</label>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="name">
                Ngành học: <span class="required"></span></label>
            <div class="col-sm-9">
                <select name="majors[]" class="select_course form-control select2" multiple>
                    @foreach($majors as $major)
                        @if(isset($object))
                            @php
                                $selected = in_array($major['id'], $object['majors']) ? 'selected': '';
                            @endphp
                        @endif
                        <option {{@$selected}}  value="{{$major['id']}}">{{$major['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="name">
                Bậc học: <span class="required"></span></label>
            <div class="col-sm-9">
                <select name="levels[]" class="select_course form-control select2" multiple>
                    @foreach($levels as $level)
                        @if(isset($object))
                            @php
                                $selected = in_array($level['id'], $object['levels']) ? 'selected': '';
                            @endphp
                        @endif
                        <option {{@$selected}}  value="{{$level['id']}}">{{$level['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="name">
                Ranking: <span class="required"></span></label>
            <div class="col-sm-9">
                <select name="rankings[]" class="select_course form-control select2" multiple>
                    @foreach($rankings as $ranking)
                        @if(isset($object))
                            @php
                                $selected = in_array($ranking['id'], $object['rankings']) ? 'selected': '';
                            @endphp
                        @endif
                        <option {{@$selected}}  value="{{$ranking['id']}}">{{$ranking['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="form-field-1">Type: </label>
            <?php
            for($i= 1 ; $i <=3 ; $i++) {
            ?>
            <div class="col-sm-3">
                <div class="row">
                    <label class="col-sm-3 control" style="padding-right: 20px; margin: 7px">
                        @if($i == 1) Close @elseif($i ==2) Partner @else Available @endif
                    </label>
                    <div class="col-sm-9">
                        <input class="flat" type="radio" name="type_school" value="{{$i}}" <?=@$object['type_school'] == $i ? 'checked' : ''?>>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label" style="padding-top: 10px">
                    Index
                </label>
                <div class="col-sm-9">
                    <?php
                    $index = (isset($object) && $object['is_index'] == '1') || !isset($object) ? 1 : 0;
                    ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="is_index" value="1"
                                   class="minimal-red" {{$index==1?'checked':''}}> Index

                        </label>
                        <label>
                            <input type="radio" name="is_index" value="0"
                                   class="minimal-red" {{$index==0?'checked':''}}> No index

                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label" for="form-field-1">
                    <span class="required"></span>
                </label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-sm-12" for="form-field-1">
                                Country
                            </label>
                            <select name="country_id" id="country_id" class="form-control" data-id="{{ @$object['country_id'] }}" data-destination="#province_id">
                                <option value="">--Select Country--</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-12" for="form-field-1">
                                Thành phố/Bang
                            </label>
                            <select name="province_id" id="province_id" class="form-control" data-id="{{ @$object['province_id'] }}">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="form-field-1">
                    Tóm tắt thông tin chung: <span class="required"></span>
            </label>
            <div class="col-md-9">
                {!! Form::textarea("summary_general_infor", @$object['summary_general_infor'], ['class' => ' form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-5">
        {{-- Banner --}}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                    Banner <span class="required"></span></strong>
            </label>
            <div class="col-sm-8 btn-file">
            <span class="btn btn-sm btn-success btn-rounded fileinput-button">
              <i class="fa fa-folder-open-o"></i>
              <span>Chọn hình...</span>
                <!-- The file input field used as target for the file upload widget -->
              <input id="fileupload" type="file" name="files[]"
                     onchange="uploadLoadFile(event, 'preview-banner')" accept="image/*"
                     data-location="#image_location" data-error="#image_location-error"
                     data-is-change="#is_change_image" data-object="home"
                     data-progress="#progress .progress-bar">
            </span>
                <div>
                    <span class="size-note">Kích thước: <b class="size">470 x 570 px</b></span>
                    <span class="size-note">Dung lượng: <b class="file_size">500kb</b></span>
                    <span class="size-note">Định dạng: <b class="file_type">jpg, png</b></span>
                </div>
                <div style="clear: both;"></div>
                <div id="progress" class="progress" style="margin-top: 10px;">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <p><img id="preview-banner" width="200"
                        src="{{ isset($object['banner'])?url($object['banner']):'/images/default.png' }}"/>
                </p>
                <input id="image_location" type="hidden" name="image_location"value="{{@$object['banner']}}">
                <input id="is_change_image" type="hidden" name="is_change_image" value="0">
                <label id="image_location-error" class="error" for="image_location"style="display: none;"></label>
            </div>
        </div>
        {{-- Logo --}}
          <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-1"> <strong>
                    Logo <span class="required"></span></strong>
            </label>
            <div class="col-sm-8 btn-file">
            <span class="btn btn-sm btn-success btn-rounded fileinput-button">
              <i class="fa fa-folder-open-o"></i>
              <span>Chọn hình...</span>
              <input id="fileupload_logo" type="file" name="files[]"
                     onchange="uploadLoadFile(event, 'preview-logo')" accept="image/*"
                     data-location="#image_location_logo" data-error="#image_location_logo-error"
                     data-is-change="#is_change_image_logo" data-object="home"
                     data-progress="#progress_logo .progress-bar">
            </span>
                <div style="clear: both;"></div>
                <div id="progress_logo" class="progress" style="margin-top: 10px;">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <p><img id="preview-logo" width="200"
                       src="{{ isset($object['logo'])?url($object['logo']):'/images/default.png' }}"/>
                </p>
                <input id="image_location_logo" type="hidden" name="image_location_logo"value="{{@$object['logo']}}">
                <input id="is_change_image_logo" type="hidden" name="is_change_image_logo" value="0">
                <label id="image_location_logo-error" class="error" for="image_location_logo"style="display: none;"></label>
            </div>
        </div>
        {{--  --}}
    </div>
</div>
