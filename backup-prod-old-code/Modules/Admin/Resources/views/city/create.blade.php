@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin</h3>
            </div>
            @php
                $link = isset($id) ? route($controllerName . '.edit', ['id' => $id]) : route($controllerName . '.create');
            @endphp
            <form class="form-horizontal" method="post" id="form_update" action="{{ $link }}">
                <div class="panel-body overflow-hidden">
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Thành phố:<span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" name="name" value="{{@$object->name}}">
                                    <label id="name-error" class="error" for="name" style="display: none;"></label>
                            </div>
                        </div>
                        @php
                            $countries = \Modules\Admin\Entities\Country::select('id', 'name')->get()->pluck('name','id');
                            @endphp
                        <div class="form-group">
                            <div class="col-md-3 control-label">
                                <label>Quốc gia:<span class="required"></span></label>
                            </div>
                            <div class="col-md-8">
                                <select name="country_id" id="country_id" class="form-control select2">
                                    <option value="">-- Chọn quốc gia --</option>
                                    @if(isset($countries))
                                        @foreach($countries as $k => $country)
                                            @php
                                                $selected = $k == @$object->country_id ? 'selected' :'';
                                            @endphp
                                            <option {{$selected}} value="{{$k}}">{{$country}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-body -->
                <div class="panel-footer text-center">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" id="is_next" value="0">
                            <input type="hidden" name="id" id="id" value="0">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                            <a href="{{route($controllerName . '.index')}}" class="btn btn-info btn-rounded">
                                <i class="fa fa-undo" aria-hidden="true"></i> Trở về trang danh sách
                            </a>

                            <button type="submit" class="btn btn-primary btn-rounded" onclick="$('#is_next').val(0)">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu lại
                            </button>

                            <button type="reset" class="btn btn-default btn-rounded" onclick="$('#is_next').val(0)">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.panel -->
    </div>
@endsection

@section('after_styles')
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
@stop
@section('after_scripts')
@include('admin::includes.js-upload-image')
    <script type="text/javascript">
        $(document).ready(function () {

            initUpload('#fileupload_logo');
            initUpload('#fileupload_icon');

            @if($message=json_decode(session('message'), 1))
            show_pnotify("{!! $message['text'] !!}", "{!! $message['title'] !!}", "{!! $message['type'] !!}");
            @endif

            $('input.slider-toggle').each(function (key, msg) {
                if ($(this).is(':checked')) {
                    $(this).closest('div').find('.tooltiptext').text('Đã kích hoạt');
                } else {
                    $(this).closest('div').find('.tooltiptext').text('Chưa kích hoạt');
                }
            });

            $('#form_update').validate({
                ignore: ".ignore",
                rules: {
                    name: "required",
                    image_location_logo:'required',
                    image_location_icon:'required',
                },
                messages: {
                    name: "Name is not empty",
                    image_location_logo:'Chọn hình ảnh',
                    image_location_icon:'Chọn icon',
                },
                submitHandler: function (form) {
                    // do other things for a valid form
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            if (res.redirect_url) {
                                location.href = res.redirect_url;
                            } else {
                                location.reload();
                            }
                        } else if (res.errors) {
                            $.each(res.errors, function (key, msg) {
                                $('#' + key + '-error').html(msg).show();
                            });
                        }
                    });
                    return false;
                }
            });

        });
    </script>

@endsection
