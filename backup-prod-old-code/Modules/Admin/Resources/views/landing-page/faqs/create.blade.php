@extends('admin::layouts.home')

@section('content')
<div class="col-md-">
    <section class="section section-promotion">
        <h3 class="title-section">Quản lý landing pages</h3>
        <div class="panel box-panel">
            <div class="top">
                <h3 class="title TitleCreate"><?=$landing_page['name']?> > <?=$action?> câu hỏi</h3>
                <a href="<?=route('landing-page-position.index',['landing_page_id' => $landing_page_id,'position_id' => $position_id])?>" class="pull-right link" style=""><i class="fa fa-reply" aria-hidden="true"></i> Quay lại</a>
            </div>
            <form id="frm_faqs" action="<?=route('admin::faqs.store')?>">
                <div class="promotion" >
                    <div class="block">
                        <div class="form-group">
                            <label for="">Câu hỏi:</label>
                            <textarea class="form-control ckeditor" name="question" id="question" placeholder="Nhập câu hỏi"><?=@$object['question']?></textarea>
                            <label id="question-error" class="error" for="question" style="display: none;"></label>
                        </div>
                        <div class="form-group">
                            <label for="">Câu trả lời:</label>
                            <textarea class="form-control ckeditor" name="answer" id="answer" placeholder="Nhập câu trả lời"><?=@$object['answer']?></textarea>
                            <label id="answer-error" class="error" for="answer" style="display: none;"></label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-1 no-padding">
                                <label>Trạng thái <span class="required"></span></label>
                            </div>
                            <div class="col-md-11">
                                <div class="wrapper">
                                    <input value="0" type="hidden" name="status"/>
                                    <input value="1" type="checkbox" id="status" name="status" class="slider-toggle" <?= !isset($object['status']) || (isset($object['status']) && $object['status'] == 1) ?'checked':''?> />

                                    <label class="slider-viewport" for="status">
                                        <div class="slider">
                                            <div class="slider-button">&nbsp;</div>
                                            <div class="slider-content left"><span>On</span></div>
                                            <div class="slider-content right"><span>Off</span></div>
                                        </div>
                                    </label>
                                </div>
                                <span class="note">Chọn để kích hoạt trạng thái</span>
                            </div>
                        </div>
                        <div class="form-group wrap-btn text-right">
                            <input type="hidden" id="is_next" value="0">
                            <input type="hidden" name="id" id="id" value="<?=@$object['id']?>">
                            <input type="hidden" name="landing_page_id" id="landing_page_id" value="<?=$landing_page_id?>">
                            <input type="hidden" name="position_id" id="position_id" value="<?=$position_id?>">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <button type="submit" class="btn btn_primary BtnUpdate btnSave" onclick="$('#is_next').val(0)">Lưu</button>
                            <button type="submit" class="btn btn_primary BtnUpdate btnNext" onclick="$('#is_next').val(1)">Lưu & Thêm mới </button>
                            <a href="<?=route('admin::landing-page-position.index',['landing_page_id' => $landing_page_id,'position_id' => $position_id])?>"><span class="cancel Cancel">Hủy bỏ</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@stop
@section('after_scripts')
	@include('admin::includes.js-ckeditor')
    <script type="text/javascript">
    	$(function(){

    		$('#frm_faqs').validate({
                ignore: ".ignore",
                rules: {
                    question: "required",
                    answer: "required",
                },
                messages: {
                    question: "Nhập câu hỏi",
                    answer: "Nhập câu trả lời",
                },
                submitHandler: function(form) {
                    // do other things for a valid form
                    var data = $(form).serializeArray();
                    var url = $(form).attr('action');
                    request_ajax(url, data, "POST", function (res) {
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if(res.rs == 1){
                            if ($('#is_next').val()=='1') {
                                window.location = '<?=route('admin::landing-page-position.faqs.create',['landing_page_id' => $landing_page_id,'position_id' => $position_id])?>';
                            } else {
                                window.location = '<?=route('admin::landing-page-position.index',['landing_page_id' => $landing_page_id,'position_id' => $position_id])?>';
                            }
                        } else if(res.errors){
                            $.each(res.errors, function (key, msg) {
                                $('#'+key+'-error').html(msg).show();
                            });
                        }
                    });
                    return false;
                }
            });
    	})
    </script>
@stop
