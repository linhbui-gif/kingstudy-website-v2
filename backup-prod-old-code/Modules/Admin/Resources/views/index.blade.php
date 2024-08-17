@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="col-md dashborad">

            <section class="top">
                <div class="wrap-col">
                    <div class="col-chart">
                        <a href="#">
                            <div class="one-box box-finish">
                                <div class="inside">
                                    <p>Học viên</p>
                                    <span class="number">{{number_format(@$students)}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-chart">
                        <a href="#">
                            <div class="one-box box-finish">
                                <div class="inside">
                                    <p>Trường học</p>
                                    <span class="number">{{number_format(@$schools)}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-chart">
                        <a href="#">
                            <div class="one-box box-finish">
                                <div class="inside">
                                    <p>Tổng số hồ sơ</p>
                                    <span class="number">{{number_format(@$profile_submited)}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
