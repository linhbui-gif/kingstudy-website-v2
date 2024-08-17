<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Admin\Entities\CategoryNew;
use Modules\Admin\Entities\News;
use Modules\Admin\Repositories\News\NewsRepositoryInterface;

class NewsController extends Controller
{
    protected $repoNews;
    /**
     * Create a new controller instance.
     */
    public function __construct(NewsRepositoryInterface $repoNews)
    {
        $this->repoNews    = $repoNews;
        $this->data['title'] = 'Tin tức';
        $this->data['controllerName'] = 'admin::news';
        $this->view = 'admin::news';
    }
    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $filter['is_deleted'] = 0;
        $data = $this->repoNews->getListAll($filter,['title'],['is_deleted'],[]);
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }
    public function index(Request $request) {
        $params = $request->all();

        $this->data['params'] = $params;

        return view("{$this->view}.index", $this->data);
    }

    public function edit($id)
    {
        $object = $this->repoNews->find($id);
        $categories = new CategoryNew();

        if(!$object){
            abort(404);
        }

        $object['category_name'] = $categories->select('name')
            ->where('id',$object['category_id'])->get()->first()->name;
        $this->data['id'] = $id;
        $this->data['object'] = $object;

        $this->data['action'] = "Cập nhật";
        $this->data['categories'] = $categories->getListCategory();
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
        $is_change_image = $request->input('is_change_image', 0);
        $is_change_image_banner = $request->input('is_change_image_banner', 0);

        $rules = [
            'image_location' => 'required',
            'keywords' => 'required',
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'title.required' => 'Nhập tiêu đề tin tức.',
            'category_id.required' => 'Chọn danh mục tin tức.',
            'image_location.required' => 'Chọn ảnh đại diện.',
            'content.required' => 'Nhập nội dung tin tức.',
            'keywords.required' => 'Nhập từ khóa để SEO.',
        ];

        $data = $this->validate($request, $rules, $messages);

        $data = $request->all();
        $temp_path = '';
        $temp_path_banner = '';
        if ($is_change_image)
        {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);
            $data['image_url'] = config('app.url');
        }
        if ($is_change_image_banner)
        {
            $temp_path_banner = $data['image_location_banner'];
            $data['image_banner'] = General::generateImageLocation($temp_path_banner);
            $data['image_url'] = config('app.url');
        }
        $object = $this->repoNews->find($id);

        if (!$object)
        {
            abort(404, 'Không tìm thấy bài viết');
        }
        //$data['updated_at'] = now();
        $rs = $object->update($data);

        if ($rs)
        {
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_location']);
            }
            if (!empty($temp_path_banner))
                    {
                General::moveImage($temp_path_banner, $data['image_banner']);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật bài viết thành công.',
                'type' => 'success',
            ]));

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật bài viết thành công'
                ]);
            }

            return redirect()->route($this->data['controllerName'].'.index');
        }
        else {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Cập nhật bài viết không thành công',
                ]);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật bài viết không thành công.',
                'type' => 'error',
            ]));
        }

        return redirect()->route($this->data['controllerName'].'.edit', ['id' => $id]);
    }
    public function create()
    {
        $this->data['action'] = "Thêm mới";
        $categories = new CategoryNew();
        $this->data['categories'] = $categories->getListCategory();
        return view("{$this->view}.create", $this->data);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $is_change_image = $request->input('is_change_image', 0);
        $is_change_image_banner = $request->input('is_change_image_banner', 0);
        $temp_path = '';
        $temp_path_banner = '';
        if ($is_change_image)
        {
            $temp_path = $params['image_location'];
            $params['image_location'] = General::generateImageLocation($temp_path);
            $params['image_url'] = config('app.url');
        }
        if ($is_change_image_banner)
        {
            $temp_path_banner = $params['image_location_banner'];
            $params['image_location_banner'] = General::generateImageLocation($temp_path_banner);
            $params['image_url'] = config('app.url');
        }
        if (empty($params['alias'])) {
            $params['alias'] = Str::slug($params['title'],'-');
        }
        $params['image_url'] = config('app.url');

        $rs = $this->repoNews->create($params);
        if ($rs) {
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $params['image_location']);
            }
            if (!empty($temp_path_banner))
            {
                General::moveImage($temp_path_banner, $params['image_location_banner']);
            }
            return response()->json([
                'rs' => 1,
                'msg' => 'Thêm mới tin tức thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Thêm mới tin tức không thành công'
        ]);
    }
    public function delete(Request $request)
    {
        $ids = $request->input('id');

        $rs = $this->repoNews->delete($ids);

        if ($rs) {
            return response()->json([
                'rs' => 1,
                'msg' => 'Xoá thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Xoá không thành công'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     */
    public function inactive(Request $request)
    {
        $data = News::whereIn('id', $request->ids)->update(['status' => News::DEACTIVE]);

        return response()->json([
            'rs' => 0,
            'msg' => __('Update thành công')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function active(Request $request)
    {
        $data = News::whereIn('id', $request->ids)->update(['status' => News::ACTIVE]);

        return response()->json([
            'rs' => 0,
            'msg' => __('Update thành công')
        ]);
    }
}
