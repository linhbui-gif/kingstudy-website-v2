<div class="row" style="margin-left:6px">
    <div class="col-md-7">
        <div class="form-group">
            <select name="tintuc_id" id="tintuc_id" class="form-control select2">
                <option value="">--Chọn danh mục bài viết--</option>
                @php
                    $categories = \Modules\Admin\Entities\CategoryNew::where('status', 1)->where('is_deleted',0)->get();
                @endphp
                @foreach($categories as $k => $category)
                    @php
                        $selected = $category->id == @$object->tintuc_id ? 'selected' :'';
                    @endphp
                    <option {{$selected}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

    </div>

</div>
