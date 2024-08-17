<?php
namespace Modules\Admin\Repositories\Banner;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Banner;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    public function getModel()
    {
        return Banner::class;
    }
}
