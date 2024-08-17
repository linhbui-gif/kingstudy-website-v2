<?php
namespace Modules\Admin\Repositories\City;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\City;
use Modules\Admin\Entities\Country;
use Modules\Admin\Repositories\City\CityRepositoryInterface;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function getModel()
    {
        return City::class;
    }
    public function getListAll($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[],$relate_fields_addition=[])
    {

    }


}
