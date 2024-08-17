<!doctype html>

<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sach truong</title>
    <style>
        body {
            font-family: 'Roboto';
        }
        table tr td{
            border: 1px solid gray;
            padding: 2px 2px;
        }
    </style>
</head>
<body>
<br>
<table style="border: 1px solid gray; border-collapse: collapse">
    @php
        $with_header = 10;
        $width_td = 90;
        if(count($listSchool) == 1){
            $width_td = 90;
        }elseif(count($listSchool) == 2){
            $width_td = $width_td / 2;
        }elseif(count($listSchool) == 3){
            $width_td = $width_td / 3;
        }elseif(count($listSchool) == 4){
            $width_td = $width_td / 4;
        }
    @endphp
    <thead>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%"></td>
        @foreach($listSchool as $school)
            @php
                $color = "";
                if($school->type_school == 1){
                    $color = "#80141f";
                }if($school->type_school == 2){
                    $color = "#f15e2b";
                }if($school->type_school == 3){
                    $color = "#1e397e";
                }
            @endphp
            <td style="width: {{ $width_td }}%; border-bottom: 3px solid {{ $color }}; text-align: center">
                <div class="SchoolBlock even">
                    <div class="SchoolBlock-image"> <p href="#" style="color: black; font-weight: bold"> <img src="{{ asset($school->logo) }}"  style="width: 150px; height: auto;"></p></div>
                    <div class="line"></div>
                    <div class="SchoolBlock-info"><a style="color: black; font-weight: 900; text-decoration: none" class="SchoolBlock-title" href="{{ route('details_school', ['slug' => $school->slug]) }}">{{ $school->name }}</a>
                        <p class="SchoolBlock-description">{{ $school->heading }}</p>
                    </div>
                </div>
{{--                <div style="height: 0.5rem; background-image: {{ $color }}"></div>--}}
            </td>
        @endforeach


    </tr>
    </thead>
    <tbody>
        <tr style=" border: 1px solid gray">
        <td style="font-width: bold; width: {{ $with_header }}%">Giới thiệu chung</td>
        @foreach($listSchool as $school)
{{--            <td><p style="font-size: 12px">{!! preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si",'<$1$2>', $school->summary_general_infor) !!}</p></td>--}}
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_general_infor) !!}</td>
        @endforeach

    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Thành phố</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_city) !!}</td>
        @endforeach
    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Thông tin nổi bật</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_highlight_infor) !!}</td>
        @endforeach
    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Chương trình học</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_study_program) !!}</td>
        @endforeach
    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Cơ sở vật chất</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_infrastructure) !!}</td>
        @endforeach
    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Học Phí</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_tuition) !!}</td>
        @endforeach
    </tr>

    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Học bổng</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_scholarship) !!}</td>
        @endforeach
    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Điều kiện đầu vào</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_required) !!}</td>
        @endforeach
    </tr>
    <tr style="border: 1px solid gray">
        <td style="width: {{ $with_header }}%">Feedback</td>
        @foreach($listSchool as $school)
            <td style="width: {{ $width_td }}%">{!! preg_replace("#font-family#","font-family-remove",$school->summary_feed_back) !!}</td>
        @endforeach
    </tr>
    </tbody>
</table>

</body>
</html>
