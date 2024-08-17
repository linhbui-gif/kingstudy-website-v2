<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Course;
use Modules\Admin\Entities\Majors;
use Illuminate\Validation\Rule;
use Modules\Admin\Repositories\Course\CourseRepositoryInterface;
use Rap2hpoutre\FastExcel\FastExcel;

class CourseController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        CourseRepositoryInterface $repository

    )
    {
        $this->repo = $repository;
        $this->data['controllerName'] = 'admin::course';
    }

    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $filter['is_deleted'] = 0;
        $data = $this->repo->getListAll($filter,[],[],['schools']);
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
        $this->data['title'] = 'khóa học';
        $params = $request->all();
        $params['type']         = $type;
        $this->data['params']   = $params;
        return view("{$this->data['controllerName']}.index", $this->data);
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
        $this->data['majors'] = Majors::select('id','name')->get()->toArray();
        return view("{$this->data['controllerName']}.create", $this->data);
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
        $is_change_image = $request->input('is_change_image', 0);
        $rules = [
            'status' => 'required',
            'name' => 'required|unique:course',
            'title' => 'required',
//            'description' => 'required',
            'content' => 'required',
            'type' => 'required|in:1,2'
            // 'image_location' => 'mimes:jpg,png',
        ];
        $messages = [
            'name.required' => 'Nhập cấp độ khóa học',
            'name.unique' => 'Cấp độ đã tồn tại',
            'status.required' => 'Chọn trạng thái kích hoạt ',
            'title.required' => 'Title not empty',
//            'description.required' => 'Descripton not empty',
            'content.required' => 'Content not empty',
            'type.required' => 'Chọn bật học',
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
        $temp_path = '';
        if ($is_change_image) {
            $temp_path = $data['image_location'];
            $data['image_url'] = General::generateImageLocation($temp_path);
        }
        $rs = Course::create($data);
        if ($rs) {
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_url']);

            }
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

        $object = Course::find($id);

        if (!$object) {
            abort(404, 'Không tìm thấy cấp độ khóa học này !!');
        }

        $this->data['id'] = $id;
        $this->data['object'] = $object;
        $this->data['majors'] = Majors::select('id','name')->get()->toArray();
        return view("{$this->data['controllerName']}.create", $this->data);
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
        $data = $request->all();
        $is_change_image = $request->input('is_change_image', 0);
        $messages = [
            'name.required' => 'Nhập cấp độ khóa học',
            'name.unique' => 'Cấp độ đã tồn tại',
            'status.required' => 'Chọn trạng thái kích hoạt ',
        ];
        $valid = Validator::make($data,['status' => 'nullable','name' => ['required',Rule::unique('course')->ignore($id, 'id')],], $messages);
        if ($valid->fails())
        {
            return response()->json([
                'rs' => 0,
                'msg' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $valid->errors()->messages(),
                'data' => $data
            ]);
        }
        $object = $this->repo->find($id);
        if (!$object)
        {
            abort(404, 'Không tìm thấy ');
        }
        $temp_path = '';
        if ($is_change_image) {
            $temp_path = $data['image_location'];
            $data['image_url'] = General::generateImageLocation($temp_path);
        }
        $data['user_modified'] = auth()->user()->id;
        $rs = $object->update($data);
        if ($rs)
        {
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_url']);

            }
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
            if(is_array($ids)) {
                $rs = Course::whereIn('id',$ids)->delete();
            }
            else{
                $rs = Course::find($ids)->delete();
            }
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

    public function import(Request $request)
    {
        $file = $request->file('fileImport');
        $newFile =  $file->getClientOriginalName();
        $file->move(storage_path('app/import'), $newFile);
        $collection = (new FastExcel())->import(storage_path('app/import/') . $newFile);
        foreach ($collection as $itemRow) {
            $item = array_values($itemRow);
            $bathoc = $item[0];
            $stt = $item[1];
            $tenkhoahoc = $item[2];
            $code = $item[3];
            $chuyennganh = $item[4];
            $content = $item[5];
            $link = $item[6];

            $course = new Course();
            $course->name = $tenkhoahoc;
            $course->kyhieu = $code;
            $course->content = $content;
            $course->link_course = $link;
            $course->type_create = "import";
            $type = strtolower(trim($bathoc));
            if($type == "undergraduate") {
                $course->type = 1;
            }elseif($type == "postgraduate") {
                $course->type = 2;
            }elseif($type == "colleges") {
                $course->type = 3;
            }elseif($type == "other") {
                $course->type = 4;
            }
            $major = Majors::where('name',$chuyennganh)->first();
            if($major) {
                $course->majors_id = $major->id;
            }else {
                $major = new Majors();
                $major->name = $chuyennganh;
                $major->type_create = "import";
                $major->status = 1;
                $major->save();

                $course->majors_id  = $major->id;
            }
            $course->save();
        }
        return redirect()->back();
    }
}
