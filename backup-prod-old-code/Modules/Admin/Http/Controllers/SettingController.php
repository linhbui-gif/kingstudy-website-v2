<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use App\Helpers\General;
use Modules\Admin\Repositories\Setting\SettingRepositoryInterface;

class SettingController extends Controller
{
    protected $data = [];

    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->repository    = $repository;
        $this->data['title'] = 'Cài đặt';
        $this->data['controllerName'] = 'admin::setting';
        $this->view = 'admin::setting';
    }
    public function index(Request $request)
    {
        $this->data['title'] = 'Cài đặt';

        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        $page = $request->input('page', 1);
        $keyword = $request->input('keyword', '');

        $objects = Setting::select('*')->where('active', 1);
        if ($keyword) {
            $objects->where(function ($sub) use ($keyword) {
                $sub->where('key', 'LIKE', '%'.$keyword.'%');
                $sub->orWhere('name', 'LIKE', '%'.$keyword.'%');
                $sub->orWhere('description', 'LIKE', '%'.$keyword.'%');
            });
        }
        $objects->orderBy('id', 'desc');

        $objects = $objects->paginate($limit)->toArray();
        $this->data['objects'] = $objects;

        return view("{$this->data['controllerName']}.index", $this->data);
    }

    public function metaSeo()
    {
        $this->data['title'] = 'Meta SEO';

        $objects = Setting::select('*')
            ->whereIn('key', ['og_title', 'og_keywords', 'og_image', 'og_description'])
            ->get()->toArray();

        foreach ($objects as $tmp) {
            $objects[$tmp['key']] = $tmp;
        }

        $this->data['objects'] = $objects;

        return view("{$this->data['controllerName']}.meta-seo", $this->data);
    }

    public function storeMetaSeo(Request $request)
    {
        $is_change_image = $request->input('is_change_image', 0);
        $data = $request->all();

        $count = 0;
        if (isset($data['og_title'])) {
            $rs = Setting::where('key', 'og_title')->update(['value' => $data['og_title']]);
            if ($rs) {
                $count += 1;
            }
        }
        if (isset($data['og_keywords'])) {
            $rs = Setting::where('key', 'og_keywords')->update(['value' => $data['og_keywords']]);
            if ($rs) {
                $count += 1;
            }
        }
        if (isset($data['og_description'])) {
            $rs = Setting::where('key', 'og_description')->update(['value' => $data['og_description']]);
            if ($rs) {
                $count += 1;
            }
        }

        $temp_path = '';
        if ($is_change_image && isset($data['image_location'])) {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);

            $rs = Setting::where('key', 'og_image')->update(['value' => config('app.url') . $data['image_location']]);

            General::moveImage($temp_path, $data['image_location']);
            if ($rs) {
                $count += 1;
            }
        }

        $res = true;
        return response()->json([
            'rs' => 1,
            'msg' => 'Cập nhật meta seo thành công',
            'res' => $res
        ]);
    }

    public function vimeo()
    {
        $this->data['title'] = 'Vimeo';

        $objects = Setting::select('*')
            ->whereIn('key', ['vimeo_client', 'vimeo_secret', 'vimeo_access'])
            ->get()->toArray();

        foreach ($objects as $tmp) {
            $objects[$tmp['key']] = $tmp;
        }

        $this->data['objects'] = $objects;

        return view("{$this->data['controllerName']}.vimeo", $this->data);
    }

    public function storeVimeo(Request $request)
    {
        $data = $request->all();

        $count = 0;
        if (isset($data['vimeo_client'])) {
            $rs = Setting::where('key', 'vimeo_client')->update(['value' => $data['vimeo_client']]);
            if ($rs) {
                $count += 1;
            }
        }
        if (isset($data['vimeo_secret'])) {
            $rs = Setting::where('key', 'vimeo_secret')->update(['value' => $data['vimeo_secret']]);
            if ($rs) {
                $count += 1;
            }
        }
        if (isset($data['vimeo_access'])) {
            $rs = Setting::where('key', 'vimeo_access')->update(['value' => $data['vimeo_access']]);
            if ($rs) {
                $count += 1;
            }
        }


        $res = true;
        return response()->json([
            'rs' => 1,
            'msg' => 'Cập nhật vimeo thành công',
            'res' => $res
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $id = $request->input('id', 0);
        $is_change_image = $request->input('is_change_image', 0);

        $rules = [
            'value' => 'required',
        ];

        $messages = [
            'value.required' => 'Nhập giá trị cài đặt.',
        ];

        $valid = Validator::make($data, $rules, $messages);

        if ($valid->fails()) {
            return response()->json([
                'rs' => 0,
                'msg' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $valid->errors()->messages(),
                'data' => $data
            ]);
        }

        if (isset($data['id']) && $data['id']) {

            $data_update = \App\Helpers\General::get_data_fillable(new Setting(), $data);

            $temp_path = '';
            if ($is_change_image && $data['field_image']) {
                $temp_path = $data['field_image'];
                $data['field_image'] = General::generateImageLocation($temp_path);
                $data_update['value'] = config('app.url') . $data['field_image'];
            }

            $rs = Setting::find($id)->update($data_update);

            if ($rs) {
                if ($is_change_image && $temp_path) {
                    General::moveImage($temp_path, $data['field_image']);
                }

                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật cài đặt thành công',
                ]);
            }

            return response()->json([
                'rs' => 0,
                'msg' => 'Cập nhật cài đặt không thành công'
            ]);

        }

        $rs = Setting::create($data);
        if ($rs) {
            return response()->json([
                'rs' => 1,
                'msg' => 'Thêm cài đặt thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Thêm cài đặt không thành công'
        ]);
    }

}
