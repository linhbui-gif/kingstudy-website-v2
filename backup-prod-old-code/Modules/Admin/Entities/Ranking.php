<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Ranking extends BaseModel
{
    protected $table = 'ranking';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
