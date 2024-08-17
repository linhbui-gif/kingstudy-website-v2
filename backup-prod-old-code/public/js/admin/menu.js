let selectNode = "";
const MenuAction = {

    init : function () {
        const seft = this;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.select2').select2({
            allowClear: true,
        })
        seft.renderJsTree();
        seft.checkNavsClick();
        seft.buttonSubmitAction();
        seft.hideModalCreate();
        seft.eventOnSelect();
        seft.deleteButton();
        seft.buttonSubmitActionEdit();
        seft.searchMenuTree();
        seft.eventShowModal();
        seft.clearAlertMessKeyDown();
    },

    renderJsTree: function () {
        $('#menu-tree')
            .on('loaded.jstree', function () {
                $('#menu-tree').jstree('open_all');
            })
            .jstree({
                'core' : {
                    'multiple' : false,
                    'check_callback': false,
                    "themes" : { "stripes" : true },
                    'data' : function (node, cb) {
                        $.ajax({
                            "url" : node.id === "#" ? "/menu-item/getDataMenuParent"
                                :
                                node.id.indexOf("parent") > -1 ? "/menu-item/getDataMenuChildren?parentId=" + node.data.id
                                    :
                                    "/menu-item/getDataMenuGrandChildren?childrenId=" + node.data.id,
                            "success": function (datas) {
                                let dataRender = datas.success;
                                var jsonArr = [];
                                if (node.id === "#") {
                                    $.each(dataRender, function ( index, parent ) {
                                        var obj = {};
                                        obj.id = "parent" + parent.id;
                                        obj.text = parent.name;
                                        obj.parent = "#";
                                        obj.data = parent;
                                        obj.icon = "fa fa-pagelines";
                                        obj.children = true;
                                        jsonArr.push(obj);
                                    });
                                } else if (node.id.indexOf("parent") > -1) {
                                    $.each(dataRender, function ( index, item ) {
                                        var obj = {};
                                        obj.id = "children" + item.id;
                                        obj.text = item.name;
                                        obj.parent = "parent" + item.position_id;
                                        obj.icon = "fa fa-folder-open-o";
                                        obj.data = item;
                                        obj.children = true;
                                        jsonArr.push(obj);
                                    });
                                } else {
                                    $.each(dataRender, function ( index, item ) {
                                        var obj = {};
                                        obj.id = "grandChildren" + item.id;
                                        obj.text = item.name;
                                        obj.parent = "children" + item.parent_id;
                                        obj.icon = "fa fa-asterisk";
                                        obj.data = item;
                                        obj.children = false;
                                        jsonArr.push(obj);
                                    });
                                }
                                cb(jsonArr);
                            }
                        });
                    },
                },
                'plugins':['dnd','wholerow','search']
            });
    },

    /**
     * Check when drag menu
     */
    checkDragMenu: function () {
        $(document).on('dnd_stop.vakata',async function (e, data) {
            let element = data.element.id;
            let parTarget = data.event.target.id;
            let flagGrandchildrenTar = await /^grandChildren*/.test(parTarget);
            let flagGrandchildrenEl = await /^grandChildren*/.test(element);
            let flagChildrenTar = await /^children*/.test(parTarget);
            let flagChildrenEl = await /^children*/.test(element);
            let flagParentTar = await /^parent*/.test(parTarget);
            let flagParentEl = await /^parent*/.test(element);
            let flagDrag = true;

            if(flagChildrenEl && flagChildrenTar)
            {
                flagDrag = false;
            }
            if(flagGrandchildrenEl && flagParentTar)
            {
                flagDrag = false;
            }
            if(flagGrandchildrenTar && flagGrandchildrenEl)
            {
                flagDrag = false;
            }
            if(!flagDrag)
            {
                $('#menu-tree')
                    .off('.myevent')
                    .one('refresh.jstree', function () {
                        $('#menu-tree').on('changed.jstree.myevent', function (e, data)
                        {
                            var i, j, r = [];
                            for (i = 0, j = data.selected.length; i < j; i++) {
                                r.push(data.instance.get_node(data.selected[i].text));
                            }
                            let dataSelect = data.node.data;
                            let isGrandChilren = 0;
                            let isChilren = 0;
                            let regCheckGC = /grandChildren/g;
                            let regCheckC = /children/g;
                            let regCheckPR = /parent/g;
                            if(regCheckGC.test(data.node.id)){
                                isGrandChilren = 1;
                                $('#urlDetail').attr('style','display:block');
                            }
                            if(regCheckC.test(data.node.id)){
                                isChilren = 1;
                                $('#divUrlModal').attr('style','display:block');
                                $('#url_modal').attr('disabled',false);
                                $('#urlDetail').attr('style','display:none');
                                $('#imgDetail').attr('style','display:none');
                            }else{
                                $('#divUrlModal').attr('style','display:none');
                                $('#url_modal').attr('disabled',true);
                            }
                            $('#nameMenu').val(dataSelect.name);
                            $('#urlMenu').val(dataSelect.slug ? dataSelect.slug : '#');
                            if(regCheckPR.test(data.node.id)){
                                $('#imgDetail').attr('style','display:flex');
                                $('#urlDetail').attr('style','display:none');
                                $('#show-image').empty();
                                $('#show-image').append(`<img src="${dataSelect.image}"></img>`);
                            }
                            dataSelect.getMenuAttributes.forEach((item) => {
                                $('#myTabContent').find(`#${item.attribute_id}`).text(item.value)
                            });
                            $('#btnEdit').attr('menu-id', dataSelect.id);
                            $('#btnEdit').attr('parent-id', dataSelect.parent_id ? dataSelect.parent_id : "");
                            $('#btn_create_new_menu').attr('parent-id', dataSelect.id );
                            $('#btn_create_new_menu').attr('is-grandChilren',isGrandChilren);
                            $('#btn_create_new_menu').attr('is-chilren',isChilren);
                            $('#delete-menu').attr('menu-id', dataSelect.id);
                        });
                    })
                $('#menu-tree').jstree(true).refresh();
            }
            else
            {
                let menuId = element.replace(/\D/g,'');
                let tarId = parTarget.replace(/\D/g,'');
                let formData = new FormData;
                formData.append('targetId', tarId);
                formData.append('menuId', menuId)
                $.ajax({
                    type: "POST",
                    url: `/menus/editPosition`,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success) {
                            $('#toast-success').attr('data-message', data.success);
                            $('#toast-success').trigger('click');
                        } else {
                            $('#toast-errors').attr('data-message', data.error);
                            $('#toast-errors').trigger('click');
                        }
                    },
                });
            }
        });
    },

    eventOnSelect: function () {
        $('#menu-tree').bind('changed.jstree.myevent', function (e, data) {
            var i, j, r = [];
            for (i = 0, j = data.selected.length; i < j; i++) {
                r.push(data.instance.get_node(data.selected[i].text));
            }
            let dataSelect =  data.node.data;
            selectNode = data.node;
            let isGrandChilren = 0;
            let isChilren = 0;
            let regCheckGC = /grandChildren/g;
            let regCheckC = /children/g;
            let regCheckPR = /parent/g;
            if(regCheckGC.test(data.node.id)){
                isGrandChilren = 1;
            }
            if(regCheckC.test(data.node.id)){
                isChilren = 1;
            }
            $('#btn_create_new_menu').attr('parent-id', dataSelect.id );
            $('#btn_create_new_menu').attr('is-grandChilren',isGrandChilren);
            $('#btn_create_new_menu').attr('is-chilren',isChilren);
            $('#btnEdit').attr('menu-id', dataSelect.id);
            $('#btnEdit').attr('parent-id', dataSelect.parent_id ? dataSelect.parent_id : "");
            $('#deleteMenu').attr('menu-id', dataSelect.id);
            if(regCheckPR.test(data.node.id)){
                swal({
                    title: "Cảnh báo!",
                    text: "Không thể chỉnh sửa menu gốc!",
                    icon: "warning",
                });
                return;
            }
            $('#link').val(dataSelect.link);
            $('#type').val(dataSelect.type).trigger('change');
            $('#ordering').val(dataSelect.ordering);
            $('#page_id').val(dataSelect.page_id).trigger('change');
            $('#slug').val(dataSelect.slug ? dataSelect.slug : '#');
            dataSelect.getMenuAttributes.forEach((item) => {
                $('#myTabContent').find(`#locales-edit-${item.locale}`).text(item.name)
            });
        })
    },

    eventShowModal: function () {
        $(document).on('click', '#createButtonModal', function (e) {
            e.preventDefault();
            let regCheckGC = /grandChildren/g;
            if(regCheckGC.test(selectNode.id)){
                swal({
                    title: "Không thể tạo menu cấp 4!",
                    text: "Cảnh báo!",
                    icon: "warning",
                });
                return;
            }
            if (selectNode){
                $('#div-info-create').empty();
                let divInfo = `<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Menu Cha</label>
                                            <input type="text" class="form-control" value="${selectNode.data.name}" placeholder="Thứ tự" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên Alias</label>
                                            <input disabled type="text" name="slug-modal" id="slug-modal" class="form-control" placeholder="Alias sẽ được tự động tạo">
                                        </div>
                                    </div>
                                </div>`
                $('#div-info-create').append(divInfo);
                $('#modalCreateMenu').modal('show');
            }else{
                swal({
                    title: "Vui lòng chọn menu cần thêm!",
                    text: "Cảnh báo!",
                    icon: "warning",
                });
                return;
            }
        });
    },

    searchMenuTree: function (){
        var to = false;

        $('#searchMenu').keyup(function() {
            if (to) {
                clearTimeout(to);
            }
            to = setTimeout(function() {
                var v = $('#searchMenu').val();
                $('#menu-tree').jstree(true).search(v);
            }, 250);
        });
    },

    checkNavsClick: function () {
        $(document).on('click', '.tab-action', function (e) {
            e.preventDefault();
            $('.tab-action').removeClass("active");
            $(this).addClass("active");
        })
        $(document).on('click', '.tab-lang', function (e) {
            e.preventDefault();
            $('.tab-lang').removeClass("active");
            $(this).addClass("active");
        })
    },
    buttonSubmitAction: function () {
        $(document).on('click', '#btn_create_new_menu', function (e) {
            $('.error').html("");
            let form = $('#frm_create_menu');
            let inputValues = form.serializeArray();
            let formData = new FormData();
            let isVal = true;
            let parent_id = $(this).attr('parent-id');
            inputValues.forEach(function (item) {
                formData.append(item.name, item.value);
            })
            formData.append("parent_id", parent_id);
            formData.append("localesVi", $('#locales-vi').val());
            formData.append("isGrandChildren", $(this).attr('is-grandchilren'));
            formData.append("isChildren", $(this).attr('is-chilren'));
            if (!isVal) {
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "/menu-item/create",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success) {
                            $('#modalCreateMenu').modal('hide');
                            swal({
                                title: "Thành Công",
                                text: data.success,
                                icon: "success",
                                timer: 1500
                            }).then(() => {
                                window.location.href = "/menu-item";
                            });

                        }
                        if (data.errors) {
                            if(data.errors['type-modal']){
                                $('#type-modal-error').html(data.errors['type-modal'][0]);
                            }
                            if(data.errors['ordering-modal']){
                                $('#ordering-modal-error').html(data.errors['ordering-modal'][0]);
                            }
                            if(data.errors['page-modal']){
                                $('#page-modal-error').html(data.errors['page-modal'][0]);
                            }
                            if(data.errors['link-modal']){
                                $('#link-modal-error').html(data.errors['link-modal'][0]);
                            }
                            if(data.errors['localesVi']){
                                $('#localesVi-modal-error').html(data.errors['localesVi'][0]);
                            }
                        }
                    },
                });
            }
        })
    },

    buttonSubmitActionEdit: function () {
        $(document).on('click', '#btnEdit', function (e) {
            $('.error').html("")
            let form = $('#frm_update_menu');
            let inputValues = form.serializeArray();
            let formData = new FormData();
            let isVal = true;
            let parent_id = $(this).attr('parent-id');
            inputValues.forEach(function (item) {
                formData.append(item.name, item.value);
            })
            formData.append("parent_id", parent_id);
            formData.append("localesViEdit", $('#myTabContent').find('.locales-vi').val());
            formData.append("menuId", $(this).attr('menu-id'));
            formData.append("parentId", parent_id);

            if (!isVal) {
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "/menu-item/edit",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success) {
                            swal({
                                title: "Thành Công",
                                text: data.success,
                                icon: "success",
                                timer: 1500
                            }).then(() => {
                                window.location.href = "/menu-item";
                            });

                        }
                        if (data.errors) {
                            if(data.errors['type']){
                                $('#type-error').html(data.errors['type'][0]);
                            }
                            if(data.errors['ordering']){
                                $('#ordering-error').html(data.errors['ordering'][0]);
                            }
                            if(data.errors['link']){
                                $('#link-error').html(data.errors['link'][0]);
                            }
                            if(data.errors['page_id']){
                                $('#page_id-error').html(data.errors['page_id'][0]);
                            }
                            if(data.errors['localesViEdit']){
                                $('#localesViEdit-error').html(data.errors['localesViEdit'][0]);
                            }
                        }
                    },
                });
            }
        })
    },

    deleteButton: function () {
        $(document).on('click', '#deleteMenu', function (e) {
            e.preventDefault();
            let menuId = $(this).attr('menu-id');
            swal({
                title: "Xóa?",
                text: "Bạn chắc chắn muốn xóa menu này!!",
                icon: "warning",
                buttons: ['Hủy', 'Đồng ý'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        if (menuId) {
                            $.ajax({
                                type: "DELETE",
                                url: `/menu-item/${menuId}`,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    if (data.success) {
                                        swal({
                                            title: "Thành Công",
                                            text: data.success,
                                            icon: "success",
                                            timer: 1500
                                        }).then(() => {
                                            window.location.href = "/menu-item";
                                        });
                                    }
                                    if (data.error) {
                                        swal({
                                            title: "Lỗi",
                                            text: 'Không thể xóa!',
                                            icon: "error",
                                            timer: 1500
                                        })
                                    }
                                }
                            });
                        } else {
                            swal({
                                title: "Cảnh báo",
                                text: 'Vui lòng chọn menu cần xóa!',
                                icon: "warning",
                            })
                        }
                    }
                });
        });
    },

    hideModalCreate: function () {
        $('#modalCreateMenu').on('hidden.bs.modal', function (e) {
            $('.error').text("");
            $('#ordering-modal').val("");
            $('#type-modal').val("").trigger('change');
            $('#page-modal').val("").trigger('change');
            $('#link-modal').val("");
            $('.attributeMenu').val("");
        })
    },

    clearAlertMessKeyDown: function (){
        $('#link-modal').keydown(function(){
            $('#link-modal-error').text("");
        });
        $('#locales-vi').keydown(function(){
            $('#localesVi-modal-error').text("");
        });
        $('#type-modal').on("change",function(){
            $('#type-modal-error').text("");
        });
        $('#ordering-modal').keydown(function(){
            $('#ordering-modal-error').text("");
        });
        $('#link').keydown(function(){
            $('#link-error').text("");
        });
        $('.locales-vi').keydown(function(){
            $('#localesViEdit-error').text("");
        });
        $('#type').on("change",function(){
            $('#type-error').text("");
        });
        $('#ordering').keydown(function(){
            $('#ordering-error').text("");
        });
    }
};
MenuAction.init();
