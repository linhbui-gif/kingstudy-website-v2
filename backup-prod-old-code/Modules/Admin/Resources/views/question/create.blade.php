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
            <form class="form-horizontal" method="post" id="form_update" action="{{ $link }}" enctype="multipart/form-data">
                <div class="panel-body overflow-hidden">
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="col-md-2 control-label" style="display:block;text-align: left;">
                                <label>Câu hỏi: <span class="required"></span></label>
                            </div>
                            <div class="col-md-10">
                                <div style="float:left;width:100%">
                                    <textarea name="name" id="question_id" class="form-control">{{@$object['name']}}</textarea>
                                    <label id="question_id-error" class="error" for="question_id" style="display: none;"></label>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-md-2 control-label" style="text-align: left;">
                                <label>Đáp án: <span class="required"></span></label>
                            </div>
                            <div class="col-md-10" id="custom-container-answer">
                                @if(isset($object))
                                        @foreach($answers as $k => $val) 
                                            @php 
                                                $checked = $val->is_correct == 1 ? 'checked' :'';
                                            @endphp
                                            <div class="custom-box-answer">
                                                <input {{$checked}} type="radio" required name="stt_correct" value="{{$k}}" class="cate_id">
                                                <input type="hidden" name="arrId[]" value="{{$val->id}}">
                                                <input name="answer_name[]" type="text" value="{{$val->answer_name}}" class="answer_name form-control">
                                                <div>
                                                    <a onclick="javascript:del_answer({{$val->id}})" class="add-tooltip btn btn-danger btn-xs btn-delete del_answer" data-placement="top" data-original-title="Xóa"><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                @endif
                            </div>
                        </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Trạng thái
                        </label>
                        <div class="col-sm-9">
                            <?php
                                $status = isset($object) ? old('status', @$object['status']) : 1;

                            ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" value="1"
                                           class="minimal-red" {{$status==1?'checked':''}}> Kích hoạt
                                </label>
                                <label>
                                    <input type="radio" name="status" value="0"
                                           class="minimal-red" {{$status==0 ?'checked':''}}> Ngừng kích hoạt
                                </label>
                            </div>
                        </div>
                    </div> 
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            @if(isset($object))
                                <div class='form-group add_answer_group_class' >
                                    <div class="col-md-12">
                                        <input min="0" placeholder="Nhập số lượng đáp án" id="add_answer" inputmode="numeric" name='number_valid'  type="text" class="form-control">
                                        <a class="btn" id="add_answer_edit">Thêm đáp án: </a>
                                        <input type="hidden" id="old_val" value = "0"/>
                                        <input type="hidden" id="total_oldVal" = value="0">  
                                    </div>
                                </div>                                  
                            @else 
                                <div class='form-group add_answer_group_class' id="add_answer_group">
                                    <div class="col-md-12">
                                        <input min="0"  placeholder="Nhập số lượng đáp án" id="quantites_answer" name='number_valid'  type="text" class="form-control">
                                        <a class="btn" id="add_answer_add">Thêm đáp án: </a>                                           
                                    </div>
                                </div>
                            @endif
                        </div>
                        @php 
                        @endphp
                        <div class="form-group">
                            <label class="control-label">Danh mục câu hỏi: <span class="required"></span></label>
                            <select  name="category_id" id="category_id" class="form-control">
                                <option value="">-- Danh mục câu hỏi --</option>
                                @if(isset($categories)) 
                                    @foreach($categories as $k => $category)
                                        @php 
                                        $selected = $category->id == @$object->category_id ? 'selected' : '';
                                        @endphp
                                        <option {{$selected}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
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
    <script>
          function del_answer(id) {
            if(id>0) {
                if(confirm('Do you want to delete this item ?')) {
                    $.ajax({
                      url:'{{route('admin::question.delete')}}',
                      type:"POST",
                      data:{answer_id : id},
                      success:function(data) {
                            if(data.rs = 1 ) {
                                show_pnotify(data.msg, "Thông báo", data.rs ? 'success' : 'error');
                                setTimeout(location.reload(),1000);
                            }
                      },
                      error:function() {
                        alert('Error')
                      }
                    });
                }
            }
        }
    </script>
@endsection

@section('after_styles')
    <link href="/assets/plugins/iCheck/flat/green.css" rel="stylesheet">
@stop
@section('after_scripts')
    
    @include('admin::includes.js-summernote')
    {{-- <script src="/assets/plugins/iCheck/icheck.min.js"></script> --}}

    <script type="text/javascript">
        var _positions = {!! @json_encode($positions) !!};
        $('#category_id').select2();
        $(document).ready(function () {
            let value_answer = $('#value_answer').val()
            $('body textarea').summernote({minHeight:150,value_answer});
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
                    is_correct: 'required',
                    "answer_name[]": 'required',
                    category_id:'required',
                    number_valid:'number',
                },
                messages: {
                    name: "Vui lòng nhập câu hỏi ? ",
                    is_correct: 'Chọn đáp án đúng',
                    "answer_name[]": 'Nhập đáp án',
                    category_id: 'Chọn nhóm câu hỏi',
                    number_valid: 'Nhập số lượng đáp án',
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
             $('.note-editable').keyup(function() {
                    $('#question_id-error').remove();
             })
             $('#category_id').change(function() {
                    $('#category_id-error').remove();
             })
             $("#add_answer_add").click(function() {
                let quantites_input = $('#quantites_answer').val();
                let str = [];
                if(quantites_input >= 0) {
                    for(let i = 0 ; i < quantites_input;i++) {
                      str[i] = '<div class="custom-box-answer"><input type="radio" value="'+i+'" name="is_correct" class="cate_id" value=""><input  id="answer_name_'+i+'" required name="answer_name[]" class="answer_name form-control type ="text" placeholder="Nhập câu trả lời""><label id="answer_name-error" class="error" for="answer_name_'+i+'" style="display: none;"></label></div>';
                    }   
                    $('#custom-container-answer').html(str.join(' '));
                    }
            })

             // Edit 
            $('#add_answer').change(function() {
                let list_anser = document.querySelectorAll('.custom-box-answer input[type=radio]');
                let last       = list_anser.length;
                let current_val     = $(this).val();
                let oldVal          = $('#old_val').val();
                let total_oldVal    = $('#total_oldVal').val();
                 if(current_val > oldVal){
                       $("#old_val").val(current_val);
                       let total = Number(total_oldVal) + Number(current_val);
                       $('#total_oldVal').val(total);
                       // let newVal = $("#v").val(); 
                       for(let i =0;i < current_val ;i++) {
                         let last_ = last + i;
                         $('#custom-container-answer').append('<div class="custom-box-answer"><input type="radio" value="'+last_+'" name="stt_correct" class="cate_id" required value=""><input type="hidden" name="arrId[]" value="{{null}}"><input required name="answer_name[]" class="form-control" id="answer_name_'+i+'" value="" type ="text" placeholder="Nhập câu trả lời"><label id="answer_name-error" class="error" for="answer_name_'+i+'" style="display: none;"></label></div>')
                       }
                    }else {
                        if(current_val > 0) {
                            for(let i =0;i < current_val ;i++) {
                                let last_ = last + i;
                                 $('#custom-container-answer').append('<div class="custom-box-answer"><input type="radio" value="'+last_+'" name="stt_correct" required class="cate_id" value=""><input type="hidden" name="arrId[]" value="{{null}}"><input name="answer_name[]" id="answer_name_'+i+'" required class="form-control" value="" type ="text" placeholder="Nhập câu trả lời"><label id="answer_name-error" class="error" for="answer_name_'+i+'" style="display: none;"></label></div>')
                            } 
                           for(let i=0;i < total_oldVal ;i++) {
                            let item = document.getElementById('custom-container-answer').lastChild;
                            item.remove();
                            } 
                            $('#total_oldVal').val(current_val);
                        }else {
                            for(let i=0;i < total_oldVal  ;i++) {
                            let item = document.getElementById('custom-container-answer').lastChild;
                            item.remove();
                            } 
                        }
                        $("#old_val").val(current_val);
                    }
                })
          
        });
    </script>
    <style type="text/css">
        .custom-box-answer{
            display:flex;
            margin-bottom:16px;
        }
        .custom-box-answer .cate_id {
            margin-right:10px;
        }
        .custom-box-answer a {
            margin-left:10px;
        }
        .add_answer_group_class a {
            margin-top:16px;
            border-radius: 6px;
            background-image: radial-gradient(100% 100% at 100% 0, #5adaff 0, #5468ff 100%);
            color:white;
        }
        .add_answer_group_class a:hover{
            opacity: 0.8 !important;
            color:white !important;
            font-size:14px;
        }
        .panel-body input, select {
            border-radius: 10px;
        }
        #answer_name-error {
            margin-left:16px;
            margin-bottom:10px;
/*            margin-top:-20px;*/
        }
        #container_radio_{
            display:flex;
            flex-direction: column;
            align-items: center;
        }
        #container_radio_ input {
            height:200px;
        }
    </style>
  
@endsection
