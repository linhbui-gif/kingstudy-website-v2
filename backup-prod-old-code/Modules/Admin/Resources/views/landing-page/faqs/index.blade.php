<div id="tab1" class="tabcontent faqs" style="display: block;">
    <h4 class="title-block">Danh sách câu hỏi</h4>
    <a href="<?=route('admin::landing-page-position.faqs.create',['landing_page_id' => $landing_page_id,'position_id' => $position_id])?>" class="pull-right link"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
    <div class="table-display">
        <div class="header_table">
            <div class="col-md-5">
                <div class="col-md-2">
                    <span>STT</span>
                </div>
                <div class="col-md-10">
                    <span>Câu hỏi</span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-8">
                    <span>Trả lời</span>
                </div>
                <div class="col-md-2 no-padding">
                    <span>Trạng thái</span>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <ul class="category_product">
            @foreach($objects['data'] as $index => $item)
            <li class="row">
                <div class="col-md-12">
                    <div class="col-md-1">
                        <span>{{$index+1}}</span>
                    </div>
                    <div class="col-md-3 no-padding content">
                        <span>{!!$item['question']!!}</span>
                    </div>
                    <div class="col-md-4 content">
                        <span>{!!$item['answer']!!}</span>
                    </div>
                    <div class="col-md-2">
                        <div class="wrapper tooltip">
                            <input type="checkbox" id="status-{{$index}}" class="slider-toggle" @if ($item['status']) checked @endif/>
                            <label class="slider-viewport" for="status-{{$index}}" onclick="return false;">
                                <div class="slider">
                                    <div class="slider-button">&nbsp;</div>
                                    <div class="slider-content left"><span>On</span></div>
                                    <div class="slider-content right"><span>Off</span></div>
                                </div>
                            </label>
                            <span class="tooltiptext">Chưa kích hoạt</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?=route('admin::landing-page-position.faqs.edit',['landing_page_id' => $landing_page_id,'position_id' => $position_id,'id' => $item['id']])?>" class="tooltip update-action">
                            <i class="icon-edit-pen active UpdateAction" aria-hidden="true"></i>
                            <i class="icon-edit-pen-hover UpdateHover" title="Chỉnh sửa">&nbsp</i>
                            <span class="tooltiptext">Cập nhật</span>
                        </a>
                        <a class="tooltip delete-action" data-id="{{$item['id']}}">
                            <i class="icon-delete active DeleteAction" aria-hidden="true"></i>
                            <i class="icon-delete-hover DeleteHover" title="Xóa">&nbsp</i>
                            <span class="tooltiptext">Xóa</span>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
            
        </ul>
        @include('admin::includes.paginator')
    </div>
</div>