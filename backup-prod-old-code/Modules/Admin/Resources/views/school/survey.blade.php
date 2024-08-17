<div class="row" id="table-course">
    <h4>Các tiêu chí khảo sát</h4>
    <div class="col-md-6">
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <label class="col-sm-3 control-label" for="form-field-1">
                Điểm học THPT <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="number" min="1" max="10" 
                class="form-control" name="survey_mark_thpt" value="{{@$object['survey_mark_thpt']}}"
                id="survey_mark_thpt" placeholder="Nhập điểm tối thiểu ">
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <div class="table-course-item">
            <label class="col-sm-3 control-label" for="form-field-1">
                Điểm học Đại học <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="number" min="1" max="10" 
                class="form-control" name="survey_mark_dh" value="{{@$object['survey_mark_dh']}}"
                id="survey_mark_dh" placeholder="Nhập điểm tối thiểu ">
            </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <div class="table-course-item">
            <label class="col-sm-3 control-label" for="form-field-1">
                Điểm học Thạc sĩ <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="number" min="1" max="10" 
                class="form-control" name="survey_mark_ts" value="{{@$object['survey_mark_ts']}}"
                id="survey_mark_ts" placeholder="Nhập điểm tối thiểu ">
            </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <div class="table-course-item">
            <label class="col-sm-3 control-label" for="form-field-1">
                Điểm học chuyển tiếp <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="number" min="1" max="10" 
                class="form-control" name="survey_mark_ct" value="{{@$object['survey_mark_ct']}}"
                id="survey_mark_ct" placeholder="Nhập điểm tối thiểu ">
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <label class="col-sm-3 control-label" for="form-field-1">
                Điểm GPA <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="number" min="1" max="10" 
                class="form-control" name="survey_mark_gpa" 
                id="survey_mark_gpa" value="{{@$object['survey_mark_gpa']}}"
                placeholder="Nhập điểm tối thiểu ">
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <label class="col-sm-3 control-label" for="form-field-1">
                IELTS <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="number" min="1" max="10" 
                class="form-control" name="survey_mark_ielts" value="{{@$object['survey_mark_ielts']}}"
                id="survey_mark_ielts" placeholder="Nhập điểm tối thiểu ">
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 50px;" >
            <label class="col-sm-3 control-label" for="form-field-1">
                Học phí <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" 
                name="survey_tuition" id="survey_tuition" value="{{number_format(@$object['survey_tuition'])}}" >
            </div>
        </div>
        <div class="col-sm-12" style="margin-bottom: 50px;" >
            <div class="row">
                <label class="col-sm-3 control-label" for="form-field-1">
                    Thời gian khai giảng
                    <span class="required"></span>
                </label>
                <div class="col-sm-9">
                    <a href="" class="btn btn-success" id="add_opening_time"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="row">
                <label for="" class="col-sm-3 control-label"><span class="required"></span></label>
                <div class="col-sm-8">
                    <div class="row" id="container_opening_time">
                        @if(isset($object['opening_time']))
                            @foreach($object['opening_time'] as $time)
                            <div class="col-sm-4 opening_time_item" style="margin-top:10px;">
                                <input type="number" min="1" max="12" name="opening_time[]" value="{{$time}}" 
                                 class="form-control" placeholder="Tháng khai giảng">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>