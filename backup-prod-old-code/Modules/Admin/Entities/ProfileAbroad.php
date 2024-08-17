<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class ProfileAbroad  extends Model
{
    protected $table = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','name','phone','phone_2','email','birth_day','birth_place','gender','permanent_address','current_address',
                            'time_at_address','identity_card','identity_card_issued_by','identity_card_date','identity_card_expiration_date',
                            'passport','passport_issued_by','passport_date','passport_expiration_date','other_passport','other_passport_card',
                            'other_passport_issued_by','other_passport_date','other_passport_card_expiration_date','father_name','father_birth_day',
                            'father_current_address','father_job','father_phone','father_email','mother_name','mother_birth_day','mother_job',
                            'mother_current_address','mother_phone','mother_email','marital_status','spouse_name','spouse_birth_day',
                            'spouse_birth_place','spouse_nationality','spouse_current_address','child_1_name','child_1_birth_day',
                            'child_1_birth_place','child_1_nationality','child_1_current_address','child_2_name','child_2_birth_day',
                            'child_2_birth_place','child_2_nationality','child_2_current_address','degree','is_work','degree_school_name',
                            'degree_major','degree_school_year','degree_address','presenter_1_name','presenter_1_position','presenter_1_email',
                            'presenter_1_phone','presenter_2_name','presenter_2_position','presenter_2_email','presenter_2_phone','is_ielts',
                            'ielts_overall','ielts_date','ielts_reading','ielts_listening','ielts_writing','ielts_speaking','ielts_test_report_form'
                            ,'is_worked_2','job_company_name','job_working_time','job_address','job_phone','job_email','job_position','job_salary',
                            'is_gone_abroad','travel_history_1_nation','travel_history_1_time','travel_history_1_purpose','travel_history_2_nation','travel_history_2_time','travel_history_2_purpose','travel_history_3_nation','travel_history_3_time','travel_history_3_purpose','travel_history_4_nation','travel_history_4_time','travel_history_4_purpose','travel_history_5_nation','travel_history_5_time','travel_history_5_purpose','is_gone_uk','uk_nl_number','uk_date',
                            'uk_brp_number','is_fail_visa','is_fail_visa_info','is_warned_country','is_warned_country_info','is_denine','is_denine_info','is_relative_study_abroad','relative_abroad_name','relative_abroad_phone','relative_abroad_email','relative_abroad_address','commit','private','country_id','ielts',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
