<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Modules\Admin\Entities\Chapter;
use Modules\Admin\Entities\Course;
use Modules\Admin\Repositories\Chapter\ChapterRepositoryInterface;



class ChapterController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $positionRepository;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        ChapterRepositoryInterface $repository
    )
    {
        $this->repo = $repository;
        $this->data['controllerName'] = 'admin::chapter';
    }

    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $filter['is_deleted'] = 0;

        $data = $this->repo->getListAll($filter, [ "name" ]);

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
    public function index(Request $request, $course_id)
    {
        $this->data['title'] = 'Danh sách chương';
        $params = $request->all();
        $this->data['params']   = $params;

        $object = Course::find($course_id);

        if (!$object) {
            abort(404, 'Không tìm thấy Khóa học');
        }

        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'ordering');
        $filter['order'] = $request->input('order', 'asc');
        $filter['is_deleted'] = 0;
        $filter['course_id'] = $course_id;

        $chapters = $this->repo->getListAll($filter, [ "name" ]);

        $this->data['chapters'] = $chapters;
        $this->data['course_id'] = $course_id;
        $this->data['course'] = $object;

        return view("{$this->data['controllerName']}.index", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['title'] = 'Thêm mới khóa học';



        return view("{$this->data['controllerName']}.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'ordering' => 'required'
        ];

        $messages = [
            'name.required' => 'Nhập tên chương',
            'ordering.required' => 'Nhập vị trí',
        ];

        $data = $this->validate($request, $rules, $messages);
        $data['status'] = $request->status ? 1: 0;
        $data['course_id'] = $course_id;
        $data['updated_by'] = $this->get_user_id();
        $data['created_by'] = $data['updated_by'];

        $course = $this->repo->create($data);

        if ($course) {
            return response()->json([
                'rs' => 1,
                'msg' => 'Thêm mới chương học thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Thêm mới chương học không thành công'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $id)
    {

        $object = Chapter::find($id);

        if (!$object) {
            abort(404, 'Không tìm thấy Khóa học');
        }

       return [
           'item' => $object,
           'rs' => 1,
           'msg' => 'success'
       ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $id)
    {
        $rules = [
            'name' => 'required',
            'ordering' => 'required'
        ];

        $messages = [
            'name.required' => 'Nhập tên chương',
            'ordering.required' => 'Nhập vị trí',
        ];

        $data = $this->validate($request, $rules, $messages);
        $data['status'] = $request->status ? 1: 0;
        $object = $this->repo->find($id);

        if (!$object)
        {
            abort(404, 'Không tìm thấy chương');
        }

        $data['user_modified'] = auth()->user()->id;

        $rs = $object->update($data);

        if ($rs)
        {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật chương thành công'
                ]);
            }
        }
        else {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Cập nhật chương không thành công',
                ]);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật banner không thành công.',
                'type' => 'error',
            ]));
        }

        return redirect()->route($this->data['controllerName'].'.edit', ['id' => $id]);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            $rs = $this->repo->delete($id);

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
