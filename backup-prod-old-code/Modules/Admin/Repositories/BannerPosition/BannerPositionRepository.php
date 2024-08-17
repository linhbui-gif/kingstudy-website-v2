<?php
namespace Modules\Admin\Repositories\BannerPosition;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\BannerPosition;

class BannerPositionRepository extends BaseRepository implements BannerPositionRepositoryInterface
{
    public function getModel()
    {
        return BannerPosition::class;
    }

    public function getOptionsBannerPosition($page=null) {
        $positions = $this->model->select('id', 'description', 'page', 'position', 'max_item', 'size',
            'file_type', 'max_file_size', 'ordering')
            ->where('is_deleted', '=', 0)
            ->orderBy('ordering', 'asc');
        if($page){
            $positions->where('page',$page);
        }

        $positions = $positions->get()->toArray();

        $tmp = [];
        $tmp_options = [];
        foreach ($positions as $item) {
            $tmp[$item['id']] = $item;
            $tmp_options[$item['id']] = $item['description'];
        }

        return [
            'positions' => $tmp,
            'positions_options' => $tmp_options
        ];
    }
}
