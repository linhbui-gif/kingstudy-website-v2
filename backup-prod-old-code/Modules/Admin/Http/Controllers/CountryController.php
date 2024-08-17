<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Country;
use Illuminate\Validation\Rule;
use Modules\Admin\Repositories\Country\CountryRepositoryInterface;


class CountryController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        CountryRepositoryInterface $repository
    )
    {
        $this->repo                   = $repository;
        $this->data['controllerName'] = 'admin::country';
    } 

    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $data = Country::getListAll($filter);
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
        $this->data['title'] = 'Danh sách';
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
        $is_change_image_icon = $request->input('is_change_image', 0);
        $is_change_image_logo = $request->input('is_change_image_logo', 0);
        $rules = [
            'name' => 'required',
            'name' => 'required|unique:country',
            'image_location_logo' => 'required',
            'image_location_icon' => 'required',
        ];
        $messages = [
            'name.required' => 'Nhập tên quốc gia',
            'name.unique' => 'Tên quốc gia đã tồn tại',
            'image_location_icon.required' => 'Chọn icon ',
            'image_location_logo.required' => 'Chọn logo',
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
        $temp_path_logo = '';
        $temp_path_icon = '';
        if ($is_change_image_logo) {
            $temp_path_logo = $data['image_location_logo'];
            $data['logo'] = General::generateImageLocation($temp_path_logo);
        }
        if ($is_change_image_icon) {
            $temp_path_icon = $data['image_location_icon'];
            $data['icon'] = General::generateImageLocation($temp_path_icon);
        }
        $rs = Country::create($data);
        if ($rs) {
            if (!empty($temp_path_logo))
            {
                General::moveImage($temp_path_logo, $data['logo']);
               
            }
            if(!empty($temp_path_icon))
            {
                General::moveImage($temp_path_icon, $data['icon']);
               
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

        $object = Country::find($id);

        if (!$object) {
            abort(404, 'Not Found !!');
        }

        $this->data['id'] = $id;
        $this->data['object'] = $object;
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
        $is_change_image_icon = $request->input('is_change_image', 0);
        $is_change_image_logo = $request->input('is_change_image_logo', 0);
        $messages = [
            'name.required' => 'Nhập tên quốc gia',
            'name.unique' => 'Tên quốc gia đã tồn tại',
        ];
        $valid = Validator::make($data,['status' => 'nullable','name' => ['required',Rule::unique('country')->ignore($id, 'id')],], $messages);
        if ($valid->fails())
        {
            return response()->json([
                'rs' => 0,
                'msg' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $valid->errors()->messages(),
                'data' => $data
            ]);
        }
        $object = Country::find($id);
        if (!$object)
        {
            abort(404, 'Không tìm thấy ');
        }
        $temp_path_logo = '';
        $temp_path_icon = '';
        if ($is_change_image_logo) {
            $temp_path_logo = $data['image_location_logo'];
            $data['logo'] = General::generateImageLocation($temp_path_logo);
        }
        if ($is_change_image_icon) {
            $temp_path_icon = $data['image_location_icon'];
            $data['icon'] = General::generateImageLocation($temp_path_icon);
        }
        $data['user_modified'] = auth()->user()->id;
        $rs = $object->update($data);
        if ($rs)
        {
            if (!empty($temp_path_logo))
            {
                General::moveImage($temp_path_logo, $data['logo']);
               
            }
            if(!empty($temp_path_icon))
            {
                General::moveImage($temp_path_icon, $data['icon']);
               
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
            if(is_array($ids)) 
            {
                $rs = Country::whereIn('id',$ids)->delete();
            }
            else {
                $rs = Country::find($ids)->delete();
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
}
