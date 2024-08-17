<?php
namespace Modules\Admin\Repositories\StudyAbroad;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\StudyAbroad;

class StudyAbroadRepository extends BaseRepository implements StudyAbroadRepositoryInterface
{
    public function getModel()
    {
        return StudyAbroad::class;
    }
    public function getListAll($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[],$relate_fields_addition=[])
    {
        
    }   
      public function delete($ids = null) 
    {
        if($ids != null) 
        {
            if(is_array($ids)) 
            {
                $objects = $this->model->whereIn('id', $ids)->get();
                foreach($objects as $obj) 
                {
                    $rs = $obj->delete();
                }
            }else 
            {
                $obj = $this->model->find($ids);
                $rs   =$obj->delete();
            }
            if($rs)
            {
                return true;
            }
        }
    } 

}
