@php
$countries       = \Modules\Admin\Entities\Country::select('id','name')->get()->toArray();
$courses       = \Modules\Admin\Entities\Course::select('id','name')->get()->toArray();
$levelcourses  = \Modules\Admin\Entities\LevelCourse::select('id','name')->get()->toArray();
$majors        = \Modules\Admin\Entities\Majors::select('id','name')->get()->toArray();
$rankings      = \Modules\Admin\Entities\Ranking::select('id','name')->get()->toArray();
$cities      = \Modules\Admin\Entities\City::select('id','name')->get()->toArray();

@endphp
 <div class="FilterInformation">
      <div class="container">
        <div class="FilterInformation-wrapper">
          <div class="FilterInformation-title">Tìm kiếm khóa học</div>
          <form class="FilterInformation-form flex flex-wrap" id="search_school" action="{{route('search_school')}}">
            <div class="FilterInformation-form-item">
              <div class="Select middle bordered">
                <select data-id="{{ @$_GET['country'] }}" class="Select-control" name="country" id="search_country" data-destination="#province_id">
                    <option value="">Quốc gia</option>
                </select>
                <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
              </div>
            </div>
            <div class="FilterInformation-form-item">
              <div class="Select middle bordered">
                <select data-id="{{ @$_GET['province'] }}" class="Select-control" name="province" id="province_id">
                  <option value="">Bang/ thành phố</option>
                </select>
                <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
              </div>
            </div>
            <div class="FilterInformation-form-item">
              <div class="Select middle bordered">
                <select class="Select-control" name='levelcourse' id="search_levelcourse">
                  <option value="">Bậc học</option>
                  @if(isset($levelcourses))
                    @foreach($levelcourses as $levelcourses)
                        <option value="{{$levelcourses['id']}}">{{$levelcourses['name']}}</option>
                    @endforeach
                  @endif
                </select>
                <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
              </div>
            </div>
            <div class="FilterInformation-form-item">
              <div class="Select middle bordered">
                <select class="Select-control" name='ranking' id="search_ranking">
                  <option value="">Ranking</option>
                  @if(isset($rankings))
                    @foreach($rankings as  $ranking)
                        <option value="{{$ranking['id']}}">{{$ranking['name']}}</option>
                    @endforeach
                  @endif
                </select>
                <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
              </div>
            </div>
            <div class="FilterInformation-form-item">
              <div class="Select middle bordered">
                <select class="Select-control" name='survey_tuition' id="search_course">
                  <option value="">Học phí</option>
{{--                  @if(isset($courses))--}}
{{--                    @foreach($courses as  $course)--}}
{{--                        <option value="{{$course['id']}}">{{$course['name']}}</option>--}}
{{--                    @endforeach--}}
{{--                  @endif--}}
                    <option value="499000000">Dưới 500 triệu đồng</option>
                    <option value="600000000">Từ 500 triệu đồng đến 1 tỉ đồng</option>
                    <option value="1000000000">Trên 1 tỉ đồng</option>
                </select>
                <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
              </div>
            </div>
            <div class="FilterInformation-form-item">
              <div class="Select middle bordered">
                <select class="Select-control" name='majors' id="search_majors">
                  <option value="">Ngành học</option>
                   @if(isset($majors))
                    @foreach($majors as  $major)
                        <option value="{{$major['id']}}">{{$major['name']}}</option>
                    @endforeach
                    @endif
                </select>
                <div class="Select-arrow"> <img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
              </div>
            </div>
            <div class="FilterInformation-form-item expand">
              <div class="Input middle bordered">
                <input class="Input-control" type="text" placeholder="Nội dung tìm kiếm" name='keywords_' id="search_keywords_">
              </div>
            </div>
            <div class="FilterInformation-form-item submit">
              <div class="Button middle bordered" data-modal-id="">
                <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Tìm kiếm</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
