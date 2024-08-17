<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Majors extends BaseModel
{
    protected $table = 'survey';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','country_id','tuition','ielts','point','start','gpa','ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function getListAll($filter)
    {
        $sql = self::select('majors.*');

        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('majors.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('majors.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('majors.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('majors.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-d-m 00:00:00', strtotime($date_from));
            $sql->where('majors.created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-d-m 23:59:59', strtotime($date_to));
            $sql->where('majors.created_at', '<=', $date_to);
        }
        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->get()
            ->toArray();

        return ['total' => $total, 'data' => $data];
    }
}
