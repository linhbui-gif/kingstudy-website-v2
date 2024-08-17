<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Banner extends BaseModel
{
    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'position_id', 'ordering', 'url', 'status', 'image_location', 'image_url',
        'page', 'user_created', 'user_modified','title_sub','description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function bannerPosition(){
        return $this->belongsTo(BannerPosition::class,'position_id','id');
    }

    public static function getListAll($filter)
    {
        $sql = self::select('banners.*', 'banner_positions.description as banner_position')
            ->leftJoin('banner_positions','banner_positions.id','=', 'banners.position_id')
            ->where('banners.is_deleted', 0);

        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('banners.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('banners.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('banners.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('banners.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        if (!empty($filter['position_id'])) {

            $sql->where('position_id', $filter['position_id']);
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date_from));
            $sql->where('banners.created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-m-d 23:59:59', strtotime($date_to));
            $sql->where('banners.created_at', '<=', $date_to);
        }

        if (!empty($filter['type'])) {

            $sql->where('banner_positions.page', $filter['type']);
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
