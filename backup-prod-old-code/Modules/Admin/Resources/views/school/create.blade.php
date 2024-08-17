@extends('admin::layouts.master')
<?php
$action_name = isset($action) ? 'Thông tin của bạn' : (isset($id) ? 'Cập nhật' : 'Thêm mới');
?>
@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-header with-border">
                <h3 class="panel-title"><?=$action_name?> {{isset($action)?'':$title}}</h3>
            </div>
            <!-- /.panel-header -->
            <!-- form start -->
            <?php
            $link = isset($id) ? route($controllerName . '.edit', ['id' => $id]) : route($controllerName . '.create');
            if (isset($action) && $action == 'profile') {
                $link = '';
            }
            ?>
         <form id="frm-add" method="POST" action="<?=$link?>" class="form-horizontal" enctype='multipart/form-data'>
            <div class="panel-body">
                {{-- tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom: 20px;">
                      <li class="nav-item active">
                        <a class="nav-link " id="general_information-tab" data-toggle="tab" href="#general_information" role="tab" aria-controls="general_information" aria-selected="true">Thông tin chung</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Thông tin chi tiết</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="education_program-tab" data-toggle="tab" href="#education_program" role="tab" aria-controls="education_program" aria-selected="false">Cơ sở vật chất</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tuition-tab" data-toggle="tab" href="#tuition" role="tab" aria-controls="tuition" aria-selected="false">Học phí & học bổng</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="false">Khóa học</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" id="input-required-tab" data-toggle="tab" href="#input-required" role="tab" aria-controls="input-required" aria-selected="false">Yêu cầu đầu vào</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Thư viện ảnh</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="feedback-tab" data-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Feed Back</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false">Meta</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="survey-tab" data-toggle="tab" href="#survey" role="tab" aria-controls="survey" aria-selected="false">Khảo sát</a>
                      </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="general_information" role="tabpanel" aria-labelledby="general_information-tab">
                          @include('admin::school.general-information');
                      </div>
                      <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                          @include('admin::school.details')
                      </div>
                      <div class="tab-pane fade" id="education_program" role="tabpanel" aria-labelledby="education_program-tab">
                          @include('admin::school.education-program')
                      </div>
                      <div class="tab-pane fade" id="tuition" role="tabpanel" aria-labelledby="tuition-tab">
                          @include('admin::school.tuition')
                      </div>
                       <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab">
                          @include('admin::school.course')
                      </div>
                       <div class="tab-pane fade" id="input-required" role="tabpanel" aria-labelledby="input-required-tab">
                          @include('admin::school.input-required')
                      </div>
                      <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                          @include('admin::school.gallery')
                      </div>
                       <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                          @include('admin::school.feedback')
                      </div>
                      <div class="tab-pane fade " id="meta" role="tabpanel" aria-labelledby="meta-tab">
                        @include('admin::school.meta')
                      </div>
                      <div class="tab-pane fade " id="survey" role="tabpanel" aria-labelledby="survey-tab">
                        @include('admin::school.survey')
                      </div>
                </div>
                {{-- end tabs --}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-1">Trạng thái: </label>
                        <div class="col-sm-9">
                            <label class="control" style="padding-right: 20px; margin: 7px">
                                <input class="flat" type="radio" name="status" value="1" <?=@$object['status'] == 1 ? 'checked' : ''?>>
                                       Kích hoạt
                            </label>
                            <label class="control">
                                <input class="flat" type="radio" name="status" value="0" <?=@$object['status'] == 0 ? 'checked' : ''?>>
                                       Ngừng kích hoạt
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="col-sm-6 text-right">
                            <a href='{!! route($controllerName.'.index') !!}'
                               class="btn btn-success btn-rounded pull-left"><i class="fa fa-arrow-left"></i>Quay lại</a>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-rounded"><i class="fa fa-save"></i> Lưu lại</button>
                            <button type="reset" class="btn btn-default btn-rounded"><i class="fa fa-refresh"></i> Làm
                                lại
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.panel-footer -->
            </form>
        </div>
    </div>
@endsection

@section('before_styles')
@endsection
@section('after_scripts')
    @include('admin::school.school-script');
@endsection
