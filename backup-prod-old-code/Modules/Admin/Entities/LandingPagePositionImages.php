<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class LandingPagePositionImages extends Model
{
    protected $table = 'home_position_images';
    protected $primaryKey = 'home_position_image_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['home_position_id','title','image_url','image_location','link','ordering','description','image_child_url','image_child_location','title_link'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public $timestamps = false;

    public function localeVi(){
        return $this->hasOne(HomePositionImagesLocale::class,'home_position_image_id','home_position_image_id')->where('locale','vi');
    }
//
//    public function localeEn(){
//        return $this->hasOne(HomePositionImagesLocale::class,'home_position_image_id','home_position_image_id')->where('locale','en');
//    }
}
