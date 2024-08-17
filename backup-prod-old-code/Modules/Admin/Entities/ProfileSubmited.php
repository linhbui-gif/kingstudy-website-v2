<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class ProfileSubmited extends BaseModel
{
    protected $table = 'profile_submited';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'country_id', 'level', 'english_skill', 'status', 'attachment_1','attachment_2','attachment_3','course_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function school(){
        return $this->belongsTo(School::class, 'school_id');
    }
}
