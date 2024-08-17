$(function () {
    $('.show-hide').on('click', function (e) {
        e.preventDefault();

        var tmp = $(this).attr('data-hide');
        $(tmp).slideUp();
        tmp = $(this).attr('data-show');
        $(tmp).slideDown();

        return false;
    });

    $( window ).resize(function() {
        $('#content-container').css('padding-top', $('#navbar').height());
    });
    $( window ).trigger('resize');

    if ($('span.number').length > 0) {
        $('span.number').each(function( index ) {
            $(this).html( numeral($(this).html()).format() );
        });
    }
    if ($('fm-number').length > 0) {
        $('fm-number').each(function( index ) {
            $(this).html( numeral($(this).html()).format() );
        });
    }
    if ($('.fm-number').length > 0) {
        init_fm_number('.fm-number');
    }
    $('button.btn-href').on('click',function(){
        window.location.href = $(this).data('href');
    });

    $('#limit').on('change', function(){
        var href = $(this).attr('data-href');
        location.href = updateUrlParameter('limit', $(this).val(), href);
    });

    $('[data-toggle="tooltip"]').tooltip();

    var browseImage = function() {
        $('.browse-image').click(function () {
            var name = $(this).attr('data-target');
            BrowseServer(name);
        });
    };
    browseImage();

    var browseImageList = function() {
        $('.browse-image-list').click(function () {
            var target = $(this).attr('data-target');
            BrowseServerList(target);
        });
    };
    browseImageList();
});

function updateUrlParameter(key, value, url){
    if (!url) url = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
        hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null)
            return url.replace(re, '$1' + key + "=" + value + '$2$3');
        else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            return url;
        }
    }
    else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            return url;
        }
        else
            return url;
    }
}

function BrowseServerList(target){
    var index = $(target).data('index') + 1;
    $(target).data('index',index);
    var name    = 'image_details_'+index;
    var preview = 'preview_image_details_'+index;
    var span = document.createElement('span');
    span.innerHTML =
        [
            '<img class="'+preview+'" style="height: 140px; border: 1px solid #2bc5f8; margin: 7px" title=""/>',
            '<input type="hidden" id="'+name+'" name="image_details[]" data-preview=".'+preview+'" >'
        ].join('');

    span.addEventListener('click', function (e) {
        if (e.offsetX > span.offsetWidth-15) {
            $(this).remove();
        }
    });

    $(target).append(span);

    var config = {};
    config.startupPath = 'Images:/banner/';
    var finder = new CKFinder(config);
    finder.selectActionFunction = SetFileField;
    finder.selectActionData = name;
    finder.callback = function( api ) {
        api.disableFolderContextMenuOption( 'Batch', true );
    };
    finder.popup();
}

function BrowseServer(name) {
    var config = {};
    config.startupPath = 'Images:/banner/';
    var finder = new CKFinder(config);
    finder.selectActionFunction = SetFileField;
    finder.selectActionData = name;
    finder.callback = function( api ) {
        api.disableFolderContextMenuOption( 'Batch', true );
    };
    finder.popup();
}

function SetFileField(fileUrl, data) {
    var name = '';
    try {
        var hostname = (new URL(fileUrl)).hostname;
        name = fileUrl.split(hostname);
        name = name[name.length - 1];
    } catch (_) {
        name = fileUrl;
    }

    $('#' + data["selectActionData"]).val(name).trigger('change');

    var preview = $('#' + data["selectActionData"]).attr('data-preview');
    $(preview).attr('src', _base_url + name);

    preview = $('#' + data["selectActionData"]).attr('data-url');
    $(preview).val('');
}

function ajax_loading(show) {
    if ($('#bg-load').length == 0) {
        $('body').append('<div id="bg-load" class="wrap-loader"><div id="container"><div id="loader" class="loader"></div></div></div>');
    }
    if (show) {
        $('#bg-load').show();
    } else {
        $('#bg-load').hide();
    }
}

