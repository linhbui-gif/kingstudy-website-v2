<?php
namespace Modules\Admin\Entities;

class News extends BaseModel
{
    protected $is_deleted   = true;
    protected $table = 'news';
    protected $primaryKey = 'id';

    const  DEACTIVE = 0;
    const  ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'content',
        'alias',
        'keywords',
        'image_url',
        'image_location',
        'image_banner',
        'image_location_100',
        'image_location_300',
        'image_location_1000',
        'status',
        'is_index',
        'view_count',
        'category_id',
        'is_deleted',
        'updated_at',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    public function categories() {
        return $this->belongsTo(CategoryNew::class,'category_id');
    }
}
