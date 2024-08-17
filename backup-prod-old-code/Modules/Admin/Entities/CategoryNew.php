<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryNew extends BaseModel
{
    protected $table = 'new_categories';
    protected $primaryKey = 'id';
    protected $is_deleted = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'parent_id',
        'id_path',
        'ordering',
        'created_at',
        'updated_at',
        'status',
        'is_deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    public function child(){
        return $this->hasMany($this,'parent_id')->with('child')->where('is_deleted',0);
    }

    public function getRootCategoryId($category) {
        $tmp = explode('/', $category['id_path']);

        return $tmp[0];
    }

    public function getListCategory($return_all=false) {

        $list_all_cate = self::where('is_deleted',0)->get()->toArray();

        if(empty($list_all_cate)){
            return [];
        }

        $tmp = [];
        foreach($list_all_cate as $key => $value){
            $tmp['parent'][$value['parent_id']][]   = $value['id'];
            $tmp['item'][$value['id']]     = $value;
        }

        $list_all_cate = [];

        $this->handlingCategories($list_all_cate, $tmp,0);

        if ($return_all) {
            $tmp['options'] = $list_all_cate;
            return $tmp;
        }

        return $list_all_cate;
    }

    public function handlingCategories(&$result, $data, $parent=0, $step = 0) {
        $str_step = $step==1?'|--':($step==2?'|--|--':'');

        foreach( $data['parent'][$parent] as $key => $item){

            $result[] = array(
                'id' => $item,
                'name' => $str_step.$data['item'][$item]['name'],
            );

            if($step < 2 && isset($data['parent'][$item]))
                $this->handlingCategories($result, $data, $item, $step+1);
        }
    }
    public function search($filter)
    {

        $sql = self::select('new_categories.*')
            ->where('new_categories.is_deleted', 0);

        if (!empty($filter['keyword']) && !empty($filter['search']))
        {

            $sql->where(function ($query) use ($filter)
            {
                $query->where('new_categories.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('new_categories.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('new_categories.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('new_categories.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date_from));
            $sql->where('new_categories.created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-m-d 23:59:59', strtotime($date_to));
            $sql->where('new_categories.created_at', '<=', $date_to);
        }

        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->where(['parent_id' => 0,'is_deleted' => 0])->paginate(10);
        return $data;
    }
}
