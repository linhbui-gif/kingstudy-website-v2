<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $table = 'landing_page';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