function malert(msg, title, callback, sbcallback, alert) {
    title = title || 'Thông báo';
    callback = callback || function (e) {};
    alert = alert || 'alert-success';

    if (jQuery("#modal_alert").attr('id') != 'modal_alert') {
        var html = ''+
            '<div class="modal fade" id="modal_alert" role="dialog" aria-labelledby="myModalLabel">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="pci-cross pci-circle"></i></button>' +
            '<h4 class="modal-title">Thông báo</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>Thành công!</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check" aria-hidden="true"></i> Đồng ý</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> Thoát</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        jQuery( "body" ).append(html);
    }
    $("#modal_alert .btn-success").unbind( "click" );
    if (sbcallback) {
        $("#modal_alert .modal-footer").show();
        $("#modal_alert .btn-success").bind( "click", sbcallback );
    } else {
        $("#modal_alert .modal-footer").hide();
    }

    $("#modal_alert .modal-title").html(title);
    $("#modal_alert .modal-body").html('<div class="alert '+alert+'" role="alert">'+msg+'</div>');

    $('#modal_alert').modal('show');
    $('#modal_alert').on('hidden.bs.modal', callback);
}
function alert_warning(msg, title, callback, sbcallback) {
    malert(msg, title, callback, sbcallback, 'alert-warning');
}
function alert_danger(msg, title, callback, sbcallback) {
    malert(msg, title, callback, sbcallback, 'alert-danger');
}
function alert_success(msg, callback) {
    malert(msg, null, callback, null, 'alert-success');
}
function show_pnotify(_message, _title, _type) {
    _title = _title || 'Thông báo';
    _message = _message || 'success';

    new PNotify({
        title: _title,
        text: _message,
        type: _type
    });
}
function confirm_delete(msg, callback, icon) {
    msg = msg || 'Bạn có muốn xóa nội dung này?';
    callback = callback || function (e) {};
    icon = icon || 'icon_delete';
    alert_danger(msg, 'Xác nhận xóa', null, callback);
}
function init_select2(element) {
    $(element).select2({allowClear: true, width: "100%" });
}
function init_datetimepicker(element) {
    $(element).datetimepicker({
        format: "HH:mm DD/MM/YYYY"
    });
}
function init_clockpicker(element) {
    $(element).clockpicker({
        autoclose: true
    });
}
//Date picker
function init_datepicker(element, format) {
    var format = format || 'dd-mm-yyyy';
    $(element).datepicker({
        autoclose: true,
        format: format
    });
}
function formatDate(value, row, index) {
    if(value != null)
    {
        return moment(value).format('DD-MM-YYYY');
    }
    return value;
}
function init_fm_number(element) {
    $(element).on('keyup', function(event) {
        if (event.keyCode == 190 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40)
        {
            return;
        }

        var tmp = numeral( $(this).val() );
        $(this).val(tmp.format());
        if (tmp = $(this).attr('data-target')) {
            $(tmp).val(numeral( $(this).val() ).value()).valid();
        }
        if (tmp = $(this).attr('data-display')) {
            $(tmp).html(numeral( $(this).val() ).format())
        }
    });

    $(element).each(function( index ) {
        $(this).val( numeral($(this).val()).format() );
    });
}



