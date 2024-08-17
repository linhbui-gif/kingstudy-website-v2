@extends('admin::layouts.master')

@section('content')
    <div id="page-content">
        <div class="panel panel-bordered-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?=$action?>
                    <a class="pull-right" href="<?=route($controllerName.'.index')?>"><i class="fa fa-reply"></i> Quay lại</a>
                </h3>
            </div>


            <form action="<?=route($controllerName.'.store')?>" class="frm_update" method="post" enctype="multipart/form-data">
                <div class="panel-body overflow-hidden row">
                    <div class="col-md-6">
                        @if(!isset($is_main) || !$is_main)
                            <div class="form-group">
                                <label for="parent_id">Danh mục cha: <span class="required"></span></label>
                                <select class="form-control select2" data-width="100%" id="parent_id" name="parent_id"
                                        data-placeholder="Chọn danh mục cha">
                                    <option value=""></option>
                                    @foreach($list_cate as $item)
                                        <option value="<?=$item['id']?>" <?=@($object['parent_id'] == $item['id']?'selected':'' )?> ><?=$item['name']?></option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Tên danh mục: <span class="required"></span></label>
                            <input type="text" class="form-control" name="name" id="name" value="<?=@$object['name']?>">
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Trạng thái
                            </label>
                            <div class="col-sm-9">
                                <?php
                                $status = (isset($object) && $object['status'] == '1') || !isset($object)?1:0;
                                ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" class="minimal-red" {{$status==1?'checked':''}}> Kích hoạt
                                    </label>
                                    <label>
                                        <input type="radio" name="status" value="0" class="minimal-red" {{$status==0?'checked':''}}> Ngừng kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">


                        <div class="form-group">
                            <label>Thứ tự hiển thị: <span class="required"></span></label>
                            <input type="number" class="form-control" name="ordering" id="ordering" value="<?=@$object['ordering']?>" min="0">
                        </div>
                    </div>

                </div>

                <div class="panel-footer text-center">
                    <div class="row">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="id" value="<?=@$object['id']?>">
                        <input type="hidden" id="is_next" value="0">

                        <button type="submit" class="btn btn-primary btn-rounded">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu lại</button>

                        <button type="button" class="btn btn-default btn-rounded btn-href" data-href="<?=route($controllerName.'.index')?>" >
                            <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ</button>
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
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        $(function(){
            init_select2('.select2');

            $('input.minimal-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            initUpload('#fileupload');

            $('.frm_update').validate({
                ignore: ".ignore",
                rules: {
                    parent_id:"required",
                    name:"required",
                    ordering: "required",
                },
                messages: {
                    parent_id:"Chọn danh mục cha",
                    name:"Nhập tên danh mục",
                    ordering: "Nhập thứ tự hiển thị",
                },
                submitHandler: function(form) {
                    // do other things for a valid form
                    var url = $(form).attr('action');
                    var data = $(form).serializeArray();
                    request_ajax(url, data, "POST", function (data) {
                        if(data.rs == 1)
                        {
                            alert_success(data.msg, function () {
                                if($('#is_next').val() == 1){
                                    location.reload();
                                }else{
                                    location.href = '<?=route("$controllerName.index")?>';
                                }

                            });
                        } else {
                            malert(data.msg);
                            if (data.errors) {
                                $.each(data.errors, function (key, msg) {
                                    $('#'+key+'-error').html(msg).show();
                                });
                            }
                        }
                    });

                    return false;
                }
            });
        })
    </script>
@endsection
