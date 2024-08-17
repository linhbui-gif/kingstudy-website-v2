<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\City;
use Modules\Admin\Entities\School;
use Modules\Admin\Entities\Course;
use Modules\Admin\Entities\Majors;
use Modules\Admin\Entities\Ranking;
use Modules\Admin\Entities\LevelCourse;
use Modules\Admin\Entities\Country;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Modules\Admin\Repositories\School\SchoolRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        SchoolRepositoryInterface $repository

    )
    {
        $this->repo = $repository;
        $this->data['controllerName'] = 'admin::school';
    }

    public function search(Request $request)
    {
        $filter = $request->all();
        $filter['offset'] = $request->input('offset', 0);
        $filter['limit'] = $request->input('limit', 10);
        $filter['sort'] = $request->input('sort', 'id');
        $filter['order'] = $request->input('order', 'desc');
        $data = $this->repo->getListAll($filter);
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
        $this->data['title'] = 'trường học';
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
        $this->data['courses']   = Course::select('id','name')->where('status',1)->get()->toArray();
        $this->data['majors']    = Majors::select('id','name')->where('status',1)->get()->toArray();
        $this->data['levels']    = LevelCourse::select('id','name')->where('status',1)->get()->toArray();
        $this->data['rankings']  = Ranking::select('id','name')->where('status',1)->get()->toArray();
        $this->data['countries'] = Country::select('id','name')->where('status',1)->get()->toArray();
        $this->data['cities'] = City::select('id','name')->get()->toArray();
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
        $is_change_image_meta_thumbnail = $request->input('is_change_image_meta_thumbnail',0);
        $is_change_image_logo = $request->input('is_change_image_logo',0);
        $is_change_image_gallery = $request->input('is_change_image_gallery', 0);
        $data['is_vip']          = $request->input('is_vip', 0);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name'],'-');
        }
        $data['map']         = json_encode($data['map']);
        $data['program']     = json_encode($data['program']);
        $data['tuition']     = json_encode($data['tuition']);
        if(isset($data['opening_time'])) {
            $data['opening_time']     = json_encode($data['opening_time']);
        }
        $data['survey_tuition']  = (int)str_replace(',','',$data['survey_tuition']);
        $data['created_by']  = Auth::user()->id;
        if(isset($data['scholarship'])) {
            $data['scholarship']     = json_encode($data['scholarship']);
        }
        if(isset($data['required'])) {
            $data['required']     = json_encode($data['required']);
        }
        if(isset($data['number_info'])) {
            $data['number_info']     = json_encode($data['number_info']);
        }
        if(isset($data['featured'])) {
            $data['featured']     = json_encode($data['featured']);
        }
        $temp_path_banner = '';
        $temp_path_logo = '';
        $temp_path_thumbnail = '';
        if ($is_change_image) {
            $temp_path_banner = $data['image_location'];
            $data['banner'] = General::generateImageLocation($temp_path_banner);
        }
        if ($is_change_image_logo) {
            $temp_path_logo = $data['image_location_logo'];
            $data['logo'] = General::generateImageLocation($temp_path_logo);
        }
        if ($is_change_image_meta_thumbnail) {
            $temp_path_thumbnail = $data['image_location_meta_thumbnail'];
            $data['meta_thumbnail'] = General::generateImageLocation($temp_path_thumbnail);
        }
        // Gallery
        $temp_path_gallery = '';
        if(isset($data['gallery'])) {
            foreach($data['gallery'] as $k => $gallery) {
                $temp_path_gallery = $gallery;
                $data['gallery'][$k] = General::generateImageLocation($temp_path_gallery);
                if(!empty($temp_path_gallery)) {
                    General::moveImage($temp_path_gallery, $data['gallery'][$k]);
                }
            }
            $data['gallery'] = json_encode($data['gallery']);
        }else {
            $data['gallery'] = '';
        }
        // end
        // Feedback
        $temp_path_feedback = '';
        if(isset($data['feed_back'])) {
            foreach($data['feed_back'] as $k => $feedback) {
                $temp_path_feedback = $data['feed_back'][$k]['image'];
                $data['feed_back'][$k]['image'] = General::generateImageLocation($temp_path_feedback);
                if(!empty($temp_path_feedback)) {
                    General::moveImage($temp_path_feedback, $data['feed_back'][$k]['image']);
                }
            }
            $data['feed_back'] = json_encode($data['feed_back']);
        }else {
            $data['feed_back'] = '';
        }
        // end feedback
        $rs = School::create($data);
        if ($rs) {
            $rs->majors()->attach($data['majors']);
            $rs->courses()->attach($data['courses']);
            $rs->levels()->attach($data['levels']);
            $rs->rankings()->attach($data['levels']);
            if (!empty($temp_path_banner))
            {
                General::moveImage($temp_path_banner, $data['banner']);

            }
            if(!empty($temp_path_logo)) {
                General::moveImage($temp_path_logo, $data['logo']);
            }
        }
        if ($rs) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Thêm mới thành công',
                    'redirect_url' => route($this->data['controllerName'].'.edit', ['id' => $rs->id])
                ]);
            }
        }else {
             $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới thất bại.',
                'type' => 'erro',
            ]));
        }
        return redirect()->route($this->data['controllerName'].".index");
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

        $object = School::find($id);
        if (!$object) {
            abort(404, 'Không tìm thấy ngành học này !!');
        }
        $object['majors']       = $object->majors()->pluck('majors.id','majors.name')->toArray();
        $object['courses']      = $object->courses()->pluck('course.id','course.name')->toArray();
        $object['levels']       = $object->levels()->pluck('level.id','level.name')->toArray();
        $object['rankings']       = $object->rankings()->pluck('ranking.id','ranking.name')->toArray();
        $object['number_info']  = json_decode($object['number_info'],true);
        $object['map']          = json_decode($object['map']);
        $object['program']      = json_decode($object['program']);
        $object['tuition']      = json_decode($object['tuition']);
        $object['scholarship']  = json_decode($object['scholarship'],true);
        $object['required']     = json_decode($object['required'],true);
        $object['gallery']      = json_decode($object['gallery'],true);
        $object['feed_back']    = json_decode($object['feed_back'],true);
        $object['opening_time'] = json_decode($object['opening_time'],true);
        $object['featured'] = json_decode($object['featured'],true);
        $this->data['courses']  = Course::select('id',\DB::raw('CONCAT_WS("-",name, kyhieu) AS name'))->where('status',1)->get()->toArray();
        $this->data['majors']   = Majors::select('id','name')->where('status',1)->get()->toArray();
        $this->data['levels']   = levelCourse::select('id','name')->where('status',1)->get()->toArray();
        $this->data['rankings'] = Ranking::select('id','name')->where('status',1)->get()->toArray();
        $this->data['countries'] = Country::select('id','name')->where('status',1)->get()->toArray();
        $this->data['cities'] = City::select('id','name')->get()->toArray();
        $this->data['id']       = $id;
        $this->data['object']   = $object;
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
        $is_change_image         = $request->input('is_change_image',0);
        $is_change_image_logo    = $request->input('is_change_image_logo',0);
        $is_change_image_meta_thumbnail = $request->input('is_change_image_meta_thumbnail',0);
        $is_change_image_gallery = $request->input('is_change_image_gallery', 0);
        $data['is_vip']          = $request->input('is_vip', 0);
        $data['map']         = json_encode($data['map']);
        $data['program']     = json_encode($data['program']);
        $data['tuition']     = json_encode($data['tuition']);
        if(isset($data['opening_time'])) {
            $data['opening_time']     = json_encode($data['opening_time']);
        }
        $data['survey_tuition']  = (int)str_replace(',','',$data['survey_tuition']);
        if(isset($data['scholarship']))
        {
            foreach($data['scholarship'] as $k => $val) {
                if($val['content'] == null || $val['title'] == null ) {
                    unset($data['scholarship'][$k]);
                }
            }
        }
        if(isset($data['required']))
        {
            foreach($data['required'] as $k => $val) {
                if($val['content'] == null || $val['title'] == null ) {
                    unset($data['required'][$k]);
                }
            }
        }
        if(isset($data['number_info']))
        {
            foreach($data['number_info'] as $k => $val) {
                if($val['number'] == null || $val['title'] == null ) {
                    unset($data['number_info'][$k]);
                }
            }
        }
        $data['updated_by']      = Auth::user()->id;
        $temp_path_banner        = '';
        $temp_path_logo          = '';
        $temp_path_thumbnail         = '';
        if ($is_change_image)
        {
            $temp_path_banner    = $data['image_location'];
            $data['banner']      = General::generateImageLocation($temp_path_banner);
        }
        if ($is_change_image_logo)
        {
            $temp_path_logo      = $data['image_location_logo'];
            $data['logo']        = General::generateImageLocation($temp_path_logo);
        }
        if ($is_change_image_meta_thumbnail)
        {
            $temp_path_thumbnail      = $data['image_location_meta_thumbnail'];
            $data['meta_thumbnail']        = General::generateImageLocation($temp_path_thumbnail);
        }
        $object = School::find($id);
        if (!$object)
        {
            abort(404, 'Không tìm thấy ');
        }
        // Feedback
        $temp_path_feedback = '';
        if(isset($data['feed_back'])) {
            foreach($data['feed_back'] as $k => $feedback) {
                if($feedback['is_change_image']){
                    $temp_path_feedback = $data['feed_back'][$k]['image'];
                    $data['feed_back'][$k]['image'] = General::generateImageLocation($temp_path_feedback);
                    if(!empty($temp_path_feedback)) {
                        General::moveImage($temp_path_feedback, $data['feed_back'][$k]['image']);
                    }
                }
            }
            $data['feed_back'] = json_encode($data['feed_back']);
        }else {
            $data['feed_back'] = '';
        }
        // end feedback
        // Gallery
        $temp_path_gallery = '';
        if(isset($data['gallery'])){
            foreach($data['gallery'] as $k => $gallery) {
                if($gallery['is_change_image']){
                    $temp_path_gallery = $data['gallery'][$k]['image'];
                    $data['gallery'][$k]['image'] = General::generateImageLocation($temp_path_gallery);
                    if($object) {
                        General::moveImage($temp_path_gallery, $data['gallery'][$k]['image']);
                    }
                }
            }
            $data['gallery'] = json_encode($data['gallery']);
        }else {
            $data['gallery'] = '';
        }
        //
        if ($object) {
            if (!empty($temp_path_banner))
            {
                General::moveImage($temp_path_banner, $data['banner']);

            }
            if(!empty($temp_path_logo)) {
                General::moveImage($temp_path_logo, $data['logo']);
            }
            if(!empty($temp_path_thumbnail)) {
                General::moveImage($temp_path_thumbnail, $data['meta_thumbnail']);
            }
        }
        $rs = $object->update($data);
        if ($rs)
        {
            $object->majors()->sync($data['majors']);
            $object->courses()->sync($data['courses']);
            $object->levels()->sync($data['levels']);
            $object->rankings()->sync($data['rankings']);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Cập nhật thành công',
                    'type' => 'success',
                    'redirect_url' => route($this->data['controllerName'].'.edit', ['id' => $id])
                ]);
            }
        }
        else {
             $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật không thành công.',
                'type' => 'error',
            ]));
        }
        return redirect()->route($this->data['controllerName'].'.edit', ['id' => $id]);
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids');
        if(is_array($ids)) {
            foreach($ids as $id) {
                $obj = School::find($id);
                $obj->majors()->detach();
                $obj->courses()->detach();
                $obj->levels()->detach();
                $obj->delete();
            }
        }else {
            $obj = School::find($ids);
            $obj->majors()->detach();
            $obj->courses()->detach();
            $obj->levels()->detach();
            $obj->delete();
        }
        if ($obj) {
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



}
