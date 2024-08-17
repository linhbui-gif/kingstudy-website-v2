<div class="row" id="table-course">
        <div class="col-md-9" style="margin-bottom: 50px;" >
            <h4>Block: Khóa học</h4>
            <div class="table-course-item">
            <label class="col-sm-3 control-label" for="form-field-1">
                Chọn khóa học <span class="required"></span>
            </label>
            <div class="col-sm-9">
                <select name="courses[]" class="select_course form-control select2" multiple>
                    @foreach($courses as $course)
                        @if(isset($object['courses']))
                        @php
                        $selected = in_array($course['id'], $object['courses']) ? 'selected': '';
                        @endphp
                        @endif
                        <option {{@$selected}} value="{{$course['id']}}">{{$course['name']}}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>
</div>