<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $is_deleted   = true;
    protected $table = 'district';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['_name', '_prefix','province_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];

    public function getDistrictsOptions($params) {
        $query = District::select('id', \DB::raw("CONCAT_WS(' ', type, name) as district_name"))
            ->where('is_deleted', 0);

        if (isset($params['province_id'])) {
            $query->where('province_id', $params['province_id']);
        }

        if (isset($params['district_id'])) {
            $query->whereIn('district_id', $params['district_id']);
        }

        return $query->pluck('district_name', 'district_id');
    }
}
