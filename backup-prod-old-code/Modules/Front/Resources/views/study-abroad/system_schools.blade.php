@extends('front::layouts.master')
<?php
use App\Helpers\Auth;
$user = Auth::getUserInfo();
$settings = \App\Helpers\General::get_settings();
?>
@section('meta')

    @include("front::includes.meta", [
        'meta_title' => $settings['site_title']['value'],
        'meta_description' => $settings['og_description']['value'],
        'link' => route('studyAbroad',['slug' => @$obj['system_schools_slug']]),
        'thumbnail' =>  $settings['og_image']['value'],
        'robots' => 1
    ])
@stop
@section('content')
  <section class="Banner">
        <div class="Banner-wrapper"> 
          <div class="Banner-image" style="height: 26.4rem;">
          <div class="Banner-overlay"></div>
          <h1 class="Banner-text">{{$obj['system_schools_title']}}</h1>
        </div>
  </section>
  <section id="school_items" class="text-center">
      <div class="container">
        @if(isset($obj['system_schools_items']))
          @php
          $items = json_decode($obj['system_schools_items'],true);
          @endphp
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach($items as $k => $item)
            <li class="nav-item">
              <a class="nav-link " id="{{$k}}-tab" 
                data-toggle="{{$k}}" href="#{{$k}}" role="tab" 
                aria-controls="{{$k}}" aria-selected="true">{{$item['title']}}</a>
            </li>
            @endforeach
            <input type="hidden" id="old_tab">
          </ul>
          <div class="tab-content" id="pills-tabContent">
            @foreach($items as $k => $item)
            <div class="tab-pane fade " id="{{$k}}" role="tabpanel" aria-labelledby="{{$k}}-tab">
                {{$item['content']}}
            </div>
            @endforeach
            <input type="hidden" id="old_content">
          </div>
        @endif
      </div>
  </section>
@endsection
@section('after_styles')
 <style>
    .container{
      max-width:1200px;
      font-size:20px;
      margin:30px auto;
    }
    .Banner-image{
      background-image: url({{ $obj['system_schools_img']}});
      background-position: 0 -474px;
      background-repeat: no-repeat;
      background-size: cover;
    }
    .Banner-overlay{
      background-color: rgba(0,0,0,.42);
      opacity: 1;
      transition: background 0.3s,border-radius 0.3s,opacity 0.3s;
    }
    .Banner-text{
      text-align:center;
    }
    #pills-tab{
      background-color:#f1f1f1;
    }
    #pills-tab .nav-item {
      padding: 24px;
    }
    .nav-link{
      padding:16px 28px;
      color:#F1592A;
    }
    .nav-link:hover{
      color: black !important;
    }
    .nav-pills .nav-link.active{
      background:#F1592A;
    }
  </style>
@stop
@section('after_scripts')
    <script type="text/javascript">
        let old_tab = '';
        let old_content = "";
        $(".nav-link").click(function() {
            $(this).addClass('active');
            if(old_tab) {
              $('#'+old_tab).removeClass('active');
            }
            old_tab   = $(this).attr('id');
            let content = $(this).attr('data-toggle');
            $('#'+content).addClass('show active');
            if(old_content) {
              $('#'+old_content).removeClass('show active');
            }
            old_content   = content;
        })
    </script>
@stop
