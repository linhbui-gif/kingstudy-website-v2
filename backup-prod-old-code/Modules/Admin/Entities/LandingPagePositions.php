<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\HomePositionsLocale;

class LandingPagePositions extends Model
{
    protected $table = 'home_positions';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_location',
        'image_url',
        'youtube',
        'map',
        'width',
        'height',
        'content',
        'keywords',
        'status',
        'title',
        'link_more',
        "content"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function landingPagePositionTypes(){
        return $this->hasOne(LandingPagePositionTypes::class,'id','position_type_id');
    }
    public function localeVi(){
        return $this->hasOne(HomePositionsLocale::class,'home_position_id','id')->where('locale','vi');
    }
    public static function getDataByLandingPageId($landing_page_id){
        $objects = self::with(['landingPagePositionTypes','localeVi'])
            ->select('*')
            ->where('landing_page_id',$landing_page_id)
            ->orderBy('ordering')
            ->get()->toArray();

        $result = [];
        foreach ($objects as $item){
            $result[$item['id']] = $item;
        }

        return $result;
    }

    public function updateData($data,$id){
        $object = self::find($id);
        if(!$object)
            return false;

        return $object->update($data);
    }
}
