<tr data-tt-id="<?=$item['id']?>" data-tt-parent-id="<?=$pid?>">
    <td><?=$item['name']?></td>
    <td><?=$item['ordering']?></td>
    <td>
        @if($item['status'] == '1')
            <span class="label label-sm label-success">Đã kích hoạt</span>
        @else
            <span class="label label-sm label-warning">Chưa kích hoạt</span>
        @endif
    </td>
    <td>
        <div class="wrapper">
            <a href="<?=route('admin::categoryNew.edit', ['id' => $item['id']])?>" class="add-tooltip btn btn-primary btn-xs" data-placement="top" data-original-title="Sửa">
                <i class="fa fa-edit"></i>
            </a>
            <a href="javascript:void(0)" class="delete-action add-tooltip btn btn-danger btn-xs btn-delete" data-placement="top" data-original-title="Xóa" data-url="{{route('admin::categoryNew.delete',['id' => $item['id']])}}">
                <i class="fa fa-trash-o"></i>
            </a>
        </div>
    </td>
</tr>
