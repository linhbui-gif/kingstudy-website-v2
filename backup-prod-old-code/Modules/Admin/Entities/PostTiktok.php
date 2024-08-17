<?php
namespace Modules\Admin\Entities;

class PostTiktok extends BaseModel
{
    protected $table = 'post_tiktok';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
