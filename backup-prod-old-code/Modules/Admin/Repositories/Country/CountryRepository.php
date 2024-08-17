<?php
namespace Modules\Admin\Repositories\Country;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Country;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function getModel()
    {
        return Country::class;
    }
    public function getListAll($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[],$relate_fields_addition=[])
    {
        
    }   


}
