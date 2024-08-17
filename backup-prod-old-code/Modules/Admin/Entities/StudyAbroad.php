<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class StudyAbroad extends BaseModel
{
    protected $table = 'study_abroad';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_country','slug','banner_country','overview_title', 'overview_img','overview_content',
                           'system_schools_title','system_schools_link','system_schools_img','scholarship_title','scholarship_link',
                           'scholarship_img','majors_title','majors_link','majors_img','city_title','city_link','city_img',
                           'news_title','news_link','news_img','status','title_country','system_schools_items',
                           'overview_slug','system_schools_slug', 'country_id', 'category_id', 'major_id', 'city_id', 'image_location','tintuc_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    public static function getListAll($filter)
    {
        $sql = self::select('study_abroad.*');

        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('study_abroad.name_country', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('study_abroad.name_country', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('study_abroad.name_country', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('study_abroad.name_country', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-d-m 00:00:00', strtotime($date_from));
            $sql->where('study_abroad.created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-d-m 23:59:59', strtotime($date_to));
            $sql->where('study_abroad.created_at', '<=', $date_to);
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
