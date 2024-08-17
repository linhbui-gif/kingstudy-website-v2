<?php
namespace Modules\Admin\Repositories\Widget;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Widget;

class WidgetRepository extends BaseRepository implements WidgetRepositoryInterface
{
    public function getModel()
    {
        return Widget::class;
    }
}
