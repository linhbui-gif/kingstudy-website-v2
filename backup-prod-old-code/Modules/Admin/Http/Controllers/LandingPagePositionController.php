<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Admin\Entities\LandingPage;
use Modules\Admin\Entities\LandingPagePositionImages;
use Modules\Admin\Entities\LandingPagePositions;
use Modules\Admin\Entities\HomePositionsLocale;
use Modules\Admin\Entities\HomePositionImagesLocale;


class LandingPagePositionController extends Controller
{
    protected $view = 'admin::landing-page';
    protected $data = [];
    protected $models;
    public function __construct()
    {
        $this->models = new LandingPagePositions();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($landing_page_id,$position_id=null)
    {
        $positions = $this->models->getDataByLandingPageId($landing_page_id);

        if(empty($positions))
            abort(404);

        if(!$position_id){
            $position_id = array_keys($positions)[0];
        }else if(empty($positions[$position_id])){
            abort(404);
        }

        $landingPage = LandingPage::find($landing_page_id)->toArray();

        $object             = $positions[$position_id];
        $position_type      = $object['landing_page_position_types'];
        $this->data['landing_page_id']  = $landing_page_id;
        $this->data['position_id']      = $position_id;
        $this->data['positions']        = $positions;
        $this->data['object']           = $object;
        $this->data['position_type']    = $position_type;
        $this->data['landing_page']     = $landingPage;

        $this->data['title'] = "Quản trị nội dung";
        if (method_exists (new LandingPagePositionController,$position_type['type'])) {
            $this->{$position_type['type']}();
        }
        return view($this->view.'.index',$this->data);
    }
    public function update(Request $request,$position_id)
    {
        $params = $request->all();
        $is_change_image = $request->input('is_change_image', 0);

        $data = \App\Helpers\General::get_data_fillable(new LandingPagePositions(), $params);
        $temp_path = '';
        if ($is_change_image)
        {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);

            $url_cms = \App\Helpers\General::get_settings('url_cms');
            $url_cms = $url_cms['value'] ?? config('app.url');
            $data['image_url'] = $url_cms;
        }
        $rs = $this->models->updateData($data,$position_id);
        if($rs){
            $this->storeLocales($position_id, $params['locales']);
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_location']);
            }

            return response()->json([
                'rs' => 1,
                'msg' => 'Cập nhật thông tin thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Cập nhật thông tin không thành công',
        ]);
    }
    public function storeAll(Request $request){
        $params = $request->all();
        $position_id = $request->input('landing_page_position_id',false);
        $is_change_image = $request->input('is_change_image', 0);

        if(!$position_id){
            return response()->json([
                'rs' => 0,
                'msg' => 'Cập nhật thông tin thành công',
            ]);
        }

        $data = \App\Helpers\General::get_data_fillable(new \Modules\Admin\Entities\LandingPagePositions(), $params);
        $temp_path = '';
        if ($is_change_image)
        {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);

            $url_cms = \App\Helpers\General::get_settings('url_cms');
            $url_cms = $url_cms['value'] ?? config('app.url');
            $data['image_url'] = $url_cms;
        }
        $rs = $this->models->updateData($data,$position_id);
        if($rs){
            $this->storeLocales($position_id, @$params['locales']);
            if (!empty($temp_path))
            {
                General::moveImage($temp_path, $data['image_location']);
            }

            return $this->storePositionImages($request);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Cập nhật thông tin thành công',
        ]);
    }
    public function storePositionImages(Request $request)
    {
        try {
            \DB::beginTransaction();
            $data = $request->input('position_images', []);
            $landing_page_position_id = $request->input('landing_page_position_id', false);
            if (!$landing_page_position_id && empty($data)) {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Cập nhật thông tin không thành công',
                ]);
            }
            LandingPagePositionImages::where('home_position_id', $landing_page_position_id)->delete();
            HomePositionImagesLocale::where('home_position_id', $landing_page_position_id)->delete();
            $url_cms = \App\Helpers\General::get_settings('url_cms');
            $image_url = $url_cms['value'] ?? config('app.url');

            foreach ($data as $item) {
                $item['home_position_id'] = $landing_page_position_id;

                if (isset($item['is_change_image']) && $item['is_change_image']) {
                    $temp_path = $item['image_location'];
                    if (strpos($temp_path, '/') === 0) {
                        $temp_path = substr($temp_path, 1);
                    }

                    $item['image_location'] = General::generateImageLocation($temp_path);
                    General::moveImage($temp_path, $item['image_location']);

                    $item['image_url'] = $image_url;
                }

                if (isset($item['is_change_image_child']) && $item['is_change_image_child']) {
                    $temp_path = $item['image_child_location'];
                    if (strpos($temp_path, '/') === 0) {
                        $temp_path = substr($temp_path, 1);
                    }

                    $item['image_child_location'] = General::generateImageLocation($temp_path);
                    General::moveImage($temp_path, $item['image_child_location']);

                    $item['image_child_url'] = $image_url;
                }

                $rules = [
                    'ordering' => Rule::unique('home_position_images')->where(function ($query) use ($landing_page_position_id) {
                        $query->where('home_position_id', $landing_page_position_id);
                    }),
                ];

                $messages = [
                    'ordering.unique' => 'Thứ tự trùng',
                ];

                $valid = Validator::make($item, $rules, $messages);

                if ($valid->fails()) {
                    return response()->json([
                        'rs' => 0,
                        'msg' => 'Thứ tự trùng'
                    ]);
                }
                $position_images = LandingPagePositionImages::create($item);

                foreach ($item['locales'] as $locale => $item_locale) {
                    $item_locale += ['home_position_image_id' => $position_images->home_position_image_id, 'home_position_id' => $landing_page_position_id, 'locale' => $locale];
                    HomePositionImagesLocale::create($item_locale);
                }
            }
            \DB::commit();

            return response()->json([
                'rs' => 1,
                'msg' => 'Cập nhật thông tin thành công',
            ]);
        } catch (\Throwable $e) {
            dd($e);
            \DB::rollback();
        }
    }

    public function all()
    {
        $objects = $this->data['objects'] ?? [];
        $objects['position_image'] = \Modules\Admin\Entities\LandingPagePositionImages::with(['localeVi'])->where('home_position_id',$this->data['position_id'])->orderBy('ordering')->get()->toArray();
        $this->data['objects'] = $objects;
    }

    public function storeLocales($id, $locales) {
        if(!$locales) return false;
        foreach ($locales as $locale => $item) {
            $object = HomePositionsLocale::find(['home_position_id' => $id, 'locale' => $locale]);
            $item['updated_by'] = $this->get_user_id();
            if ($object) {
                $object->update($item);
            } else {
                $item += ['home_position_id' => $id, 'locale' => $locale];
                $item['created_by'] = $this->get_user_id();
                HomePositionsLocale::create($item);
            }
        }
    }
}
