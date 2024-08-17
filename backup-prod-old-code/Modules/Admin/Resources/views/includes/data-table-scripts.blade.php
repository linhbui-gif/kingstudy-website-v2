<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
<!-- Latest compiled and minified Locales -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-vi-VN.min.js"></script>
<script>

    /*-----Start All function format-----*/
    function formatDateDay(value, row, index) {
        if(value != null)
        {
            return moment(value).format('DD-MM-YYYY');
        }
        return value;
    }

    function formatDate(value, row, index) {
        if(value != null)
        {
            return moment(value).format('HH:mm:ss DD-MM-YYYY');
        }
        return value;
    }
    function formatStatus(value, row, index) {
        if(value)
        {
            return '<span class="label label-sm label-success">Đã kích hoạt</span>'
        }
        else
        {
            return '<span class="label label-sm label-warning">Ngừng kích hoạt</span>';
        }
    }


    function formatStatusNameColor(value, row, index) {
        var strArray = value.split(".");
        var color = '#ffa726';
        if(strArray[1]) color = strArray[1];
        if(strArray[0])
        {
            return '<span class="label label-sm label-success" style="background-color: '+ color +'">' +
                ''+ strArray[0] +'</span>'
        }
        else
        {
            return '<span class="label label-sm label-warning">Chưa kích hoạt</span>';
        }
    }
    function formatUrl(value, row, index) {
        return '<a href="'+value+'" target="_blank">'+value+'</a>';
    }
    function formatImage(value, row, index) {
        if (!value) {
            value = '/images/default.png';
        }
        if(!row['image_url'] == undefined){
            value = row['image_url'] + value;
        }
        var url = '<img src="' + value +'" height="100" width="100" onerror="this.src=\'/images/default.png\';">';

        return url;
    }

    function formatChecked(value, row, index) {
        if(value)
        {
            return '<span class="label label-sm label-success">Có</span>'
        }
        else
        {
            return '<span class="label label-sm label-warning">Không</span>';
        }
    }

    function formatPrice(value, row, index) {
        return numeral(value).format();
    }

    /*-----End All function format-----*/


    function actionColumn(value, row, index) {
        var tmp = '';
        var editBtn = [];

        @if(Route::has($controllerName.'.copy'))
        tmp = '<?=route($controllerName.'.copy', ['id' => 0]+$_GET)?>';
        tmp = tmp.replace("/0", "/"+value);
        editBtn.push('<a data-id="'+value+'" href="' + tmp + '" ' +
            'class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Sao chép">' +
            '<i class="fa fa-copy"></i></a>');
        @endif

        <?php
            $hp = \App\Helpers\Auth::has_permission($controllerName.'.update', $user, $permissions);
            if ($hp) {
            ?>
            tmp = '<?=route($controllerName.'.edit', ['id' => 'id'] + $_GET)?>';
        tmp = tmp.replace("/id", "/"+value);
        editBtn.push(
            '<a href="' + tmp + '" ' +
            'class="add-tooltip btn btn-primary btn-xs" data-placement="top" data-original-title="Chỉnh sửa">' +
            '<i class="fa fa-edit"></i></a>');
        <?php } ?>

        <?php
        $hp = \App\Helpers\Auth::has_permission($controllerName.'.delete', $user, $permissions);
        if ($hp) {
        ?>
        editBtn.push(
            '<a href="<?=route($controllerName.'.delete')?>?ids=' + value + '" ' +
            'class="add-tooltip btn btn-danger btn-xs btn-delete" data-placement="top" data-original-title="Xóa">' +
            '<i class="fa fa-trash-o"></i></a>');
        <?php } ?>

            return editBtn.join(' ');
    }

    //---------------------------------
    @if(Route::has($controllerName.'.active'))
    function activeItems(items, e) {
        if (e) e.preventDefault();

        var url = '{{ route($controllerName.'.active') }}';
        var data = {
            '_token': '{{ csrf_token() }}',
            'ids': items
        };
        request_ajax(url, data, "POST", function (res) {
            ajax_loading(false);
            show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');

            $('#demo-custom-toolbar').bootstrapTable('refresh');
            $('#demo-active-row').prop('disabled', true);
            $('#demo-inactive-row').prop('disabled', true);
            $('#demo-delete-row').prop('disabled', true);

            if (res.rs) {
                $(window).scrollTop(0);
            } else if (res.errors) {
                $.each(res.errors, function (key, msg) {
                    $('#' + key + '-error').html(msg).show();
                });
            }
        });
    }
    @endif

    //---------------------------------
    @if(Route::has($controllerName.'.inactive'))
    function inactiveItems(items, e) {
        if (e) e.preventDefault();

        var url = '{{ route($controllerName.'.inactive') }}';
        var data = {
            '_token': '{{ csrf_token() }}',
            'ids': items
        };
        request_ajax(url, data, "POST", function (data) {
            $('#demo-custom-toolbar').bootstrapTable('refresh');
            $('#demo-active-row').prop('disabled', true);
            $('#demo-inactive-row').prop('disabled', true);
            $('#demo-delete-row').prop('disabled', true);
            show_pnotify(data.msg);
            if(data.rs == 1)
            {
                $(window).scrollTop(0);
            }
        });
    }
    @endif

    //---------------------------------
    function deleteItems(items, e) {
        if (e) e.preventDefault();
        malert('Bạn có thật sự muốn xoá các {{$title}} đã chọn này không?', 'Xác nhận xoá {{$title}}', null, function () {
            var url = '{{ route($controllerName.'.delete') }}';
            var data = {
                '_token': '{{ csrf_token() }}',
                'ids': items
            };
            request_ajax(url, data, "POST", function (data) {
                $('#demo-custom-toolbar').bootstrapTable('refresh');
                $('#demo-active-row').prop('disabled', true);
                $('#demo-inactive-row').prop('disabled', true);
                $('#demo-delete-row').prop('disabled', true);
                show_pnotify(data.msg);
                if(data.rs == 1)
                {
                    $(window).scrollTop(0);
                }
            });
        }, 'alert-danger');
    }

    $(function(){

        var $table = $('#demo-custom-toolbar');

        $table.on('load-success.bs.table', function () {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });

            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                var obj = $(this);
                alert_danger('Bạn có thật sự muốn xoá {{$title}} này không?', 'Xác nhận xoá {{$title}}', null, function () {
                    request_ajax(obj.attr('href'), {}, "POST", function (res) {
                        ajax_loading(false);
                        show_pnotify(res.msg, "Thông báo", res.rs ? 'success' : 'error');
                        if (res.rs) {
                            obj.closest('tr').remove();
                        }
                    });
                });
                return false;
            });

        });

        //-------------------------------

        var $active = $('#demo-active-row');

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $active.prop('disabled', !$table.bootstrapTable('getSelections').length);
        }).on('load-success.bs.table', function () {
            var tooltip = $('.add-tooltip');
            if (tooltip.length)tooltip.tooltip();
        });

        $active.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
            activeItems(ids);
        });

        //-------------------------------

        var $inactive = $('#demo-inactive-row');

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $inactive.prop('disabled', !$table.bootstrapTable('getSelections').length);
        }).on('load-success.bs.table', function () {
            var tooltip = $('.add-tooltip');
            if (tooltip.length)tooltip.tooltip();
        });

        $inactive.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
            inactiveItems(ids);
        });

        //------------------------------------

        var $delete = $('#demo-delete-row');

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $delete.prop('disabled', !$table.bootstrapTable('getSelections').length);
        }).on('load-success.bs.table', function () {
            var tooltip = $('.add-tooltip');
            if (tooltip.length)tooltip.tooltip();
        });

        $delete.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
            deleteItems(ids);
        });
    })

</script>
