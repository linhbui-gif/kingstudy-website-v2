<form id="frm_update" action="<?=route('admin::landing-page-position.store-position-relationship')?>">
    <div class="panel panel-bordered-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thông tin</h3>
        </div>
        <div class="panel-body overflow-hidden">
            <div class="row">
                <input type="hidden" name="home_position_id" value="<?=$position_id?>">

                @include('admin::landing-page.fields-basic')

                <div class="form-group">
                    @if(!empty($relation))
                        <div class="block col-md-12">
                            <div class="form-group">
                                <label for=""><?=$relation['title_input']?>:</label>
                                <select id="object_ids" class="form-control"></select>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="block col-md-12">
                    <div class="form-group">
                        <table class="table table-striped object_relationship_list" style="display: none">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Thứ tự</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div><!-- /.panel-body -->

    </div><!-- /.panel -->

    <div class="panel-footer text-center">
        <div class="form-group">
            <div class="col-md-12">
                <input type="hidden" name="landing_page_position_id" value="<?=$position_id?>">
                <button type="reset" class="cancel Cancel btn btn-default btn-rounded" onclick="location.reload()">
                    <i class="fa fa-refresh" aria-hidden="true"></i> Huỷ bỏ
                </button>
                <button type="submit" class="btn button-update BtnUpdate btn btn-primary btn-rounded">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật thông tin
                </button>

            </div>
        </div>
    </div>
</form>






