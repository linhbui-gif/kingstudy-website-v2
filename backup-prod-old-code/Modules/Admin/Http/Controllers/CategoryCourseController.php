<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\CategoryCourses;
use Modules\Admin\Entities\CategoryNew;


class CategoryCourseController extends Controller
{
    protected $model;
    /**
     * Create a new controller instance.
     */
    public function __construct(CategoryCourses $model)
    {
        $this->model = $model;
        $this->data['title'] = 'Danh mục loại khóa học';
        $this->data['controllerName'] = 'admin::categoryCourse';
        $this->view = 'admin::courses-categories';
    }
    public function index(Request $request){
        $params = $request->all();
        $limit = $request->get('limit',10);

        $objects = $this->model->where(['is_deleted' => 0])->paginate($limit);
        $this->data['objects']  = $objects->toArray();
        return view("{$this->view}.index", $this->data);
    }

    public function create(Request $request)
    {
        $this->data['list_cate'] = $this->model->getListCategory();
        $this->data['action'] = "Tạo mới danh mục khóa học";
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
        $this->data['action']   = "Cập nhật";
        return view("{$this->view}.create", $this->data);
    }
    public function store(Request $request)
    {
        $params = $request->all();
        $id = $request->input('id', 0);

        $rules = [
            'name' => 'required',
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

        if ($id) {
            $params['id_path'] = $id;

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
            $id_path = $id;

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
