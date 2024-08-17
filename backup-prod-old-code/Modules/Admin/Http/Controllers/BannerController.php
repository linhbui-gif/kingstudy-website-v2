<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Modules\Admin\Entities\Banner;
use Modules\Admin\Entities\BannerPosition;
use Modules\Admin\Repositories\Banner\BannerRepositoryInterface;
use Modules\Admin\Repositories\BannerPosition\BannerPositionRepositoryInterface;


class BannerController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $positionRepository;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        BannerRepositoryInterface $repository,
        BannerPositionRepositoryInterface $positionRepository
    )
    {
        $this->repo = $repository;
        $this->positionRepository = $positionRepository;
        $this->data['controllerName'] = 'admin::banner';
    }

    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $filter['is_deleted'] = 0;

        $data = $this->repo->getListAll($filter,['name'],['bannerPosition', 'is_deleted'],[],['position_id'],['type' => 'bannerPosition.page']);

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
        $this->data['title'] = 'Danh sách banners';
        $params = $request->all();
        $params['type']         = $type;
        $this->data['params']   = $params;

        $positions = $this->positionRepository->getOptionsBannerPosition();

        $this->data['positions'] = $positions['positions'];
        $this->data['positions_options'] = $positions['positions_options'];
        return view("{$this->data['controllerName']}.index", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['title'] = 'Thêm mới banner';
        $page = $request->get('type');

        $positions = $this->positionRepository->getOptionsBannerPosition($page);

        $this->data['positions'] = $positions['positions'];
        $this->data['positions_options'] = $positions['positions_options'];

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
        $id = $request->input('id', 0);
        $is_change_image = $request->input('is_change_image', 0);

        $rules = [
            'name' => 'required|max:255',
            'url' => 'required|max:255',
            'position_id' => 'required',
            'ordering' => 'required',
            'image_location' => 'required',
            'page' => 'required',
        ];

        $messages = [
            'name.required' => 'Nhập tên banner',
            'url.required' => 'Nhập link liên kết',
            'position_id.required' => 'Chọn vị trí banner',
            'ordering.required' => 'Chọn thứ tự hiển thị',
            'image_location.required' => 'Chọn ảnh hiển thị',
            'page.required' => 'Nhập loại banner',
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

        $title = $data['page'] === 'about' ? 'hình ảnh' : 'banner';
        $data['user_modified'] = $this->get_user_id();
        $temp_path = '';
        if ($is_change_image)
        {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);
            $data['image_url'] = config('app.url');
        }

        $data['user_created'] = $data['user_modified'];
        $banner = $this->repo->create($data);

        if ($banner) {
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_location']);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới banner thành công.',
                'type' => 'success',
            ]));

            return response()->json([
                'rs' => 1,
                'msg' => 'Thêm mới banner thành công',
                'redirect_url' => route($this->data['controllerName'].'.edit', ['id' => $banner->id])
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Thêm mới banner không thành công'
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
        $this->data['title'] = 'Chỉnh sửa banner';

        $object = Banner::with('bannerPosition')->find($id);

        if (!$object) {
            abort(404, 'Không tìm thấy Banners');
        }

        $this->data['id'] = $id;
        $this->data['object'] = $object;

        $positions = $this->positionRepository->getOptionsBannerPosition($object->bannerPosition->page??null);

        $this->data['positions'] = $positions['positions'];
        $this->data['positions_options'] = $positions['positions_options'];

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
        $is_change_image = $request->input('is_change_image', 0);

        $rules = [
            'name' => 'required',
            'position_id' => 'required',
            'url' => 'nullable',
            'image_location' => 'nullable',
            'image_url' => 'nullable',
            'ordering' => 'nullable',
            'status' => 'nullable',
            'page' => 'nullable',
            'title_sub' => 'nullable',
            'description' => 'nullable',
        ];

        $messages = [
            'name.required' => 'Nhập tên Banners',
            'position_id.required' => 'Chọn vị trí Banners',
        ];

        $data = $this->validate($request, $rules, $messages);
        $temp_path = '';
        if ($is_change_image)
        {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);
            $data['image_url'] = config('app.url');
        }

        $object = $this->repo->find($id);

        if (!$object)
        {
            abort(404, 'Không tìm thấy Banners');
        }

        $data['user_modified'] = auth()->user()->id;

        $rs = $object->update($data);

        if ($rs)
        {
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_location']);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật banner thành công.',
                'type' => 'success',
            ]));

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật banner thành công'
                ]);
            }

            return redirect()->route($this->data['controllerName'].'.index');
        }
        else {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Cập nhật banner không thành công',
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
        $ids = $request->input('ids');

        if ($ids) {
            $rs = $this->repo->delete($ids);

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
