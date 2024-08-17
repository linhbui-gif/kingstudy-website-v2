@extends('front::layouts.master')
@php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
@endphp
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => @$detail['meta_title'],
        'meta_description' => @$detail['meta_description'],
        'link' => route('details_school',['slug' => $detail->slug]),
        'thumbnail' =>  config('app.url') . @$detail->banner,
        'robots' => @$detail->is_index
    ])

@stop
@section('content')
    <style>
        .table thead tr td {
            background-color: #22458f!important;
        }
    </style>
  @if(isset($detail))
  <div class="SchoolDetailPage">
      <div class="container">
        <div class="SchoolDetailPage-wrapper flex flex-wrap">
          <div class="SchoolDetailPage-wrapper-item">
            <div class="SchoolDetailPage-main page-section" id="gioithieu">
              <div class="SchoolDetailPage-image"> <img src="{{$detail->banner}}" alt=""></div>
              <div class="SchoolDetailPage-header flex items-center">
                <div class="SchoolDetailPage-header-logo"> <img src="{{$detail->logo}}" alt=""></div>
                <div class="SchoolDetailPage-header-info">
                  <h1 class="SchoolDetailPage-header-info-title flex items-center">
                     {{$detail->name}}
                  <span class="
            @if($detail['type_school'] == 3) {{'color_available'}} @elseif($detail['type_school'] == 2) {{ ' ' }} @else {{'color_close'}} @endif ">
                @if($detail['type_school'] == 3) {{'Available'}} @elseif($detail['type_school'] == 2) {{'Partner'}} @else {{'Close'}} @endif
                    </span>
                   </h1>
                  <p class="SchoolDetailPage-header-info-description">{{$detail->heading}}</p>
                </div>
              </div>
              {{-- Number info --}}
              <div class="SchoolDetailPage-numbers flex flex-wrap justify-around">
                @if(isset($detail['number_info']) && count($detail['number_info']))
                  @foreach($detail['number_info'] as $k => $number)
                  <div class="SchoolDetailPage-numbers-item">
                    <h6 class="SchoolDetailPage-numbers-item-title">{{$number['title']}}</h6>
                    <h5 class="SchoolDetailPage-numbers-item-description">{{str_replace('.',',',$number['number'])}}</h5>
                  </div>
                  @endforeach
                @endif
              </div>
              {{-- End --}}
              <div class="SchoolDetailPage-content style-content">
                {{-- About --}}
                {!! $detail['about']!!}
                {{-- Map --}}
                <h3 id="thanhpho" class="page-section">Thành phố</h3>
                {!! $detail['map']['iframe'] !!}
                <div class="SchoolDetailPage-card">
                  <div class="SchoolDetailPage-card-title">{{ $detail['map']['title'] }}</div>
                  <div class="SchoolDetailPage-card-row flex justify-between">
                    <div class="SchoolDetailPage-card-description">{!! $detail['map']['content'] !!}</div>
                    <a class="SchoolDetailPage-card-link flex items-center" href="{{ $detail['map']['link'] }}" target="_blank">
                      <img src="{{asset('frontend/assets/icons/icon-map-orange.svg')}}" alt="">Xem trên bản đồ</a>
                  </div>
                </div>
                {{-- End --}}
                {{-- Thông tin nổi bật --}}
                <h3 id="noibat" class="page-section">Các thông tin nổi bật</h3>
                  {!! $detail['featured'] !!}
                {{-- End --}}
                {{-- Chưởng trình giảng dạy --}}
                <h3 id="cosovatchat" class="page-section">Cơ sở vật chất</h3>
                <div class="Tab merge">
                  <div class="Tab-header flex">
                    <div class="Tab-header-item active">Campus</div>
                    <div class="Tab-header-item ">Accommodation</div>
                  </div>
                  <div class="Tab-main">
                    <div class="Tab-main-item">
                        {!! $detail['program']['college']!!}
                    </div>
                    <div class="Tab-main-item ">
                        {!! $detail['program']['after_college']!!}
                    </div>
                  </div>
                </div>
                {{-- End --}}
                <h3 id="chuongtrinh" class="page-section">Chương trình giảng dạy</h3>
                 <div class="csvc" style="max-height: 500px;overflow: auto;padding: 1rem;"> {!! $detail['infrastructure'] !!}</div>
                {{-- Học phí --}}
                <h3 id="hocphi" class="page-section">Học phí</h3>
                <div class="Tab merge">
                  <div class="Tab-header flex">
                    <div class="Tab-header-item active">Đại học</div>
                    <div class="Tab-header-item ">Sau đại học</div>
                  </div>
                  <div class="Tab-main">
                    <div class="Tab-main-item">
                      {!! $detail['tuition']['tuition'] !!}
                    </div>
                    <div class="Tab-main-item">
                      {!! $detail['tuition']['request'] !!}
                    </div>
                  </div>
                </div>
                {{-- End --}}
                {{-- Học bổng --}}
                <h3 id="hocbong" class="page-section">Học bổng</h3>
                <div style="max-height: 280px; overflow: auto; padding: 1rem; margin: -1rem -1rem 3.5rem;">
                  @if(isset($detail['scholarship']) && count($detail['scholarship']))
                  @foreach($detail['scholarship'] as $k => $scholarship)
                    <div class="Collapse ">
                      <div class="Collapse-header">
                        <h4 class="mb-0">{{$scholarship['title']}}</h4>
                      </div>
                      <div class="Collapse-icon" style="top: 2.2rem;"><img src="{{asset('frontend/assets/icons/icon-angle-down.svg')}}" alt=""></div>
                      <div class="Collapse-body">
                        {!! $scholarship['content'] !!}
                        <div class="SchoolDetailPage-courses-detail flex items-center justify-between">
                          <div></div>
                          <a  href="{{$scholarship['link'] ?? "#"}}" class="SchoolDetailPage-courses-detail-link flex items-center" target="_blank">
                            Xem chi tiết học bổng
                            <img src="{{asset('frontend/assets/icons/icon-arrow-right-orange.svg')}}" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @endif
                </div>
                {{-- end --}}
                <h3 id="khoahoc" class="page-section">Khóa học</h3>
                <div class="Tab line">
                  <div class="SchoolDetailPage-courses-header flex items-center justify-between flex-wrap">
                    <div class="Tab-header flex" id="wraperselectcourse">
                      <div class="Tab-header-item active" id="allcourse">Tất cả</div>
                        <div class="Tab-header-item " id="daihoccourse">Đại học </div>
                        <div class="Tab-header-item " id="saudaihoccourse">Sau đại học </div>
                        <div class="Tab-header-item " id="caodangcourse">Cao đẳng </div>
                        <div class="Tab-header-item " id="khaccourse">Khác </div>
{{--                      @if(count($detail['courses']))--}}
{{--                        @foreach($detail['majors'] as $major => $id)--}}
{{--                          <div class="Tab-header-item">{{$major}}</div>--}}
{{--                        @endforeach--}}
{{--                      @endif--}}
                    </div>
                    <div class="SchoolDetailPage-courses-header-filter">
                      <div class="Select small bordered">
                        <select class="Select-control" id="selectnganh">
                          <option value="">Chọn ngành học</option>
                            @foreach($detail['majors'] as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <div class="Select-arrow"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                      </div>
                    </div>
                  </div>
                  <div class="Tab-main">
                    {{-- Tab All --}}
                    <div class="Tab-main-item active" id="taballcourse">
                      <div style="max-height: 500px; overflow: auto; padding: 1rem; margin: -1rem;">
                        @foreach($detail['courses'] as $k => $course)
                            @php
                                $object = \Modules\Admin\Entities\Course::find($course['id']);
                                $mag_id = $object->majors_of_course ?  $object->majors_of_course->id : "";
                            @endphp
                            <div class="Collapse" data-courseall="{{ $mag_id }}">
                              <div class="Collapse-header">
                                <h4>{{$course['name']}}</h4>
{{--                                <p>{{ Str::words($course['description'],20) }}</p>--}}
                              </div>
                              <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                              <div class="Collapse-body">
                                {!! $course['content'] !!}
                                <div class="SchoolDetailPage-courses-detail flex items-center justify-between">
                                  <div class="Button secondary small bordered" data-modal-id="">
                                    <button data-course-id="{{ $course['id'] }}" data-school-id="{{ $detail->id }}" @if(auth()->user()) @if($checkHoSo) onclick="openModelCoHoSo(this)" @else onclick="openModelKhongHoSo(this)" @endif  @else onclick="openModelLogin(this)" @endif  class="Button-control flex items-center justify-center btn-nophoso" type="button"><span class="Button-control-title">Nộp hồ sơ</span>
                                    </button>
                                  </div>
                                  <a class="SchoolDetailPage-courses-detail-link flex items-center" href="{{@$course['link_course']}}" target="_blank">Xem chi tiết khóa học<img src="{{ asset('frontend/assets/icons/icon-arrow-right-orange.svg') }}" alt="">
                                  </a>
                                </div>
                              </div>
                            </div>

                        @endforeach
                      </div>
                    </div>
                      <div class="Tab-main-item " id="tabdaihoc">
                          <div style="max-height: 500px; overflow: auto; padding: 1rem; margin: -1rem;">
                              @foreach($detail['courses'] as $k => $course)
                                  @if($course['type'] == 1)
                                      @php
                                          $object = \Modules\Admin\Entities\Course::find($course['id']);
                                          $mag_id = $object->majors_of_course ?  $object->majors_of_course->id : "";
                                      @endphp
                                      <div class="Collapse" data-coursedaihoc="{{ $mag_id }}">
                                          <div class="Collapse-header">
                                              <h4>{{$course['name']}}</h4>
{{--                                              <p>{{ Str::words($course['description'],20) }}</p>--}}
                                          </div>
                                          <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                          <div class="Collapse-body">
                                              {!! $course['content'] !!}
                                              <div class="SchoolDetailPage-courses-detail flex items-center justify-between">
                                                  <div class="Button secondary small bordered" data-modal-id="">
                                                      <button data-course-id="{{ $course['id'] }}" data-school-id="{{ $detail->id }}" @if(auth()->user()) @if($checkHoSo) onclick="openModelCoHoSo(this)" @else onclick="openModelKhongHoSo(this)" @endif  @else onclick="openModelLogin(this)" @endif  class="Button-control flex items-center justify-center btn-nophoso" type="button"><span class="Button-control-title">Nộp hồ sơ</span>
                                                      </button>
                                                  </div>
                                                  <a class="SchoolDetailPage-courses-detail-link flex items-center" href="{{@$course['link_course']}}" target="_blank">Xem chi tiết khóa học<img src="{{ asset('frontend/assets/icons/icon-arrow-right-orange.svg') }}" alt="">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  @endif
                              @endforeach
                          </div>
                      </div>
                      <div class="Tab-main-item " id="tabsaudaihoc">
                          <div style="max-height: 500px; overflow: auto; padding: 1rem; margin: -1rem;">
                              @foreach($detail['courses'] as $k => $course)
                                  @if($course['type'] == 2)
                                      @php
                                          $object = \Modules\Admin\Entities\Course::find($course['id']);
                                          $mag_id = $object->majors_of_course ?  $object->majors_of_course->id : "";
                                      @endphp
                                      <div class="Collapse" data-coursesaudaihoc="{{ $mag_id }}">
                                          <div class="Collapse-header">
                                              <h4>{{$course['name']}}</h4>
{{--                                              <p>{{ Str::words($course['description'],20) }}</p>--}}
                                          </div>
                                          <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                          <div class="Collapse-body">
                                              {!! $course['content'] !!}
                                              <div class="SchoolDetailPage-courses-detail flex items-center justify-between">
                                                  <div class="Button secondary small bordered" data-modal-id="">
                                                      <button data-course-id="{{ $course['id'] }}" data-school-id="{{ $detail->id }}" @if(auth()->user()) @if($checkHoSo) onclick="openModelCoHoSo(this)" @else onclick="openModelKhongHoSo(this)" @endif  @else onclick="openModelLogin(this)" @endif  class="Button-control flex items-center justify-center btn-nophoso" type="button"><span class="Button-control-title">Nộp hồ sơ</span>
                                                      </button>
                                                  </div>
                                                  <a class="SchoolDetailPage-courses-detail-link flex items-center" href="{{@$course['link_course']}}"  target="_blank">Xem chi tiết khóa học<img src="{{ asset('frontend/assets/icons/icon-arrow-right-orange.svg') }}" alt="">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  @endif
                              @endforeach
                          </div>
                      </div>
                      <div class="Tab-main-item " id="tabcaodang">
                          <div style="max-height: 500px; overflow: auto; padding: 1rem; margin: -1rem;">
                              @foreach($detail['courses'] as $k => $course)
                                  @if($course['type'] == 3)
                                      @php
                                          $object = \Modules\Admin\Entities\Course::find($course['id']);
                                          $mag_id = $object->majors_of_course ?  $object->majors_of_course->id : "";
                                      @endphp
                                      <div class="Collapse" data-coursecaodang="{{ $mag_id }}">
                                          <div class="Collapse-header">
                                              <h4>{{$course['name']}}</h4>
                                              {{--                                              <p>{{ Str::words($course['description'],20) }}</p>--}}
                                          </div>
                                          <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                          <div class="Collapse-body">
                                              {!! $course['content'] !!}
                                              <div class="SchoolDetailPage-courses-detail flex items-center justify-between">
                                                  <div class="Button secondary small bordered" data-modal-id="">
                                                      <button data-course-id="{{ $course['id'] }}" data-school-id="{{ $detail->id }}" @if(auth()->user()) @if($checkHoSo) onclick="openModelCoHoSo(this)" @else onclick="openModelKhongHoSo(this)" @endif  @else onclick="openModelLogin(this)" @endif  class="Button-control flex items-center justify-center btn-nophoso" type="button"><span class="Button-control-title">Nộp hồ sơ</span>
                                                      </button>
                                                  </div>
                                                  <a class="SchoolDetailPage-courses-detail-link flex items-center" href="{{@$course['link_course']}}" target="_blank">Xem chi tiết khóa học<img src="{{ asset('frontend/assets/icons/icon-arrow-right-orange.svg') }}" alt="">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  @endif
                              @endforeach
                          </div>
                      </div>
                      <div class="Tab-main-item " id="tabkhac">
                          <div style="max-height: 500px; overflow: auto; padding: 1rem; margin: -1rem;">
                              @foreach($detail['courses'] as $k => $course)
                                  @if($course['type'] == 4)
                                      @php
                                          $object = \Modules\Admin\Entities\Course::find($course['id']);
                                          $mag_id = $object->majors_of_course ?  $object->majors_of_course->id : "";
                                      @endphp
                                      <div class="Collapse" data-coursekhac="{{ $mag_id }}">
                                          <div class="Collapse-header">
                                              <h4>{{$course['name']}}</h4>
                                              {{--                                              <p>{{ Str::words($course['description'],20) }}</p>--}}
                                          </div>
                                          <div class="Collapse-icon"> <img src="{{ asset('frontend/assets/icons/icon-angle-down.svg') }}" alt=""></div>
                                          <div class="Collapse-body">
                                              {!! $course['content'] !!}
                                              <div class="SchoolDetailPage-courses-detail flex items-center justify-between">
                                                  <div class="Button secondary small bordered" data-modal-id="">
                                                      <button data-course-id="{{ $course['id'] }}" data-school-id="{{ $detail->id }}" @if(auth()->user()) @if($checkHoSo) onclick="openModelCoHoSo(this)" @else onclick="openModelKhongHoSo(this)" @endif  @else onclick="openModelLogin(this)" @endif  class="Button-control flex items-center justify-center btn-nophoso" type="button"><span class="Button-control-title">Nộp hồ sơ</span>
                                                      </button>
                                                  </div>
                                                  <a class="SchoolDetailPage-courses-detail-link flex items-center" href="{{@$course['link_course']}}"  target="_blank">Xem chi tiết khóa học<img src="{{ asset('frontend/assets/icons/icon-arrow-right-orange.svg') }}" alt="">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  @endif
                              @endforeach
                          </div>
                      </div>
                    {{-- End --}}

                  </div>
                </div>
                {{-- Required --}}
                <h3 id="yeucau" class="page-section">Yêu cầu đầu vào</h3>
                <div class="Tab merge">
                  <div class="Tab-header flex">
                    @if(@$detail['required'])
                      @foreach($detail['required'] as $k => $required)
                        <div class="Tab-header-item ">{{$required['title']}}</div>
                      @endforeach
                    @endif
                  </div>
                  <div class="Tab-main">
                    @if(@$detail['required'])
                      @foreach($detail['required'] as $k => $required)
                      <div class="Tab-main-item ">
                      {!! $required['content'] !!}
                      </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                {{-- Feedback --}}
                <h3 id="feedback" class="page-section">Feedback</h3>
                <div class="owl-carousel SchoolDetailPage-feedbacks" id="Feedbacks-carousel">
                  @if(isset($detail['feed_back']) && count($detail['feed_back']))
                    @foreach($detail['feed_back'] as $k => $feedback)
                    <div class="item">
                      <div class="SchoolDetailPage-feedbacks-item">
                        <div class="FeedbackBlock">
                          <div class="FeedbackBlock-avatar"> <img src="{{$feedback['image']}}" alt=""></div>
                          <h5 class="FeedbackBlock-title">{{$feedback['name']}}</h5>
                          <p class="FeedbackBlock-description">{{$feedback['content']}}</p>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  @endif
                </div>
                {{-- Gallery --}}
                <h3 id="thuvienanh" class="page-section">Thư viện ảnh</h3>
                <div class="owl-carousel SchoolDetailPage-gallery" id="Gallery-carousel">
                  @if(isset($detail['gallery']) && count($detail['gallery']))
		  @foreach($detail['gallery'] as $gallery)
                    <div class="item">
                      <a class="SchoolDetailPage-gallery-item" href="{{$gallery['image'] ?? "" }}" data-fancybox="gallery">
                        <img src="{{ $gallery['image'] ?? "" }}" alt="">
                      </a>
                    </div>
                  @endforeach
                  @endif
                </div>
                {{-- Related school --}}
                <h3 id="truongtuongtu" class="page-section">Trường tương tự</h3>
                <div class="owl-carousel SchoolDetailPage-ralated-school" id="RelatedSchool-carousel">
                    @if(!empty($detail['relatedSchool']))
                        @foreach($detail['relatedSchool'] as $k => $school)
                           <div class="item">
                            <div class="SchoolDetailPage-ralated-school-item">
                              <div class="SchoolBlock @if($school->type_school == 3) {{'odd'}} @elseif($school->type_school == 2) {{'even'}} @else {{'custom_red'}} @endif ">
                                <div class="SchoolBlock-image"> <a href="{{route('details_school',['slug'=> $school->slug] )}}"> <img src="{{$school->logo}}" alt=""></a></div>
                                <div class="line"></div>
                                <div class="SchoolBlock-info"><a class="SchoolBlock-title" href="{{route('details_school',['slug'=> $school->slug] )}}">{{$school->name}}</a>
                                  <p class="SchoolBlock-description">{{$school['heading']}}</p>
                                  <div class="SchoolBlock-row flex justify-between items-center">
                                    <div class="SchoolBlock-country flex items-center">
                                      <div class="SchoolBlock-country-flag"> <img src="{{$school->country->icon}}" alt=""></div>{{@$school['country']['name']}}
                                    </div>
                                    <div class="SchoolBlock-tag">@if($school->type_school == 3) {{'Available'}} @elseif($school->type_school == 2) {{'Partner'}} @else {{'Close'}} @endif</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    @endif
                </div>
                {{-- End --}}
              </div>
            </div>
          </div>
          <div class="SchoolDetailPage-wrapper-item">
            <div class="SchoolDetailPage-table-content">
              <div class="Card">
                <div class="Card-header">OverView</div>
                <div class="Card-body">
                  <ul class="SchoolDetailPage-table-content-list">
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#gioithieu"  class="js-anchor-link">Giới thiệu chung về trường</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#thanhpho" class="js-anchor-link">Thành phố</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#noibat" class="js-anchor-link">Các thông tin nổi bật</a></li>
                      <li class="SchoolDetailPage-table-content-list-item"> <a href="#cosovatchat" class="js-anchor-link">Cơ sở vật chất</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#chuongtrinh" class="js-anchor-link">Chương trình giảng dạy</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#hocphi" class="js-anchor-link">Học phí</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#hocbong" class="js-anchor-link"> Học bổng</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#khoahoc" class="js-anchor-link">Khoá học</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#yeucau" class="js-anchor-link">Yêu cầu đầu vào</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#feedback" class="js-anchor-link">FeedBack</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#thuvienanh" class="js-anchor-link">Thư viện ảnh</a></li>
                    <li class="SchoolDetailPage-table-content-list-item"> <a href="#truongtuongtu" class="js-anchor-link">Trường tương tự</a></li>
                  </ul>
                </div>
              </div>
              <div class="SchoolDetailPage-btns">
                <div class="Button secondary small" data-modal-id="">
                  <button data-id="{{ $detail->id  }}" class="add-compare Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Thêm so sánh</span>
                  </button>
                </div>
                <div class="Button small" data-modal-id="">
                  <button data-auth="{{  auth()->user() ? true : false }}" data-id="{{ $detail->id  }}" class="add_wishlish Button-control flex items-center justify-center" type="button"><span class="Button-control-icon"><img src="{{ asset('frontend/assets/icons/icon-heart-circle-orange.svg') }}" alt=""></span><span class="Button-control-title">Thêm yêu thích</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ModalSubmitFileSuccess Modal"  id="ModalSuccess">
          <div class="Modal-overlay"> </div>
          <div class="Modal-main" style="max-width: 62.8rem;">
              <div class="Modal-header">
                  THông báo</div>
              <div class="Modal-body">
                  <div class="style-content">
                      <p class="text-center">Hồ sơ của bạn đã được nộp thành công</p>
                      <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button secondary small" data-modal-id="">
                                  <a href="{{route('theodoiHoSo')}}" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem hồ sơ</span>
                                  </a>
                              </div>
                          </div>
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button Modal-close small" data-modal-id="">
                                  <a href="{{ route('trang-chu') }}" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Trang chủ</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="ModalSubmitFileSuccess Modal"  id="ModalCoHoSo">
          <div class="Modal-overlay"> </div>
          <div class="Modal-main" style="max-width: 62.8rem;">
              <div class="Modal-header">
                  THông báo</div>
              <div class="Modal-body">
                  <div class="style-content">
                      <p class="text-center">Bạn đã có hồ sơ trước đó.<br>Vui lòng nộp ngay !<br> Hoặc <br> Có thể tạo hồ sơ mới</p>
                      <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button secondary small" data-modal-id="">
                                  <a href="{{ route('formNopHoSo') }}?id={{ $detail->id }}" class="Button-control btn-canel flex items-center justify-center" type="button"><span class="Button-control-title">Tạo mới</span>
                                  </a>
                              </div>
                          </div>
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button Modal-close small" data-modal-id="">
                                  <button id="btnNopNgay" data-school-id="{{ $detail->id }}" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Nộp ngay</span>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="ModalSubmitFileSuccess Modal"  id="ModalKhongHoSo">
          <div class="Modal-overlay"> </div>
          <div class="Modal-main" style="max-width: 62.8rem;">
              <div class="Modal-header">
                  THông báo</div>
              <div class="Modal-body">
                  <div class="style-content">
                      <p class="text-center">Bạn chưa có hồ sơ trước đó <br>Vui lòng tiếp tục để nộp hồ sơ !</p>
                      <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button secondary small" data-modal-id="">
                                  <button  class="Button-control btn-canel flex items-center justify-center" type="button"><span class="Button-control-title">Hủy</span>
                                  </button>
                              </div>
                          </div>
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button Modal-close small" data-modal-id="">
                                  <a id="btnContinute" href="#" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Tiếp tục</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="ModalSubmitFileSuccess Modal"  id="ModalWishList">
          <div class="Modal-overlay"> </div>
          <div class="Modal-main" style="max-width: 62.8rem;">
              <div class="Modal-header">
                  THông báo</div>
              <div class="Modal-body">
                  <div class="style-content">
                      <p class="text-center" id="notify_title"></p>
                      <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button secondary small" data-modal-id="">
                                  <button  class="Button-control btn-canel flex items-center justify-center" type="button"><span class="Button-control-title">Hủy</span>
                                  </button>
                              </div>
                          </div>
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button Modal-close small" data-modal-id="">
                                  <a href="/truong-yeu-thich" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem danh sách</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="ModalSubmitFileSuccess Modal"  id="ModalCompare">
          <div class="Modal-overlay"> </div>
          <div class="Modal-main" style="max-width: 62.8rem;">
              <div class="Modal-header">
                  THông báo</div>
              <div class="Modal-body">
                  <div class="style-content">
                      <p class="text-center" id="notify_title_compare"></p>
                      <div class="ModalSubmitFileSuccess-form-submit flex justify-between" style="column-gap: 2rem;">
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button secondary small" data-modal-id="">
                                  <button  class="Button-control btn-canel flex items-center justify-center" type="button"><span class="Button-control-title">Hủy</span>
                                  </button>
                              </div>
                          </div>
                          <div class="ModalSubmitFileSuccess-form-submit-item" style="flex: 1">
                              <div class="Button Modal-close small" data-modal-id="">
                                  <a href="{{ route('listCompare') }}" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem danh sách</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    @endif
@endsection

@section('after_styles')
  <style>
    .color_available{
      background:linear-gradient(180deg, #01865d 0, #24b24b 100%) !important;
    }
    .color_close{
      background:linear-gradient(180deg, #d41f30 0, #80141f 100%) !important;
    }
  </style>
@stop

@section('after_scripts')

    <script>
        var course_id_school = null;
        function openModelCoHoSo(t){
            console.log('this', $(this))
            $("#ModalCoHoSo").addClass("active");
            $("#ModalCoHoSo").css({"display": "block"});
            const modal = document.querySelector("#ModalCoHoSo");
            const overlay = modal.querySelector(".Modal-overlay");
            course_id_school = $(t).data("course-id");
            overlay.addEventListener("click", () => {
                modal.classList.remove("active");
                // modal.style.display = "none";
            });

        }
        function openModelKhongHoSo(t){
           var school_id = $(t).data("school-id");
            var course_id = $(t).data("course-id");
            $("#btnContinute").attr("href", '{{ route('formNopHoSo') }}?id=' + school_id + '&course_id=' + course_id);
            $("#ModalKhongHoSo").addClass("active");
        }
        function openModelLogin(){
            $(".Modal").removeClass("active");
            $("#ModalAuth").addClass("active");
            // $("#ModalAuth").css({"display": "block"});
            const modal = document.querySelector("#ModalAuth");
            const overlay = modal.querySelector(".Modal-overlay");
            const close = modal.querySelectorAll(".Modal-close");

            overlay.addEventListener("click", () => {
                modal.classList.remove("active");
                // overlay.style.display = "none";
            });
            close.forEach((item) =>
                item.addEventListener("click", () => {
                    modal.classList.remove("active");
                    // overlay.style.display = "none";
                })
            );
        }


        $(document).ready(function() {

            $(".add_wishlish").on('click', function(){
                var auth = $(this).data('auth');
                var id = $(this).data('id');
                if(auth != 1){
                    openModelLogin();
                }else{
                    $.ajax({
                        url: "/add-wishlist?id=" + id,
                        success: function(data){
                            $("#notify_title").html(data.msg);
                            $("#ModalWishList").addClass("active");
                            $("#ModalWishList").css({"display": "block"});
                        }
                    })
                }
            })
            $(".add-compare").on('click', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: "/them-so-sanh?id=" + id,
                    success: function(data){
                        //$("#notify_title_compare").html(data.msg);
                        //$("#ModalCompare").addClass("active");
                        if(data.rs == 1){
                            var data = data.data;
                            var xhtml = '';
                            $.each(data, function(i, v){
                                xhtml += `<li class="Compare-school-wrapper-logo-item">
                                          <div class="Compare-school-wrapper-logo-item-remove" onclick="removeItem(this)" data-id="` + v.id + `">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                              <g fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path fill="currentColor" fill-rule="nonzero" d="M12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 Z M17,13 L7,13 L7,11 L17,11 L17,13 Z"></path>
                                              </g>
                                            </svg>
                                          </div>
                                          <div class="Compare-school-wrapper-logo-item-images"><img src="`+v.logo+`"></div>
                                        </li>
`;
                            })
                            var html = `<div class="Compare-school show">
                                  <div class="container">
                                    <div class="Compare-school-wrapper flex items-center justify-between flex-wrap">
                                      <div class="Compare-school-wrapper-name">University Comparison</div>
                                      <ul class="Compare-school-wrapper-logo flex items-center">
                                       `+xhtml+`
                                      </ul>
                                      <div class="Compare-school-wrapper-button">
                                        <div class="Button middle bordered" data-modal-id="">
                                          <a  href="/so-sanh-truong" class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">So sánh</span>
                                          </a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                `;
                            $("#compare_item").html(html);
                        }
                    }
                })
            })

            $(".btn-canel").on("click", function(){
                $(this).parents(".Modal").removeClass("active");
            });

            $("#btnNopNgay").on("click", function(){
                var school_id = $(this).data("school-id");
                console.log('course_id_school', course_id_school)
                ajax_loading(true);
                $.ajax({
                    url: "{{ route('nopHoSoNgay') }}?school_id=" +  school_id + '&course_id=' + course_id_school,
                    dataType: "json",
                    success: function(data){
                        ajax_loading(false);
                        $(".Modal").removeClass("active");
                        if(data.rs == 1){
                            $("#ModalSuccess").addClass("active");
                        }
                    }
                });
            });
        });

        function removeItem(t){
            var id = $(t).data("id");
           // $(t).parents(".Compare-school-wrapper-logo-item").remove();
            window.location.href = "/xoa-so-sanh?id=" + id;
        }

        $("#selectnganh").on("change", function(e){
            var v_select = $(this).val();
            var id = $("#wraperselectcourse .Tab-header-item.active").attr("id");
            showCourseById(id, v_select);
        })
        function showCourseById(id, v_select){
            if(id == "allcourse"){
                console.log('id', id)
                var arr = $("#taballcourse .Collapse");
                $.each(arr, function(i,v){
                    var object = $(v);
                    object.hide();
                    if(object.data("courseall") == v_select){
                        object.show();
                    }
                    if(v_select == ''){
                        object.show();
                    }
                })
            }
            if(id == "daihoccourse"){
                var arr = $("#tabdaihoc .Collapse");
                $.each(arr, function(i,v){
                    var object = $(v);
                    object.hide();
                    if(object.data("coursedaihoc") == v_select){
                        console.log('show');
                        object.show();
                    }
                    if(v_select == ''){
                        object.show();
                    }
                })
            }
            if(id == "saudaihoccourse"){
                var arr = $("#tabsaudaihoc .Collapse");
                $.each(arr, function(i,v){
                    var object = $(v);
                    object.hide();
                    if(object.data("coursesaudaihoc") == v_select){
                        console.log('show');
                        object.show();
                    }
                    if(v_select == ''){
                        object.show();
                    }
                })
            }
            if(id == "caodangcourse"){
                var arr = $("#tabcaodang .Collapse");
                $.each(arr, function(i,v){
                    var object = $(v);
                    object.hide();
                    if(object.data("coursecaodang") == v_select){
                        console.log('show');
                        object.show();
                    }
                    if(v_select == ''){
                        object.show();
                    }
                })
            }
            if(id == "khaccourse"){
                var arr = $("#tabkhac .Collapse");
                $.each(arr, function(i,v){
                    var object = $(v);
                    object.hide();
                    if(object.data("coursekhac") == v_select){
                        console.log('show');
                        object.show();
                    }
                    if(v_select == ''){
                        object.show();
                    }
                })
            }
        }
        $("#wraperselectcourse .Tab-header-item").on("click", function(){
            var id = $(this).attr("id");
            var v_select = $("#selectnganh").val();
            showCourseById(id, v_select);
        })


        // $(document).ready(function () {
        //     // $(document).on("scroll", onScroll);
        //
        //     //smoothscroll
        //     $('.SchoolDetailPage-table-content a[href^="#"]').on('click', function (e) {
        //         e.preventDefault();
        //         // $(document).off("scroll");
        //
        //         $('.SchoolDetailPage-table-content .SchoolDetailPage-table-content-list-item a').each(function () {
        //             $(this).removeClass('active');
        //         })
        //         $(this).addClass('active');
        //
        //         var target = this.hash,
        //             menu = target;
        //         $target = $(target);
        //         $('html, body').stop().animate({
        //             'scrollTop': $target.offset().top + 2
        //         }, 500, 'swing', function () {
        //             window.location.hash = target;
        //             $(document).on("scroll", onScroll);
        //         });
        //     });
        // });
        // function onScroll(event){
        //     var scrollPos = $(document).scrollTop();
        //
        //     $('.SchoolDetailPage-table-content a').each(function () {
        //         var currLink = $(this);
        //         var refElement = $(currLink.attr("href"));
        //         if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
        //             $('.SchoolDetailPage-table-content .SchoolDetailPage-table-content-list-item a').removeClass("active");
        //             currLink.addClass("active");
        //         }
        //         else{
        //             currLink.removeClass("active");
        //         }
        //     });
        // }
    </script>

@endsection
