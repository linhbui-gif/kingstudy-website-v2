<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    public static function getInstance(){
        return (new static) ;
    }

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function model(){
        return $this->model;
    }

    public function get_user_id() {
        return auth()->id();
    }

    public function observe($class)
    {
        return $this->model->observe($class);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $object = $this->model->find($id);

        if ($object) {
            $object->update($attributes);

            return $object;
        }

        return false;
    }

    public function delete($id)
    {
        if($this->model->isSoftDelete()){
            return $this->softDelete($id);
        }

        $key = $this->model->getKeyName();

        if (is_string($key) && is_array($id)) {
            $objects = $this->model->whereIn($key, $id)->get();
            foreach ($objects as $object) {
                $object->delete();
            }
            return true;
        } else {
            $this->model->find($id)->delete();
            return true;
        }

        return false;
    }

    public function softDelete($ids)
    {
        $key = $this->model->getKeyName();

        if(is_array($ids)){
            $query = $this->model->whereIn($key, $ids);
        }else{
            $query = $this->model->where($key, $ids);
        }

        return $query->update([
            'is_deleted' => 1
        ]);
    }

    public function getListAll($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[],$relate_fields_addition=[])
    {
        $sql = $this->model->select('*');
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

    public function inactive($id){
        if(is_array($id)){
            $query = $this->model->whereIn('id', $id);
        }else{
            $query = $this->model->where('id', $id);
        }

        return $query->update([
            'status' => 0
        ]);
    }

    public function active($id){
        if(is_array($id)){
            $query = $this->model->whereIn('id', $id);
        }else{
            $query = $this->model->where('id', $id);
        }

        return $query->update([
            'status' => 1
        ]);
    }
}