function request_ajax(url, data, method, done_callback) {
    ajax_loading(true);

    $.ajax({
        method: method,
        url: url,
        dataType: 'json',
        data: data
    })
        .done(function (res) {
            ajax_loading(false);
            done_callback(res)
        })
        .fail(function (res) {
            ajax_loading(false);

            if (res.status == 403) {
                show_pnotify('Bạn không có quyền thực hiện tính năng này. Vui lòng liên hệ Admin!');
            } else if (res.status == 419) {
                location.reload();
            } else {
                if (done_callback) {
                    return done_callback(res.responseJSON);
                }
            }
        });
    return false;
}
function init_select_time_home(element, show_time) {
    $(element).on('change', function(){
        var option = $(this).val();
        var from, to, type;
        switch(option) {
            case 'to_day':
                type = 'hour';
                from = moment().format("DD-MM-YYYY");
                to = from;
                break;
            case 'this_week':
                type = 'day';
                from = moment().startOf('week').add('d', 1).format("DD-MM-YYYY");
                to = moment().format("DD-MM-YYYY");
                break;
            case 'this_month':
                type = 'day';
                from = moment().startOf('month').format("DD-MM-YYYY");
                to = moment().format("DD-MM-YYYY");
                break;
            case 'this_year':
                type = 'month';
                from = moment().startOf('year').format("DD-MM-YYYY");
                to = moment().format("DD-MM-YYYY");
                break;
            case 'last_year':
                type = 'month';
                from = moment().startOf('year').subtract(1, 'y').format("DD-MM-YYYY");
                to = moment().startOf('year').subtract(1, 'd').format("DD-MM-YYYY");
                break;
            default:
                from = '';
                to = '';
                break;
        }

        $(show_time).html(from+' - '+to);
        $.get(_base_url+'/total-revenue', {from:from, to:to, type:type}, function (data) {
            // var daTacuata = [28, 48, 40, 19, 86, 27, 90];
            // var labelscuata = ["0", "01/12/16", "01/01/17", "01/02/17", "01/03/17", "01/03/17", "01/04/17"];
            init_chart_revenue(data.revenue, data.group_date);
        }, 'json');
    });
}
function init_datepicker_year(element) {
    $(element).datepicker({
        format: 'yyyy',
        viewMode: "years",
        minViewMode: "years"
    });
}

function initSwitchery(element_id) {
    var changeCheckbox = document.getElementById(element_id), changeField = document.getElementById(element_id+'-field');
    new Switchery(changeCheckbox)
    changeField.innerHTML = changeCheckbox.checked ? $('#'+element_id).attr('data-true') || 'Có' : $('#'+element_id).attr('data-false') || 'Không';
    changeCheckbox.onchange = function() {
        changeField.innerHTML = changeCheckbox.checked ? $('#'+element_id).attr('data-true') || 'Có': $('#'+element_id).attr('data-false') || 'Không';
    };
}

function init_select_hours(element) {
    $(element).timepicker({
        minuteStep: 5,
        showInputs: false,
        showMeridian: false,
        disableFocus: true
    });
}
function get_provinces(destination) {
    destination = destination || '#province_id';
    var id = $(destination).attr('data-id');
    var select2 = $(destination).hasClass('select2');

    $.get(_base_url+'/admin/location/get-provinces', function (res) {
        var html = '<option value="">Chọn Tỉnh / Thành phố</option>';
        if(select2) {
            html = '<option value=""></option>';
        }
        $.each(res.data, function( id, name ) {
            html += '<option value="'+id+'">'+name+'</option>';
        });
        $(destination).html(html).val(id).trigger('change');
    }, 'json');
}
function get_districts_by_province(obj_province, select2) {
    var select2 = select2 || false;
    var destination = $(obj_province).attr('data-destination');
    var id = $(destination).attr('data-id');

    $.get('/admin/location/get-districts', {province_id: $(obj_province).val()}, function (res) {
        var html = '<option value="">Chọn Quận / Huyện</option>';
        $.each(res.data, function( id, name ) {
            html += '<option value="'+id+'">'+name+'</option>';
        });
        $(destination).html(html).val(id).trigger('change');

        if (select2) init_select2(obj_province);

    }, 'json');
}
function get_wards_by_district(obj_district) {
    var destination = $(obj_district).attr('data-destination');
    var id = $(destination).attr('data-id');

    $.get('/admin/location/get-wards', {district_id: $(obj_district).val()}, function (res) {
        var html = '<option value="">Chọn Phường / Xã</option>';
        $.each(res.data, function( id, name ) {
            html += '<option value="'+id+'">'+name+'</option>';
        });
        $(destination).html(html).val(id);
    }, 'json');
}

