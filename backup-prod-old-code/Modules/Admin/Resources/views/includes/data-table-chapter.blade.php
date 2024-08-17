<div id="table-toolbar">
    @if(isset($change_status) && $change_status)
        <?php
        $hp = \App\Helpers\Auth::has_permission($controllerName.'.active', $user, $permissions);
        if ($hp) {
        ?>
        <button id="demo-active-row" class="btn btn-success btn-rounded" disabled><i class="fa fa-check"></i> Kích hoạt</button>
        <?php } ?>

        <?php
        $hp = \App\Helpers\Auth::has_permission($controllerName.'.inactive', $user, $permissions);
        if ($hp) {
        ?>
        <button id="demo-inactive-row" class="btn btn-warning btn-rounded" disabled><i class="fa fa-times"></i> Ngừng kích hoạt</button>
        <?php } ?>
    @endif

    <?php
    $hp = \App\Helpers\Auth::has_permission($controllerName.'.delete', $user, $permissions);
    if ($hp) {
    ?>
    <button id="demo-delete-row" class="btn btn-danger btn-rounded" disabled><i class="fa fa-trash-o"></i> Xóa</button>
    <?php } ?>
</div>

<div class="panel-body pt-0">
    <table id="demo-custom-toolbar" class="table table-bordered table-striped table-hover" cellspacing="0"
           data-toggle="table"
           data-locale="vi-VN"
           data-toolbar="#table-toolbar"
           data-striped="true"
           data-url="{!! route($controllerName.'.search', [ 'course_id' => $course_id ]) !!}"
           data-search="false"
           data-sort-name="updated_at"
           data-sort-order="desc"
           data-show-refresh="false"
           data-show-toggle="false"
           data-show-columns="false"
           data-pagination="true"
           data-side-pagination="server"
           data-page-size="25"
           data-query-params="queryParams"
           data-cookie="true"
           data-cookie-id-table="{{$controllerName}}-index"
           data-cookie-expire="{!! config('params.bootstrapTable.extension.cookie.cookieExpire') !!}"
    >
        <thead>
        <tr>
            <!-- <th data-field="id" data-formatter="formatStt">Stt</th> -->
            <th data-field="check_id" data-checkbox="true">ID</th>
            @foreach($fields as $item)
                <th data-field="{{$item['field']}}"
                    @if (isset($item['class'])) data-class="{{$item['class']}}" @endif
                    @if(!empty($item['formatter'])) data-formatter="{{$item['formatter']}}" @endif
                    @if(!empty($item['sortable'])) data-sortable="{{$item['sortable']}}" @endif
                >{{$item['title']}}</th>
            @endforeach
            <?php
            $hp = \App\Helpers\Auth::has_permission($controllerName.'.update', $user, $permissions);
            if ($hp) {
            ?>
            <th data-field="id" data-align="center" data-formatter="actionColumn">Chức năng</th>
            <?php } ?>

        </tr>
        </thead>
    </table>
</div>
