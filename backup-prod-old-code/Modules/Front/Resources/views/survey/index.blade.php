@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => @$settings['site_title']['value'],
        'meta_description' => 'Khảo sát',
        'link' => route('survey'),
        'thumbnail' =>  @$settings['og_image']['value'],
        'robots' => 1
    ])
@stop
@section('content')
    <style>
        .sticky-survey{
           top: 19rem;
        }
    </style>
   <div class="SurveyPage">
      <section class="Banner">
        <div class="Banner-wrapper">
          <div class="Banner-image" style="height: 26.4rem;">
            <img src="{{asset('frontend/assets/images/image-banner-school-list.png')}}" alt=""></div>
          <div class="Banner-overlay"></div>
          <h1 class="Banner-text">Khảo sát</h1>
        </div>
      </section>
      <div class="container">
        <form class="SurveyPage-wrapper flex flex-wrap" action="{{route('survey_school.post')}}" method="POST">
          <div class="SurveyPage-wrapper-item">
            <div class="Card">
              <div class="Card-header">Quốc gia</div>
              <div class="Card-body" style="padding: 2.4rem 2rem;">
                <div class="SurveyPage-nations flex flex-wrap">
                  @if(isset($countries) && count($countries) > 0)
                    @foreach($countries as $country)
                      <div class="SurveyPage-nations-col">

                            <div class="SurveyPage-nations-item">
                              <input type="checkbox" name="country_id[]" value="{{$country['id']}}">
                              <div class="SurveyPage-nations-item-control"></div>
                              <div class="SurveyPage-nations-item-image">
                               <img src="{{@$country['logo']}}" alt="">
                             </div>
                              <h4 class="SurveyPage-nations-item-title">{{$country['name']}}</h4>
                            </div>
                      </div>
                     @endforeach
                   @endif
                </div>
              </div>
            </div>
            <div class="Card">
              <div class="Card-header">Ngành học</div>
              <div class="Card-body" style="padding: 2.4rem 2rem;">
                <div class="SurveyPage-major">
                  <div class="Input middle bordered">
                    <select id="select_major" class="Input-control" name="majors">
                      @if(isset($majors) && count($majors) > 0)
                          @foreach($majors as $major)
                            <option value="{{$major['id']}}">{{$major['name']}}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
                  <h4 class="SurveyPage-major-title">Điểm học</h4>
                  <div class="SurveyPage-major-score">
                    <div class="SurveyPage-major-score-item flex items-start">
                      <input type="checkbox">
                      <div class="SurveyPage-major-score-item-control"></div>
                      <div class="SurveyPage-major-score-item-info">
                        <div class="SurveyPage-major-score-item-info-title">Điểm học THPT</div>
                        <div class="SurveyPage-major-score-item-info-form">
                          <p>Điểm 3 năm gần nhất</p>
                          <div class="Input middle bordered">
                            <input class="Input-control" name="survey_mark_thpt" type="text" placeholder="Nhập điểm">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="SurveyPage-major-score-item flex items-start">
                      <input type="checkbox">
                      <div class="SurveyPage-major-score-item-control"></div>
                      <div class="SurveyPage-major-score-item-info">
                        <div class="SurveyPage-major-score-item-info-title">Điểm học đại học</div>
                        <div class="SurveyPage-major-score-item-info-form">
                          <p>Điểm 3 năm gần nhất</p>
                          <div class="Input middle bordered">
                            <input class="Input-control" name="survey_mark_dh" type="text" placeholder="Nhập điểm">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="SurveyPage-major-score-item flex items-start">
                      <input type="checkbox">
                      <div class="SurveyPage-major-score-item-control"></div>
                      <div class="SurveyPage-major-score-item-info">
                        <div class="SurveyPage-major-score-item-info-title">Điểm học thạc sĩ</div>
                        <div class="SurveyPage-major-score-item-info-form">
                          <p>Điểm 3 năm gần nhất</p>
                          <div class="Input middle bordered">
                            <input class="Input-control" name="survey_mark_ts" type="text" placeholder="Nhập điểm">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="SurveyPage-major-score-item flex items-start">
                      <input type="checkbox">
                      <div class="SurveyPage-major-score-item-control"></div>
                      <div class="SurveyPage-major-score-item-info">
                        <div class="SurveyPage-major-score-item-info-title">Điểm học chuyển tiếp</div>
                        <div class="SurveyPage-major-score-item-info-form">
                          <p>Điểm 3 năm gần nhất</p>
                          <div class="Input middle bordered">
                            <input class="Input-control" name="survey_mark_ct" type="text" placeholder="Nhập điểm">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h4 class="SurveyPage-major-title">THời gian bắt đầu học</h4>
                  <div class="SurveyPage-start-time flex flex-wrap">
                    <div class="SurveyPage-start-time-item">
                      <input type="radio" name="startTime" value="1,3">
                      <div class="SurveyPage-start-time-item-control"> <img src="{{asset('frontend/assets/icons/icon-check.svg')}}" alt=""></div>
                      <div class="SurveyPage-start-time-item-label">Trong 1-3 tháng nữa</div>
                    </div>
                    <div class="SurveyPage-start-time-item">
                      <input type="radio" name="startTime" value="4,6">
                      <div class="SurveyPage-start-time-item-control"> <img src="{{asset('frontend/assets/icons/icon-check.svg')}}" alt=""></div>
                      <div class="SurveyPage-start-time-item-label">Trong 4-6 tháng nữa</div>
                    </div>
                    <div class="SurveyPage-start-time-item">
                      <input type="radio" name="startTime" value="6,9">
                      <div class="SurveyPage-start-time-item-control"> <img src="{{asset('frontend/assets/icons/icon-check.svg')}}" alt=""></div>
                      <div class="SurveyPage-start-time-item-label">Trong 7-9 tháng nữa</div>
                    </div>
                    <div class="SurveyPage-start-time-item">
                      <input type="radio" name="startTime" value="10,12">
                      <div class="SurveyPage-start-time-item-control"> <img src="{{asset('frontend/assets/icons/icon-check.svg')}}" alt=""></div>
                      <div class="SurveyPage-start-time-item-label">Trong 10-12 tháng nữa</div>
                    </div>
                    <div class="SurveyPage-start-time-item">
                      <input type="radio" name="startTime" value="15">
                      <div class="SurveyPage-start-time-item-control"> <img src="{{asset('frontend/assets/icons/icon-check.svg')}}" alt=""></div>
                      <div class="SurveyPage-start-time-item-label">Trong 1 năm nữa hoặc hơn</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Card">
              <div class="Card-header">bạn có thắc mắc gì cần các TVV của KS tư vấn không?</div>
              <div class="Card-body" style="padding: 2.4rem 2rem;">
                <div class="Input middle bordered">
                  <input class="Input-control" name="survey_mark_gpa" type="text" placeholder="Nội dung">
                </div>
              </div>
            </div>
          </div>
          <div class="SurveyPage-wrapper-item">
            <div class="sticky sticky-survey">
              <div class="Card">
                <div class="Card-header text-center">Học phí</div>
                <div class="Card-body">
                  <div class="Radio middle flex items-start">
                    <input type="radio" name="survey_tuition" value="499000000">
                    <div class="Radio-control"> </div>
                    <div class="Radio-label">Dưới 500 triệu đồng</div>
                  </div>
                  <div class="Radio middle flex items-start">
                    <input type="radio" name="survey_tuition" value="600000000">
                    <div class="Radio-control"> </div>
                    <div class="Radio-label">Từ 500 triệu đồng đến 1 tỉ đồng</div>
                  </div>
                  <div class="Radio middle flex items-start">
                    <input type="radio" name="survey_tuition" value="1000000000">
                    <div class="Radio-control"> </div>
                    <div class="Radio-label">Trên 1 tỉ đồng</div>
                  </div>
                </div>
              </div>
              <div class="Card">
                <div class="Card-header text-center">Điểm Ielts</div>
                <div class="Card-body">
                  <div class="Radio middle flex items-start">
                    <input type="radio" name="survey_mark_ielts" value="5.4">
                    <div class="Radio-control"> </div>
                    <div class="Radio-label">Dưới 5.5</div>
                  </div>
                  <div class="Radio middle flex items-start">
                    <input type="radio" name="survey_mark_ielts" value="5.6">
                    <div class="Radio-control"> </div>
                    <div class="Radio-label">Từ 5.5 đến 7.0</div>
                  </div>
                  <div class="Radio middle flex items-start">
                    <input type="radio" name="survey_mark_ielts" value="7.1">
                    <div class="Radio-control"> </div>
                    <div class="Radio-label">Trên 7.0</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="SurveyPage-submit flex justify-center">
            <div class="Button secondary small bordered" data-modal-id="">
              <button class="Button-control flex items-center justify-center" type="submit"><span class="Button-control-title">Gửi khảo sát</span>
              </button>
            </div>
          </div>
            @csrf
        </form>
      </div>
    </div>
@endsection

@section('after_styles')
{{-- <link href="/html/plugins/select2/css/select2.min.css" rel="stylesheet"> --}}
@stop

@section('after_scripts')

@endsection