function get_streets_by_district(obj_district) {
    var destination = $(obj_district).attr('data-destination-street');
    var id = $(destination).attr('data-id');

    $.get('/location/get-streets', {district_id: $(obj_district).val()}, function (res) {
        var html = '<option value="">Chọn Đường</option>';
        $.each(res.data, function( id, name ) {
            html += '<option value="'+id+'">'+name+'</option>';
        });
        $(destination).html(html).val(id);
    }, 'json');
}
function init_daterange(element) {
    $(element).datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });
}
function init_datepicker_month(element, format) {
    format = format || "mm-yyyy";

    $(element).datepicker({
        format: format,
        startView: "months",
        minViewMode: "months",
        language: "vi"
    });
}

function init_datepicker_year(element, format) {
    format = format || "yyyy";

    $(element).datepicker({
        format: format,
        startView: "years",
        minViewMode: "years",
        language: "vi"
    });
}
function formatStt(value, row, index) {
    return index+1;
}
function formatNumber(value, row, index) {
    return numeral(value).format();
}
function frmDate(value, row, index) {
    if(value != null)
    {
        return moment(value).format('DD/MM/YYYY');
    }
    return value;
}

function formatDateTime(value, row, index) {
    if(value != null)
    {
        return moment(value).format('HH:mm DD/MM/YYYY');
    }
    return value;
}
function formatHtmlEntities(value, row, index) {
    return htmlEntities(value||'-');
}

var __entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
};
function htmlEntities(value) {
    return String(value).replace(/[&<>"'`=\/]/g, function (s) {
        return __entityMap[s];
    });
}
function insertTextToTextarea(el, newText) {
    var start = el.prop("selectionStart")
    var end = el.prop("selectionEnd")
    var text = el.val()
    var before = text.substring(0, start)
    var after  = text.substring(end, text.length)
    el.val(before + newText + after)
    el[0].selectionStart = el[0].selectionEnd = start + newText.length
    el.focus()
    return false;
}
function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

/**
 *
 * @param data
 * @param action
 * @param action_refuse
 * @param callback
 * @param csrf_token
 */
