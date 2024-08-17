<?php
    $dataEdit = '';
    $fieldTopLeft = @$fieldTopName . '[' . @$modify_name . ']' . '[heading]' . '[' . $fieldTopName . '_heading_title_left]';
    $fieldTopRight = @$fieldTopName . '[' . @$modify_name . ']' . '[heading]' . '[' . $fieldTopName . '_heading_title_right]';
    $groupArr = [];
    if(isset($object[$fieldTopName]) && $object[$fieldTopName] !== null && isset($object[$fieldTopName]->$modify_name)) {
        $dataEdit = $object[$fieldTopName]->$modify_name;
        $keyHeading_left = $fieldTopName . '_heading_title_left';
        $keyHeading_right = $fieldTopName . '_heading_title_right';
        if(isset($dataEdit->group)) $groupArr = (array)($dataEdit->group);
    }
    ?>
<div class="col-sm-6">
    <h3>Heading left</h3>
    {!! Form::text($fieldTopLeft, @$dataEdit->heading->$keyHeading_left, ['class' => 'form-control' , "id" => $fieldTopName . "_heading_title_left"]) !!}
</div>
<div class="col-sm-6">
    <h3>Heading right</h3>
    {!! Form::text($fieldTopRight, @$dataEdit->heading->$keyHeading_right, ['class' => ' form-control' , "id" => $fieldTopName . "_heading_title_right"]) !!}
</div>
<div class="col-sm-6">
    <div class="form-group mt-3">
        <label class="col-sm-2 control-label " for="form-field-1">
            Add content
            <span class="required"></span>
        </label>
        <div class="col-sm-3 mt-3"  data-slug="{{$modify_name}}">
            <a href="javascript:void(0)" class="btn btn-success {{$id_button}}" id="{{$id_button}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
        </div>
    </div>
    <div id="{{$container}}">
        @if(!empty($groupArr) && isset($dataEdit))
            @foreach($groupArr as $k => $item)
                <div class="form-group {{$fieldTopName}}_info_item" data-index="{{$k}}">
                    <div class="col-md-6">
                        <label class="col-sm-3 control-label" for="form-field-1">
                            Title <span class="required"></span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class='form-control' name="{{$fieldTopName}}[{{@$modify_name}}][group][{{$k}}][title]" value="{{@$item->title}}" />
                            <label id="tution_info-error" class="error"
                                   for="tution_info">{!! $errors->first("_info") !!}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-3 control-label" for="form-field-1">
                            Content <span class="required"></span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class='form-control' name="{{@$fieldTopName}}[{{@$modify_name}}][group][{{$k}}][content]" value="{{$item->content}}"/>
                            <label id="{{@$fieldTopName}}_info-error" class="error"
                                   for="{{@$fieldTopName}}_info">{!! $errors->first("_info") !!}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
