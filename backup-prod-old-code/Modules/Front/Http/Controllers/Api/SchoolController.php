<?php
namespace Modules\Front\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\ProfileSubmited;
use Modules\Admin\Entities\School;
use Modules\Front\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Session;

class SchoolController extends Controller {
    use ApiResponseTrait;
    protected $data = [];
    public function index(Request $request){
        $limit = isset($request->limit) ? intval($request->limit) : 15;
        $page = isset($request->page) ? intval($request->page) : 1;
        $data = School::with('levels','courses','majors','country')
            ->select('school.id','school.name','school.heading','school.logo','country_id',
                'school.type_school','slug','keywords','meta_title','meta_description')
            ->orderByDesc('updated_at')
            ->paginate($limit, ['*'],'page', $page);
        return $this->successResponseJson($data);
    }
    public function getDetail ($slug = null) {
        $detail = School::where('slug',$slug)->first();
        if (!$detail) {
            return response()->json(
                [
                    'data' => null,
                    'message' => 'Get List School',
                    'code' => 404
                ],
                404
            );
        }
        $detail['majors']       = $detail->majors()->pluck('majors.name', 'majors.id')->toArray();
        $detail['courses']      = $detail->courses()->get()->toArray();
        $detail['number_info']  = json_decode($detail['number_info'],true);
        $detail['map']          = json_decode($detail['map'],true);
        $detail['program']      = json_decode($detail['program'],true);
        $detail['tuition']      = json_decode($detail['tuition'],true);
        $detail['scholarship']  = json_decode($detail['scholarship'],true);
        $detail['required']     = json_decode($detail['required'],true);
        $detail['gallery']      = json_decode($detail['gallery'],true);
        $detail['feed_back']    = json_decode($detail['feed_back'],true);
        $detail['featured']    = json_decode($detail['featured'],true);
        $detail['relatedSchool'] = [];
        if($detail->country && $detail->country->id) {
            $detail['relatedSchool']  = School::where('country_id', $detail->country->id)->where('id','<>', @$detail->id)->where('status', 1)->get();
        }

        $checkHoSo = false;
        if(auth()->user()){
            $user  = auth()->user();
            $profile = ProfileSubmited::where('user_id', $user->id)->first();
            if($profile){
                $checkHoSo = true;
            }
        }
        return $this->successResponseJson([
            'data' => [
                'data' => $detail,
                'hasDocument' => $checkHoSo
            ]
        ]);
    }
    public function filterSchool(Request $request) {
        $limit = isset($request->limit) ? intval($request->limit) : 15;
        $page = isset($request->page) ? intval($request->page) : 1;
        $sql    = School::with('levels','courses','majors','country')->select('school.id','school.name','school.heading','school.logo','country_id', 'school.type_school','slug','keywords','meta_title','meta_description','school.price');
        $country = $request->input('country',0);
        if($country > 0 ){
            $sql = $sql->whereHas('country', function ($query) use($country) {
                $query->where('country_id','=',$country);
            });
        }
        $levelcourse = $request->input('levelcourse',0);
        if($levelcourse > 0 ){
            $sql = $sql->whereHas('levels', function ($query) use($levelcourse) {
                $query->where('level_id','=',$levelcourse);
            });
        }
        $survey_tuition = $request->input('survey_tuition',0);
        if($survey_tuition > 0 ) {
            $survey_tuition = (int)$survey_tuition;
            if($survey_tuition > 500000000 && $survey_tuition < 1000000000) {
                $sql = $sql->whereBetween('survey_tuition',[500000000,1000000000]);
            }else if ($survey_tuition < 500000000 )  {
                $sql = $sql->where('survey_tuition','<',$survey_tuition);
            }else {
                $sql = $sql->where('survey_tuition','>',$survey_tuition);
            }
        }
        $majors = $request->input('majors',0);
        if($majors > 0 ){
            $sql = $sql->whereHas('majors', function ($query) use($majors) {
                    $query->where('majors_id','=',$majors);
            });
        }
        $ranking = $request->input('ranking',0);
        if($ranking > 0 ){
            $sql = $sql->whereHas('rankings', function ($query) use($ranking) {
                $query->where('ranking_id','=',$ranking);
            });
        }
        $keyword = $request->input('keywords','');
        if(!empty($keyword))
        {
            $sql->where(function ($query) use ($keyword)
            {
                $sql = $query->where('school.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('school.heading', 'LIKE', '%' . $keyword . '%');
            });
        }
        $province = $request->input('province',0);
        if($province > 0 ){
            $sql = $sql->where('province_id',$province);
        }
        $data = $sql->orderBy('name',"ASC")
            ->where('status', 1)
            ->orderByDesc('updated_at')
            ->paginate($limit, ['*'],'page', $page);
        return $this->successResponseJson($data);
    }
    public function addCompareSchool(Request $request){
        if ($request->session()->has('compare_list')){
            $compare_list = $request->session()->get('compare_list');
            if(count($compare_list) < 4){
                if(!in_array($request->id, $compare_list)){
                    $compare_list[] = $request->id;

                    $items = [];

                    foreach ($compare_list as $com){
                        $school = School::find($com);
                        $item = [ 'id' => $school->id, 'logo' => $school->logo ];
                        $items[] = $item;
                    }
                    $request->session()->put('compare_list', $compare_list);
                    return $this->successResponseJson($items,'Thêm thành công');
                } else {
                    return $this->errorResponseJson('Đã tồn tại trong danh sách so sánh');
                }
            }

        } else {
            $item[] = $request->id;
            $request->session()->put('compare_list', $item);
            $school = School::find($request->id);
            return $this->successResponseJson([ [ "id" => $school->id, "logo" => $school->logo ]  ],'Thêm thành công');
        }
    }
    public function listCompare(Request $request){
        $compare_list = [];
        if ($request->session()->has('compare_list')){
            $compare_list = $request->session()->get('compare_list');
        }

        $listSchool = [];

        foreach ($compare_list as $idSchool){
            $listSchool[] = DB::table("school")->select("*")->find($idSchool);
       }
        return $this->successResponseJson($listSchool, 'Lấy danh sách trường so sánh thành công');
    }
    public function removeCompare(Request $request){
        $id = $request->id;
        if ($request->session()->has('compare_list')){
            $compare_list = $request->session()->get('compare_list');
            foreach($compare_list as $k => $com){
                if($com == $id){
                    unset($compare_list[$k]);
                }
            }
            $request->session()->put('compare_list', $compare_list);
        }
        return $this->successResponseJson([], 'Xóa trường thành công');
    }
    public function surveySchool(Request $request) {
        $sql    = School::with('majors')->select('school.id','school.name','school.heading','school.logo','opening_time',
            'school.type_school','slug','keywords','meta_title','meta_description');
        $majors = $request->input('majors',0);
        if($majors > 0){
            $sql = $sql->whereHas('majors', function ($query) use($majors) {
                $query->where('majors_id','=',$majors);
            });
        }
        $country_id = json_decode($request->input('country_id',[]));
        if(!empty($country_id)) {
            $sql = $sql->whereIn('country_id',$country_id);
        }
        $survey_mark_thpt = $request->input('survey_mark_thpt',0);
        if($survey_mark_thpt > 0 ) {
            $sql = $sql->where('survey_mark_thpt','<',$survey_mark_thpt);
        }
        $survey_mark_dh = $request->input('survey_mark_dh',0);
        if($survey_mark_dh > 0 ) {
            $sql = $sql->where('survey_mark_dh','<',$survey_mark_dh);
        }
        $survey_mark_ts = $request->input('survey_mark_ts',0);
        if($survey_mark_ts > 0 ) {
            $sql = $sql->where('survey_mark_ts','<',$survey_mark_ts);
        }
        $survey_mark_ct = $request->input('survey_mark_ct',0);
        if($survey_mark_ct > 0 ) {
            $sql = $sql->where('survey_mark_ct','<',$survey_mark_ct);
        }
        $survey_mark_gpa = $request->input('survey_mark_gpa',0);
        if($survey_mark_gpa > 0 ) {
            $sql = $sql->where('survey_mark_gpa','<',$survey_mark_gpa);
        }
        $survey_tuition = $request->input('survey_tuition',0);
        if($survey_tuition > 0 ) {
            $survey_tuition = (int)$survey_tuition;
            if($survey_tuition > 500000000 && $survey_tuition < 1000000000) {
                $sql = $sql->whereBetween('survey_tuition',[500000000,1000000000]);
            }else if ($survey_tuition < 500000000 )  {
                $sql = $sql->where('survey_tuition','<',$survey_tuition);
            }else {
                $sql = $sql->where('survey_tuition','>',$survey_tuition);
            }
        }
        $survey_mark_ielts = $request->input('survey_mark_ielts',0);
        if($survey_mark_ielts > 0 ) {
            $survey_mark_ielts = (float)$survey_mark_ielts;
            if($survey_mark_ielts > 5.5 && $survey_mark_ielts < 7) {
                $sql = $sql->whereBetween('survey_mark_ielts',[5.5,7]);
            }else if ($survey_mark_ielts < 5.5){
                $sql = $sql->where('survey_mark_ielts','<',$survey_mark_ielts);
            }else {
                $sql = $sql->where('survey_mark_ielts','>',$survey_mark_ielts);
            }
        }
        $schools = $sql->orderBy('created_at',"DESC")->get()->toArray();
        $new_school = [];
        $startTime = $request->input('startTime','');
        if(count($schools))
        {
            if(!empty($startTime)) {
                if($startTime == 15) {
                    $schools = [];
                }
                else {
                    $time_           = explode(',',$startTime);
                    $student_time   = Carbon::now()->addMonths((int)$time_[0]);
                    $student_time_2 = Carbon::now()->addMonths((int)$time_[1]);
                    foreach($schools as $k => $school ) {
                        $arr_times = json_decode($school['opening_time']);
                        if(!empty($arr_times)) {
                            sort($arr_times);
                            foreach($arr_times as $k_time => $time) {
                                $time_opening = Carbon::now()->month((int)$time)->addDays(1);
                                if($time_opening < Carbon::now()){
                                    $time_opening->modify('next year');
                                }
                                if($time_opening->between($student_time,$student_time_2)) {
                                    $new_school[] = $schools[$k];
                                    break;
                                }else {
                                    unset($arr_times[$k]);
                                }
                            }
                        }
                    }
                    $schools = $new_school;
                }
            }
        }
        return $this->successResponseJson($schools);
    }
}