function confirmEmployee(data, action,action_refuse, callback, csrf_token) {
    callback = callback || function (e) {};
    var employee = data.employee;
    var agents = data.agents;
    var select = '';
    var html = `
        <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Chi tiết chuyên viên</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-verify-agent">
                    <input type="hidden" name="_token" value="${csrf_token}" >
                    <div class="employee-base">
                        <div class="img-block">
                           <div>
                                  <img src="${employee.face_image !== null  ? employee.face_image  : '/images/user.png'}" alt="">
                            </div>
                        </div>
                        <div class="employee-name">
                           <h5>${employee.fullname}</h5>
                           <p>${employee.role !== null && typeof employee.role[0] == "object" && Object.keys(employee.role[0]).length > 0 ? employee.role[0].name : 'Thông tin rỗng'}</p>
                        </div>
                    </div>
                    <div class="block-employee-detail">
                         <div class="row">
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">SDT</label>
                                    <p class="detail">${employee.phone !== null ? employee.phone : '_'}</p>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">CMND/CCCD</label>
                                    <p class="detail">${employee.id_card_number !== null ? employee.id_card_number : 'Thông tin rỗng'}</p>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">Giới tính</label>
                                    <p class="detail">${employee.gender !== null ? employee.gender : 'Thông tin rỗng'}</p>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">Email</label>
                                    <p class="detail">${employee.email !== null ? employee.email : 'Thông tin rỗng'}</p>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">Ngày sinh</label>
                                    <p class="detail">${employee.birthday !== null ? formatDate(employee.birthday) : 'Thông tin rỗng'}</p>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">Địa chỉ</label>
                                    <p class="detail">${employee.employee_address !== null ? employee.employee_address : 'Thông tin rỗng'}</p>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">Đại lý</label>
                                    <select name="agent_id" id="agent-list">
                                        <option value="">Đại lý</option>
                                        ${
        agents.forEach(function (item) {
            select += `<option value="${item.id}" ${item.id == employee.agent_id ? 'selected': ''}>${item.name}</option>`;
        })}
                                        ${select}
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="employee-detail-item">
                                    <label class="label-item">Người giới thiệu</label>
                                    <p class="detail">${employee.presenter_name !== null ? employee.presenter_name : 'Thông tin rỗng'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-employee-introduce">
                      <h5>Giới thiệu</h5>
                      <p>${employee.introduce !== null ? employee.introduce : 'Thông tin rỗng'}</p>
                    </div>
                    <div class="block-indentify-employee">
                        <h5>Hình ảnh CMND/CCCD</h5>
                        <div class="wrapper-identify-image">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="img-box">
                                     <div>
                                        <img src="${employee.front_id_card_image !== null ?  employee.front_id_card_image : '/images/default.png'}" alt="identify-image-front">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                     <div>
                                        <img src="${employee.back_id_card_image !== null  ?  employee.back_id_card_image : '/images/default.png'}" alt="identify-image-back">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <div class="btn-left">
                    <a href="">Report</a>
                </div>
                <div class="btn-right">
                    <button type="button" class="btn btn-warning btn-refuse">Từ chối</button>
                    <button type="button" class="btn btn-primary btn-verify">Xác thực</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        `;
    $("#modal_confirm").remove();
    jQuery( "body" ).append(html);
    init_select2('#agent-list', 'Đại lý')
    $("#modal_confirm .btn-verify").on( "click" , function () {
        var $form = $('#form-verify-agent');
        var data = $form.serializeArray();
        var url = action;
        request_ajax(url, data, "POST", function (data) {
            if(data.rs == 1)
            {
                $('#modal_confirm').modal('hide');
                alert_success(data.msg, function () {
                    setTimeout(function () {
                        location.href = '/human/index';
                    }, 1000);
                });
            } else {
                $('#modal_confirm').modal('hide');
                alert_danger(data.msg, function () {
                    setTimeout(function () {
                        location.href = '/human/index';
                    }, 1000);
                });
            }
        });

        return false;
    });

    $("#modal_confirm .btn-refuse").on( "click" , function () {
        $('#modal_confirm').modal('hide');
        refuseEmployee(action_refuse,csrf_token);
    });


    $('#modal_confirm').modal('show');
    $('#modal_confirm').on('hidden.bs.modal', callback);
}

/**
 *
 * @param action
 * @param csrf_token
 */
function refuseEmployee(action, csrf_token) {
    var html = `
        <div class="modal fade" id="modal_refuse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Lý do từ chối</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-refuse-agent">
                    <input type="hidden" name="_token" value="${csrf_token}" >
                    <div class="form-group">
                        <input type="text" class="form-control" name="note" placeholder="Lý do từ chối">
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-complete">Hoàn thành</button>
              </div>
            </div>
          </div>
        </div>
        `;
    $("#modal_refuse").remove();
    jQuery( "body" ).append(html);
    $('#modal_refuse').modal('show');
    $("#modal_refuse .btn-complete").on( "click" , function () {
        var $form = $('#form-refuse-agent');
        var data = $form.serializeArray();
        var url = action;
        request_ajax(url, data, "POST", function (data) {
            if(data.rs == 1)
            {
                $('#modal_refuse').modal('hide');
                alert_success(data.msg, function () {
                    setTimeout(function () {
                        location.href = '/human/index';
                    }, 1000);
                });
            } else {
                $('#modal_refuse').modal('hide');
                alert_danger(data.msg, function () {
                    setTimeout(function () {
                        location.href = '/human/index';
                    }, 1000);
                });
            }
        });

        return false;
    });
}
