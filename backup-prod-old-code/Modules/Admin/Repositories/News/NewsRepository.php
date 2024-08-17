<?php
namespace Modules\Admin\Repositories\News;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\News;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    public function getModel()
    {
        return News::class;
    }
}
