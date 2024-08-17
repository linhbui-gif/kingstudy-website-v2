<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class LandingPagePositionTypes extends Model
{
    protected $table = 'home_position_types';
    protected $primaryKey = 'id';
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
}
