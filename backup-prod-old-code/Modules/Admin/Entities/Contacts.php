<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Contacts extends BaseModel
{
    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','phone','email','national','ielts','level_course','school_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function getListAll($filter)
    {
        $sql = self::with('level_courses')->select('contacts.*')->where('contacts.is_deleted', 0);

        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('contacts.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('contacts.phone', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('contacts.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('contacts.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-d-m 00:00:00', strtotime($date_from));
            $sql->where('contacts.created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-d-m 23:59:59', strtotime($date_to));
            $sql->where('contacts.created_at', '<=', $date_to);
        }
        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->get()
            ->toArray();
        dd($data);
        return ['total' => $total, 'data' => $data];
    }

    public function level_courses()
    {
        return $this->belongsTo(LevelCourse::class, 'level_course','id');
    }
    public function school_of_contact()
    {
        return $this->belongsTo(School::class, 'school_id','id');
    }
    public function national_of_contact()
    {
        return $this->belongsTo(Country::class, 'national','id');
    }
}
