<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends BaseModel
{
    protected $table = 'course';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','title','description','content','status','image_url','majors_id','link_course', 'type', 'show_home', 'kyhieu'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function getListAll($filter)
    {
        $sql = self::select('course.*')->with('schools:id,name');

        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('course.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('course.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('course.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('course.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-d-m 00:00:00', strtotime($date_from));
            $sql->where('course.created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-d-m 23:59:59', strtotime($date_to));
            $sql->where('course.created_at', '<=', $date_to);
        }
        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->get()
            ->toArray();

        return ['total' => $total, 'data' => $data];
    }

    public function majors_of_course()
    {
        return $this->belongsTo(Majors::class,'majors_id', 'id');
    }
    public function schools(){
       return $this->belongsToMany(School::class, 'school_has_course', 'course_id', 'school_id');
    }
}
