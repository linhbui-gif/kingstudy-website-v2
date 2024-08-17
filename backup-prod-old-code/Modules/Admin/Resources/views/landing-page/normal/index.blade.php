<form id="frm_update" action="<?=route('admin::landingPagePosition.update', ['position_id' => $position_id])?>" method="post">
    <div class="panel-body">
        <div class="row">
            @include('admin::landing-page.fields-basic')
        </div>
    </div>

    <div class="panel-footer text-center">
        <input type="hidden" name="landing_page_position_id" value="<?=$position_id?>">

        <button type="reset" class="cancel Cancel btn btn-default btn-rounded" onclick="location.reload()">
            <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
        </button>

        <button type="submit" class="btn button-update BtnUpdate btn btn-primary btn-rounded">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật thông tin
        </button>
    </div>
</form>
