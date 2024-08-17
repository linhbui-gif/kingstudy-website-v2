<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';

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
