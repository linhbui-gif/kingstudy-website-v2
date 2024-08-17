<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\LevelCourse;
use Illuminate\Validation\Rule;
use Modules\Admin\Repositories\Level\LevelRepositoryInterface;

class LevelCourseController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        LevelRepositoryInterface $repository

    )
    {
        $this->repo = $repository;
        $this->data['controllerName'] = 'admin::levelCourse';
        $this->view = 'admin::level-course';
    } 

    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $data = LevelCourse::getListAll($filter);
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type='home')
    {
        $this->data['title'] = 'Bậc học';
        $params = $request->all();
        $params['type']         = $type;
        $this->data['params']   = $params;
        return view("{$this->view}.index", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['title'] = 'Thêm mới ';
        $page = $request->get('type');
        return view("{$this->view}.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $id = $request->input('id', 0);
        $is_change_image = $request->input('is_change_image', 0);
        $rules = [
            'status' => 'required',
            'name' => 'required|unique:level',
        ];
        $messages = [
            'name.required' => 'Nhập cấp độ khóa học',
            'name.unique' => 'Cấp độ đã tồn tại',
            'status.required' => 'Chọn trạng thái kích hoạt ',
        ];

        $valid = Validator::make($data, $rules, $messages);

        if ($valid->fails())
        {
            return response()->json([
                'rs' => 0,
                'msg' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $valid->errors()->messages(),
                'data' => $data
            ]);
        }
        $room = LevelCourse::create($data);
        if ($room) {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới thành công.',
                'type' => 'success',
            ]));

            return response()->json([
                'rs' => 1,
                'msg' => 'Thêm mới thành công',
                'redirect_url' => route($this->data['controllerName'].'.index')
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Thêm mới không thành công'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['title'] = 'Chỉnh sửa ';

        $object = LevelCourse::find($id);

        if (!$object) {
            abort(404, 'Không tìm thấy cấp độ khóa học này !!');
        }

        $this->data['id'] = $id;
        $this->data['object'] = $object;
        return view("{$this->view}.create", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Nhập cấp độ khóa học',
            'name.unique' => 'Cấp độ đã tồn tại',
            'status' => 'Chọn trạng thái kich hoạt',
        ];
        $data = $this->validate($request,['status' => 'nullable','name' => ['required',Rule::unique('level')->ignore($id, 'id')],], $messages);
        $object = LevelCourse::find($id);
        if (!$object)
        {
            abort(404, 'Không tìm thấy ');
        }
        $rs = $object->update($data);
        if ($rs)
        {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật thành công.',
                'type' => 'success',
            ]));

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật thành công',
                    'redirect_url' => route($this->data['controllerName'].'.index'),
                ]);
            }
        }
        else {
             $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật không thành công.',
                'type' => 'error',
            ]));
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Cập nhật không thành công',
                ]);
            }
        }
        return redirect()->route($this->data['controllerName'].'.edit', ['id' => $id]);
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            $rs = LevelCourse::find($ids)->delete();
            if ($rs) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Xoá thành công',
                ]);
            }
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Xoá không thành công'
        ]);
    }


}
