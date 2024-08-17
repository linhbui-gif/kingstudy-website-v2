<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\CategoryNew;


class CategoryNewController extends Controller
{
    protected $model;
    /**
     * Create a new controller instance.
     */
    public function __construct(CategoryNew $model)
    {
        $this->model = $model;
        $this->data['title'] = 'Danh mục loại tin tức';
        $this->data['controllerName'] = 'admin::categoryNew';
        $this->view = 'admin::news-categories';
    }
    public function index(Request $request){
        $params = $request->all();
        $limit = $request->get('limit',10);
        $objects = '';
        if(!empty($params['keyword']) || !empty($params['date_from']) ||!empty($params['date_to'])){
            $params['offset'] = $request->input('offset', 0);
            $params['limit'] = $request->input('limit', 10);
            $params['sort'] = $request->input('sort', 'id');
            $params['order'] = $request->input('order', 'desc');
            $params['is_deleted'] = 0;
            $objects = $this->model->search($params);
        }
       else{
           $objects = $this->model->with('child')->where(['parent_id' => 0,'is_deleted' => 0])->paginate($limit);
       }
        $this->data['objects']  = $objects->toArray();
        return view("{$this->view}.index", $this->data);
    }

    public function create(Request $request)
    {
        $is_main = $request->get('is_main',false);

        $this->data['list_cate'] = $this->model->getListCategory();
        $this->data['is_main'] = $is_main;
        $this->data['action'] = $is_main?"Tạo mới danh mục chính":"Tạo mới danh mục con";
        return view("{$this->view}.create", $this->data);
    }
    public function edit($id)
    {
        $object = $this->model->find($id);

        if(!$object){
            abort(404);
        }

        $this->data['list_cate'] = $this->model->getListCategory();
        $this->data['object']   = $object;
        $this->data['is_main']  = $object['parent_id']?false:true;
        $this->data['action']   = "Cập nhật";
        return view("{$this->view}.create", $this->data);
    }
    public function store(Request $request)
    {
        $params = $request->all();
        $id = $request->input('id', 0);

        $rules = [
            'name' => 'required',
            'status' => 'required',
        ];

        $valid = Validator::make($params, $rules);

        if ($valid->fails())
        {
            return response()->json([
                'rs' => 0,
                'msg' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $valid->errors()->messages(),
                'data' => $params
            ]);
        }

        if(!isset($params['parent_id'])){
            $params['parent_id'] = 0;
        }

        if ($id) {
            if($params['parent_id'] != 0){
                $category_parent = $this->model->find($params['parent_id']);
                $arr_path = explode('/',$category_parent['id_path']);
                array_push($arr_path,$id);
                $params['id_path'] = implode('/',$arr_path);
            }else{
                $params['id_path'] = $id;
            }

            $data = \App\Helpers\General::get_data_fillable($this->model, $params);

            $object = $this->model->find($id);

            if (!$object) {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Không tìm thấy'
                ]);
            }

            $rs = $object->update($data);

            if ($rs) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật danh mục thành công',
                ]);
            }

            return response()->json([
                'rs' => 0,
                'msg' => 'Cập nhật danh mục không thành công'
            ]);

        }
        $rs = $this->model->create($params);

        if ($rs) {
            $id = $rs->id;
            if($params['parent_id'] != 0){
                $category_parent = $this->model->find($params['parent_id']);
                $arr_path = explode('/',$category_parent['id_path']);
                array_push($arr_path,$id);
                $id_path = implode('/',$arr_path);
            }else{
                $id_path = $id;
            }

            $rs->update(['id_path' => $id_path]);

            return response()->json([
                'rs' => 1,
                'msg' => 'Thêm mới danh mục thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Thêm mới danh mục không thành công'
        ]);
    }
    public function destroy($id){
        $object = $this->model->find($id);
        if($object){
            $object->is_deleted = 1;
            $object->save();
            return response()->json([
                'rs' => 1,
                'msg' => 'Xóa thành công!',
            ]);
        }
        return response()->json([
            'rs' => 0,
            'msg' => 'Xóa không thành công!',
        ]);
    }
}
