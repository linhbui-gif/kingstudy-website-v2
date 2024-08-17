<?php
namespace Modules\Admin\Repositories\Level;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\LevelCourse;

class LevelRepository extends BaseRepository implements LevelRepositoryInterface
{
    public function getModel()
    {
        return LevelCourse::class;
    }
    public function getListAll($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[],$relate_fields_addition=[])
    {
        $sql = $this->model->select('id','name', 'image','price','discount_price','status','created_at','updated_at');
        if(!empty($with)){
            $sql->with($with);
        }

        $where_or = false;


        if(!empty($search_fields)){
            if (!empty($filter['keyword']) && !empty($filter['search']))
            {
                $sql->where(function ($query) use ($filter,$search_fields)
                {
                    $field = array_shift($search_fields);
                    $query->where($field, 'LIKE', '%' . $filter['keyword'] . '%');
                    $query->orWhere($field, 'LIKE', '%' . $filter['search'] . '%');

                    foreach($search_fields as $field){
                        $query->orWhere($field, 'LIKE', '%' . $filter['keyword'] . '%');
                        $query->orWhere($field, 'LIKE', '%' . $filter['search'] . '%');
                    }
                });
                $where_or = true;
            }
            else if(!empty($filter['keyword']))
            {
                $sql->where(function ($query) use ($filter,$search_fields)
                {
                    $field = array_shift($search_fields);
                    $query->where($field, 'LIKE', '%' . $filter['keyword'] . '%');
                    foreach($search_fields as $field){
                        $query->orWhere($field, 'LIKE', '%' . $filter['keyword'] . '%');
                    }
                });
                $where_or = true;
            }
            else if(!empty($filter['search']))
            {
                $sql->where(function ($query) use ($filter,$search_fields)
                {
                    $field = array_shift($search_fields);
                    $query->where($field, 'LIKE', '%' . $filter['search'] . '%');
                    foreach($search_fields as $field){
                        $query->orWhere($field, 'LIKE', '%' . $filter['search'] . '%');
                    }
                });
                $where_or = true;
            }
        }

        if(!empty($search_relate_fields)){
            if (!empty($filter['keyword']) && !empty($filter['search']))
            {
                if($where_or){
                    $sql->orWhere(function ($query) use ($filter,$search_relate_fields)
                    {
                        $field = array_shift($search_relate_fields);
                        $field = explode('.',$field);
                        $query->whereHas($field[0],function($query) use ($filter,$field){
                            unset($field[0]);
                            $f = array_shift($field);
                            $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                            $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                            foreach($field as $f){
                                $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                            }

                        });

                        foreach($search_relate_fields as $field){
                            $field = explode('.',$field);
                            $query->orWhereHas($field[0],function($query) use ($filter,$field){
                                unset($field[0]);
                                $f = array_shift($field);
                                $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                foreach($field as $f){
                                    $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                    $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                }
                            });
                        }
                    });
                }else{
                    $sql->where(function ($query) use ($filter,$search_relate_fields)
                    {
                        $field = array_shift($search_relate_fields);
                        $field = explode('.',$field);
                        $query->whereHas($field[0],function($query) use ($filter,$field){
                            unset($field[0]);
                            $f = array_shift($field);
                            $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                            $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                            foreach($field as $f){
                                $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                            }

                        });


                        foreach($search_relate_fields as $field){
                            $field = explode('.',$field);
                            $query->orWhereHas($field[0],function($query) use ($filter,$field){
                                unset($field[0]);
                                $f = array_shift($field);
                                $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                foreach($field as $f){
                                    $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                    $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                }
                            });
                        }
                    });
                }

            }
            else if(!empty($filter['keyword']))
            {

                if($where_or){
                    $sql->orWhere(function ($query) use ($filter,$search_relate_fields)
                    {
                        $field = array_shift($search_relate_fields);
                        $field = explode('.',$field);

                        $query->whereHas($field[0],function($query) use ($filter,$field){
                            unset($field[0]);
                            $f = array_shift($field);
                            $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                            foreach($field as $f){
                                $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                            }
                        });

                        foreach($search_relate_fields as $field){
                            $field = explode('.',$field);
                            $query->orWhereHas($field[0],function($query) use ($filter,$field){
                                unset($field[0]);
                                $f = array_shift($field);
                                $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                foreach($field as $f){
                                    $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                }
                            });
                        }
                    });
                }else{
                    $sql->where(function ($query) use ($filter,$search_relate_fields)
                    {
                        $field = array_shift($search_relate_fields);
                        $field = explode('.',$field);

                        $query->whereHas($field[0],function($query) use ($filter,$field){
                            unset($field[0]);
                            $f = array_shift($field);
                            $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                            foreach($field as $f){
                                $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                            }
                        });

                        foreach($search_relate_fields as $field){
                            $field = explode('.',$field);
                            $query->orWhereHas($field[0],function($query) use ($filter,$field){
                                unset($field[0]);
                                $f = array_shift($field);
                                $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
//                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                foreach($field as $f){
                                    $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
//                                    $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                }
                            });
                        }
                    });
                }

            }
            else if(!empty($filter['search']))
            {
                if($where_or){
                    $sql->orWhere(function ($query) use ($filter,$search_relate_fields)
                    {
                        $field = array_shift($search_relate_fields);
                        $field = explode('.',$field);

                        $query->whereHas($field[0],function($query) use ($filter,$field){
                            unset($field[0]);
                            $f = array_shift($field);
                            $query->where($f, 'LIKE', '%' . $filter['search'] . '%');
                            foreach($field as $f){
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                            }
                        });

                        foreach($search_relate_fields as $field){
                            $field = explode('.',$field);
                            $query->orWhereHas($field[0],function($query) use ($filter,$field){
                                unset($field[0]);
                                $f = array_shift($field);
                                $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                foreach($field as $f){
                                    $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                    $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                }
                            });
                        }
                    });
                }else{
                    $sql->where(function ($query) use ($filter,$search_relate_fields)
                    {
                        $field = array_shift($search_relate_fields);
                        $field = explode('.',$field);

                        $query->whereHas($field[0],function($query) use ($filter,$field){
                            unset($field[0]);
                            $f = array_shift($field);
                            $query->where($f, 'LIKE', '%' . $filter['search'] . '%');
                            foreach($field as $f){
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                            }
                        });

                        foreach($search_relate_fields as $field){
                            $field = explode('.',$field);
                            $query->orWhereHas($field[0],function($query) use ($filter,$field){
                                unset($field[0]);
                                $f = array_shift($field);
                                $query->where($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                foreach($field as $f){
                                    $query->orWhere($f, 'LIKE', '%' . $filter['keyword'] . '%');
                                    $query->orWhere($f, 'LIKE', '%' . $filter['search'] . '%');
                                }
                            });
                        }
                    });
                }
            }
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date_from));
            $sql->where('created_at', '>=', $date_from);
        }

        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-m-d 23:59:59', strtotime($date_to));
            $sql->where('created_at', '<=', $date_to);
        }

        if(isset($filter['status'])){
            $sql->where('status', $filter['status']);
        }

        if(!empty($field_addition)){
            foreach($field_addition as $item){
                if(isset($filter[$item])){
                    $sql->where($item, $filter[$item]);
                }
            }
        }

        if(!empty($relate_fields_addition)){
            foreach($relate_fields_addition as $key => $item){
                if(isset($filter[$key])){
                    $field = explode('.',$item);
                    $sql->whereHas($field[0],function($query) use ($filter,$key,$field){
                        $query->where($field[1], $filter[$key]);
                    });
                }
            }
        }

        $sort = $filter['sort'] ?? 'updated_at';
        $order = $filter['order'] ?? 'desc';
        if ($sort) {
            $sql->orderBy($sort, $order);
        }

        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->get()
            ->toArray();

        return ['total' => $total, 'data' => $data];
    }


}
