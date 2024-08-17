@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
?>
@section('content')
<div class="SchoolListPage">
      <section class="Banner">
        <div class="Banner-wrapper">
          <div class="Banner-image" style="height: 26.4rem;">
            <img src="{{asset('frontend/assets/images/image-banner-school-list.png')}}" alt=""></div>
          <div class="Banner-overlay"></div>
          <h1 class="Banner-text transform">Danh sách trường</h1>
        </div>
      </section>
      @include('front::home.filter')
      <div class="container">
        @if(isset($datas) && count($datas))
        <div class="SchoolListPage-wrapper">
          <h6 class="SchoolListPage-search-text">{{count($datas)}} trường được tìm kiếm</h6>
          <div class="SchoolListPage-list flex flex-wrap">
            @foreach($datas as $k => $data)
            <div class="SchoolListPage-list-item">
              <div class="SchoolBlock
              @if($data['type_school'] == 3) {{'odd'}} @elseif($data['type_school'] == 2) {{'even'}} @else {{'custom_red'}} @endif">
                <div class="SchoolBlock-image"> <a href="{{route('details_school',['slug'=> $data['slug']] )}}"> <img src="{{$data['logo']}}" alt=""></a></div>
                <div class="line"></div>
                <div class="SchoolBlock-info">
                  <a class="SchoolBlock-title" href="{{route('details_school',['slug'=> $data['slug']])}}">{{$data['name']}}</a>
                  <p class="SchoolBlock-description">{{$data['heading']}}</p>
                  <div class="SchoolBlock-row flex justify-between items-center">
                    <div class="SchoolBlock-country flex items-center">
                      <div class="SchoolBlock-country-flag"> <img src="{{@$data['country']['icon']}}" alt=""></div>{{@$data['country']['name']}}
                    </div>
                    <div class="SchoolBlock-tag">
                      @if($data['type_school'] == 3) {{'Available'}} @elseif($data['type_school'] == 2) {{'Partner'}} @else {{'Close'}} @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @else
           <h6 class="SchoolListPage-search-text">Rất tiếc ! Không có trường phù hợp</h6>
        @endif
      </div>
    </div>

@endsection

@section('after_styles')
  <style>
    .SchoolBlock.custom_red .SchoolBlock-tag {
      background: linear-gradient(180deg, #d41f30 0, #80141f 100%);
    }
    .SchoolBlock.custom_red .line {
        background: linear-gradient(180deg, #d41f30 0, #80141f 100%);
    }
  </style>
@stop

@section('after_scripts')
  <script type="text/javascript">
        $(document).ready(function() {
            $('#search_country').val({{$_GET['country'] ?? ''}});
            $('#search_course').val({{$_GET['course'] ?? ''}});
            $('#search_majors').val({{$_GET['majors'] ?? '' }});
            $('#search_levelcourse').val({{$_GET['levelcourse'] ?? '' }});
            $('#search_ranking').val({{$_GET['ranking'] ?? '' }});
            $('#search_keywords_').val('{{$_GET['keywords_'] ?? '' }}');
            $('#search_province').val('{{$_GET['province'] ?? '' }}');
        })

        get_country("#search_country");
        $('#search_country').on('change', function () {
            get_city_by_country($(this));
        });
        function get_country(destination) {
            destination = destination || '#search_country';
            var id = $(destination).attr('data-id');

            $.get('/location/get-country', function (res) {
                var html = '<option value="">Chọn quốc gia</option>';
                $.each(res.data, function( id, name ) {
                    html += '<option value="'+id+'">'+name+'</option>';
                });
                $(destination).html(html).val(id).trigger('change');
            }, 'json');
        }

        function get_city_by_country(obj_country, select2) {
            var select2 = select2 || false;
            var destination = $(obj_country).attr('data-destination');
              var id = $(destination).attr('data-id');

            $.get('/location/get-city', {province_id: $(obj_country).val()}, function (res) {
                var html = '<option value="">Chọn thành phố</option>';
                $.each(res.data, function( id, name ) {
                    html += '<option value="'+id+'">'+name+'</option>';
                });
                $(destination).html(html).val(id).trigger('change');


            }, 'json');
        }
    </script>
@endsection
