<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Widget extends BaseModel
{
    protected $table = 'widgets';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','content','status','ordering'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    public static function getListAll($filter)
    {
        $sql = self::select('*');

        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->get()
            ->toArray();

        return ['total' => $total, 'data' => $data];
    }


}
