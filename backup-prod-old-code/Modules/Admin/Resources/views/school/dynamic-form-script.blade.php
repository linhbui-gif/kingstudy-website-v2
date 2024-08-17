<script type="text/javascript">
    let arr1 = [
        {
            id: 1,
            name: 'tuition',
            container: 'container_tuition',
            name_modify: 'university'
        },
    ]
    let arr2 = [
        {
            id: 1,
            name: 'tuition',
            container: 'container_tuition_1',
            name_modify: 'after_university'
        },
    ]

    arr1 && arr1.map((item) => {
        $(`#add_content_${item?.name}`).click(function(e) {
            e.preventDefault();
            let items = 0;
            let container = `#${item?.container}`;
            let item_infor = $(container).find(`.${item?.name}_info_item`);
            if(item_infor.length === 0) {
                items = $(`.${item?.name}_info_item`).length + 1 ;
            }
            let last_index = $(`${container} .${item?.name}_info_item:last-child`).attr('data-index');
            if(last_index !== "" && Number(last_index) > 0) {
                items = Number(last_index) + 1
            }

            let html = ` <div class="form-group ${item?.name}_info_item" data-index="${items}">
                        <div class="col-md-6">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Title <span class="required"></span>
                            </label>
                            <div class="col-sm-8">
                            <input type="text" class='form-control' name="`+item?.name+`[${item?.name_modify}][group][`+items+`][title]"/>
                <label id="tution_info-error" class="error"
                       for="tution_info">{!! $errors->first("_info") !!}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Content <span class="required"></span>
                            </label>
                            <div class="col-sm-8">
                            <input type="text" class='form-control' name="`+item?.name+`[${item?.name_modify}][group][`+items+`][content]"/>
                <label id="${item?.name}_info-error" class="error"
                       for="${item?.name}_info">{!! $errors->first("_info") !!}</label>
                            </div>
                        </div>
                    </div>`
            $(container).append(html);
        })
    })
    arr2 && arr2.map((item) => {
        $(`#add_content_${item?.name}_1`).click(function(e) {
            e.preventDefault();
            let items = 0;
            let container = `#${item?.container}`;
            let item_infor = $(container).find(`.${item?.name}_1_info_item`);
            if(item_infor.length === 0) {
                items = $(`.${item?.name}_1_info_item`).length + 1 ;
            }
            let last_index = $(`${container} .${item?.name}_1_info_item:last-child`).attr('data-index');
            if(last_index !== "" && Number(last_index) > 0) {
                items = Number(last_index) + 1
            }
            let html = ` <div class="form-group ${item?.name}_info_item">
                        <div class="col-md-6">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Title <span class="required"></span>
                            </label>
                            <div class="col-sm-8">
                            <input type="text" class='form-control' name="`+item?.name+`[${item?.name_modify}][group][`+items+`][title]"/>
                <label id="tution_info-error" class="error"
                       for="tution_info">{!! $errors->first("_info") !!}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-3 control-label" for="form-field-1">
                                Content <span class="required"></span>
                            </label>
                            <div class="col-sm-8">
                            <input type="text" class='form-control' name="`+item?.name+`[${item?.name_modify}][group][`+items+`][content]"/>
                <label id="${item?.name}_info-error" class="error"
                       for="${item?.name}_info">{!! $errors->first("_info") !!}</label>
                            </div>
                        </div>
                    </div>`
            $(container).append(html);
        })
    })
</script>
