<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class School extends BaseModel
{
    protected $table = 'school';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','heading','number_info','status','banner',
                           'logo','about','map','featured','program','infrastructure',
                           'tuition','scholarship','required','feed_back','gallery','similar',
                           'type_school','country_id','province_id','status','created_by','updated_by',
                           'slug','meta_title','meta_thumbnail','keywords','meta_description','survey_mark_gpa',
                            'survey_mark_dh','survey_mark_ts','survey_mark_thpt','survey_mark_ct',
                            'survey_mark_ielts','survey_tuition','summary_general_infor',
                            'summary_city','summary_highlight_infor','summary_study_program',
                            'summary_infrastructure','summary_scholarship','summary_tuition',
                            'summary_required','summary_feed_back','opening_time','is_index','video_url','price'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    public function majors() {
        return $this->belongsToMany(Majors::class,'school_has_majors', 'school_id', 'majors_id');
    }
    public function courses() {
        return $this->belongsToMany(Course::class,'school_has_course', 'school_id', 'course_id');
    }
    public function levels() {
        return $this->belongsToMany(LevelCourse::class,'school_has_level', 'school_id', 'level_id');
    }
    public function rankings() {
        return $this->belongsToMany(Ranking::class,'school_has_ranking', 'school_id', 'ranking_id');
    }
    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }
}
