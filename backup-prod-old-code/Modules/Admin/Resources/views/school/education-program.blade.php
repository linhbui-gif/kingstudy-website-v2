<div class="row">
    <div class="col-sm-12">
        <h3>Block: Campus</h3>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                Content <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("program[college]", @$object['program']->college, ['class' => 'form-control' , "id" => "college"]) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <h3>Block: Accommodation</h3>
        <div class="form-group">
            <label class="col-sm-12" for="form-field-1">
                Content <span class="required"></span>
            </label>
            <div class="col-sm-12">
                {!! Form::textarea("program[after_college]", @$object['program']->after_college, ['class' => 'form-control' , "id" => "after_college"]) !!}
            </div>
        </div>
    </div>
{{--    <div class="col-sm-12">--}}
{{--        <div class="form-group">--}}
{{--            <label class="col-sm-12" for="form-field-1">--}}
{{--                    Tóm tắt chương trình học: <span class="required"></span>--}}
{{--            </label>--}}
{{--            <div class="col-sm-12">--}}
{{--                {!! Form::textarea("summary_study_program", @$object['summary_study_program'], ['class' => ' form-control']) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
            <div class="form-group">
                <label class="col-sm-12 " for="form-field-1">
                        Tóm tắt cơ sở vật chất: <span class="required"></span>
                </label>
                <div class="col-sm-12">
                    {!! Form::textarea("summary_infrastructure", @$object['summary_infrastructure'], ['class' => ' form-control']) !!}
                </div>
            </div>
</div>
