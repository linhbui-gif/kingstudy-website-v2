<?php
namespace Modules\Admin\Repositories\School;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\School;

class SchoolRepository extends BaseRepository implements SchoolRepositoryInterface
{
    public function getModel()
    {
        return School::class;
    }
    public function getListAll($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[],$relate_fields_addition=[])
    {
        {
        $sql = $this->model->select('school.id',
                                    'school.name',
                                    'school.status',
                                    'school.created_at',);
        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('school.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('school.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('school.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('school.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date_from));
            $sql->where('school.created_at', '>=', $date_from);
        }
        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-m-d 23:59:59', strtotime($date_to));
            $sql->where('school.created_at', '<=', $date_to);
        }
        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->get()->toArray();
        return ['total' => $total, 'data' => $data];
    }   
    }


}
