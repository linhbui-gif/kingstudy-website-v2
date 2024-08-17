<div class="row" style="margin-left:6px">
    <div class="col-md-7">
        <div class="form-group">
            <select name="country_id" id="country_id" class="form-control select2">
                <option value="">--Chọn quốc gia--</option>
                @php
                    $countries = \Modules\Admin\Entities\Country::where('status', 1)->get();
                @endphp
                @foreach($countries as $k => $country)
                    @php
                        $selected = $country->id == @$object->country_id ? 'selected' :'';
                    @endphp
                    <option {{$selected}} value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>

    </div>

</div>
