<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'ward';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function getAddressByWard($ward_id){
        $ward = self::select(
            \DB::raw("CONCAT_WS(' ', provinces.type, provinces.name) as province_name"),
            \DB::raw("CONCAT_WS(' ', districts.type, districts.name) as district_name"),
            \DB::raw("CONCAT_WS(' ', wards.type, wards.name) as ward_name")
        )
            ->where('ward_id', $ward_id)
            ->leftJoin('districts', 'districts.district_id', '=', 'wards.district_id')
            ->leftJoin('provinces', 'provinces.province_id', '=', 'districts.province_id')

            ->first();

        $address = [];
        if ($ward['province_name']) {
            $address[] = $ward['province_name'];
        }

        if ($ward['district_name'] && strpos($address[0], $ward['district_name']) === false) {
            $address[] = $ward['district_name'];
        }

        if (isset($ward['ward_name'])) {
            $address[] = $ward['ward_name'];
        }

        $address = implode(", ", array_reverse($address));
        return $address;
    }
}
