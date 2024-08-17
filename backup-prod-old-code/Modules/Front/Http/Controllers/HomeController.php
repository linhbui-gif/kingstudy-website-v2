<?php

namespace Modules\Front\Http\Controllers;

use App\Helpers\General;
use Modules\Admin\Entities\Banner;
use Modules\Admin\Entities\CategoryNew;
use Modules\Admin\Entities\City;
use Modules\Admin\Entities\PostTiktok;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\LevelCourse;
use Modules\Admin\Entities\Course;
use Modules\Admin\Entities\Majors;
use Modules\Admin\Entities\ProfileSubmited;
use Modules\Admin\Entities\Ranking;
use Modules\Admin\Entities\School;
use Modules\Admin\Entities\News;
use Modules\Admin\Entities\Country;
use Modules\Admin\Entities\Contacts;
use Modules\Admin\Entities\StudyAbroad;
use Modules\Admin\Entities\LandingPagePositions;
use Modules\Admin\Entities\LandingPagePositionImages;
use Modules\Admin\Entities\ProfileAbroad;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->data['controllerName'] = 'front::home';
    }
    public function index(Request $request)
    {
        $this->data['title']         = "Trang chủ";
//        return redirect('/admin');
        $this->data['courses']       =  Course::select('id','description','image_url','name')
            ->limit(6)->where('show_home', 1)->where('status', 1)->orderBy('id','DESC')->get()->toArray();
        $datas                       = LandingPagePositions::getDataByLandingPageId(1);
        if($datas) {
            foreach($datas as $data) {
                $position_id[] = $data['id'];
            }
        }
        $this->data['datas']     = $datas;
        $this->data['items'] = LandingPagePositionImages::with(['localeVi'])->whereIn('home_position_id',$position_id)
            ->orderBy('ordering')->get()->groupBy('home_position_id')->toArray();
        $this->data['banners'] = DB::table('banners')
            ->select(['name', 'position_id','ordering','status','is_deleted','image_location','image_url','title_sub','description','url'])
            ->where('position_id',1)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('ordering','ASC')
            ->get();
        return view("{$this->data['controllerName']}.index", $this->data);
    }
    public function search_school(Request $request)
    {
        $sql    = School::with('levels','courses','majors','country')
            ->select('school.id','school.name','school.heading','school.logo','country_id',
                'school.type_school','slug','keywords','meta_title','meta_description');
        $country = $request->input('country',0);
        if($country > 0 ){
            $sql = $sql->whereHas('country', function ($query) use($country) {
                $query->where('country_id','=',$country);
            });
        }
        //
        $levelcourse = $request->input('levelcourse',0);
        if($levelcourse > 0 ){
            $sql = $sql->whereHas('levels', function ($query) use($levelcourse) {
                $query->where('level_id','=',$levelcourse);
            });
        }
//        $course = $request->input('course',0);
//         if($course > 0 ){
//            $sql = $sql->whereHas('courses', function ($query) use($course) {
//                                $query->where('course_id','=',$course);
//                            });
//        }
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
        $keyword = $request->input('keywords_','');
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
        $datas = $sql->orderBy('name',"ASC")
            ->where('status', 1)
            ->get()
            ->toArray();
        return view("{$this->data['controllerName']}.search-school",compact('datas'));
    }

    public function news(Request $request)
    {
        $datas                       = LandingPagePositions::getDataByLandingPageId(9);
        $list_news = News::select('id','title','alias','image_location','description','keywords','meta_title','meta_description','created_at')
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('id','DESC')
            ->paginate(9)->toArray();
        return view('front::news.index',compact('list_news','datas'));
    }

    public function details_news ($slug = null)
    {
        $details = '';
        if($slug != null) {
            $details = News::where('alias',$slug)->first();
            $list_news = News::select('id','title','alias','image_location','description','keywords','meta_title','meta_description','created_at')
                ->where('status', 1)
                ->where('is_deleted', 0)
                ->where('alias','!=',$slug)
                ->limit(5)
                ->get()
                ->toArray();
        }
        return view('front::news.details',compact('details','list_news'));
    }

    public function details_school ($slug = null)
    {
        $detail = School::where('slug',$slug)->first();
//        $school = @$detail->country->id;
        if (!$detail) {
            abort(404, 'Không tìm thấy ngành học này !!');
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
        $detail['relatedSchool'] = [];
        if($detail->country && $detail->country->id) {
            $detail['relatedSchool']  = School::where('country_id', $detail->country->id)->where('id','<>', @$detail->id)->where('status', 1)->get();
        }

        // check co ho so
        $checkHoSo = false;
        if(auth()->user()){
            $user  = auth()->user();
            $profile = ProfileSubmited::where('user_id', $user->id)->first();
            if($profile){
                $checkHoSo = true;
            }
        }

        return view('front::school.details',compact('detail', 'checkHoSo'));
    }

    public function contact() {
        return view('front::contact.index');
    }

    public function survey()
    {
        $countries = Country::select('id','name','logo','icon')->where('status',1)->get()->toArray();
        $majors    = Majors::select('id','name')->where('status',1)->get()->toArray();
        return view('front::survey.index',compact('countries','majors'));
    }

    public function survey_school(Request $request)
    {
        $sql    = School::with('majors')->select('school.id','school.name','school.heading','school.logo','opening_time',
            'school.type_school','slug','keywords','meta_title','meta_description');
        $majors = $request->input('majors',0);
        if($majors > 0){
            $sql = $sql->whereHas('majors', function ($query) use($majors) {
                $query->where('majors_id','=',$majors);
            });
        }
        $country_id = $request->input('country_id',[]);
        if(count($country_id) > 0 ) {
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
                    $schools = $new_school;
                }
            }
        }
        return view("front::survey.search",compact('schools'));
    }
    public function study_abroad_information(Request $request)
    {
        if($request->isMethod('POST')) {
            DB::beginTransaction();
            try {
                $data = $request->all();
                $data['job_salary'] = (int)(str_replace(',','',$data['job_salary']));
                $data['birth_day']                           = date('Y-m-d',strtotime($data['birth_day']));
                $data['identity_card_date']                  = date('Y-m-d',strtotime($data['identity_card_date']));
                $data['identity_card_expiration_date']       = date('Y-m-d',strtotime($data['identity_card_expiration_date']));
                $data['passport_date']                       = date('Y-m-d',strtotime($data['passport_date']));
                $data['other_passport_date']                 = date('Y-m-d',strtotime($data['other_passport_date']));
                $data['other_passport_card_expiration_date'] = date('Y-m-d',strtotime($data['other_passport_card_expiration_date']));
                $data['father_birth_day']                    = date('Y-m-d',strtotime($data['father_birth_day']));
                $data['mother_birth_day']                    = date('Y-m-d',strtotime($data['mother_birth_day']));
                $data['spouse_birth_day']                    = date('Y-m-d',strtotime($data['spouse_birth_day']));
                $data['child_1_birth_day']                   = date('Y-m-d',strtotime($data['child_1_birth_day']));
                $data['child_2_birth_day']                   = date('Y-m-d',strtotime($data['child_2_birth_day']));
                $data['ielts_date']                          = date('Y-m-d',strtotime($data['ielts_date']));
                $data['user_id']                             = Auth::user()->id;
                $rs                                          = ProfileAbroad::updateOrCreate(['user_id' => Auth::user()->id],$data);
                if($rs)
                {
                    $user = User::findOrFail(Auth::user()->id);
                    $user->update(['status_profile_aborad' => 1]);
                    DB::commit();
                    return response()->json([
                        'rs' => 1,
                        'msg' => 'Cập nhật thành công',
                        'type' =>'success',
                    ]);
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
                DB::rollback();
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Cập nhật thất bại',
                    'redirect_url' => route('study_abroad_information'),
                ]);
            }
        }
        $object = ProfileAbroad::where('user_id',Auth::user()->id)->first();
        if($object)
        {
            $infor = $object;
            return view('front::profile.index',compact('infor'));
        }
        return view('front::profile.index');
    }

    public function create_contacts(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $rules = [
                'national' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'level_course' => 'required',
                'email' => 'required',
                'ielts' => 'required',
            ];
            if(isset($request->type) && $request->type == 'footer') {
                $rules =
                    [
                        'name' => 'required',
                        'email' => 'required',
                    ];
            }
            $valid = Validator::make($data, $rules,["Error"]);
            if ($valid->fails())
            {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Dữ liệu nhập không hợp lệ',
                    'errors' => $valid->errors()->messages(),
                    'redirect_url' => route('trang-chu')
                ]);
            }
            $rs = Contacts::create($data);
            if($rs)
            {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Gửi thành công ',
                    'redirect_url' => route('trang-chu')
                ]);

            }
        }
    }
    public function addCompare(Request $request){
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
                    return [
                        'rs' => 1,
                        'data' => $items,
                        'msg' => 'Thêm thành công'
                    ];

                }else{
                    return [
                        'rs' => 0,
                        'msg' => 'Đã tồn tại'
                    ];
                }
            }

        }else{
            $item[] = $request->id;
            $request->session()->put('compare_list', $item);
            $school = School::find($request->id);
            return [
                'rs' => 1,
                'data' => [ [ "id" => $school->id, "logo" => $school->logo ]  ],
                'msg' => 'Thêm thành công'
            ];
        }
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
        return redirect()->back();
    }
    public function listCompare(Request $request){
        $compare_list = [];
        if ($request->session()->has('compare_list')){
            $compare_list = $request->session()->get('compare_list');
        }

        $listSchool = [];

        foreach ($compare_list as $com){
            $listSchool[] = School::find($com);
        }

        // check co ho so
        $checkHoSo = false;
        if(auth()->user()){
            $user  = auth()->user();
            $profile = ProfileSubmited::where('user_id', $user->id)->first();
            if($profile){
                $checkHoSo = true;
            }
        }

        return view('front::school.compare')->with('listSchool', $listSchool)->with('checkHoSo', $checkHoSo);

    }


    public function dieukhoan(Request $request){
        $datas                       = LandingPagePositions::getDataByLandingPageId(8);
        $object = $datas[32];
        return view("front::myAccount.dieukhoan")->with('object', $object);
    }

    public function exportPDF(Request $request){
        $compare_list = [];
        if ($request->session()->has('compare_list')){
            $compare_list = $request->session()->get('compare_list');
        }

        $listSchool = [];

        foreach ($compare_list as $com){
            $listSchool[] = School::find($com);
        }

        $data['listSchool'] = $listSchool;
        $pdf = PDF::loadView('pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true ]);
        return $pdf->download('bang-so-sanh-truong-'.time().'.pdf');
    }
    public function introduce(Request $request)
    {
        $datas        = LandingPagePositions::getDataByLandingPageId(3);
        if($datas) {
            foreach($datas as $data) {
                $position_id[] = $data['id'];
            }
        }
        $this->data['datas']     = $datas;
        $this->data['items'] = LandingPagePositionImages::with(['localeVi'])->whereIn('home_position_id',$position_id)
            ->orderBy('ordering')->get()->groupBy('home_position_id')->toArray();
        return view("front::home.introduce",$this->data);
    }
    public function studyAbroad ($slug = null)
    {
        if($slug != null) {
            $obj = StudyAbroad::where('status',1)
                ->where(function($query) use($slug) {
                    $query->where('slug',$slug)
                        ->orWhere('overview_slug',$slug)
                        ->orWhere('system_schools_slug',$slug);
                })
                ->first();
            if($obj){
                $this->data['obj'] = $obj->toArray();
                if($obj->overview_slug === $slug) {
                    return view('front::study-abroad.overview',$this->data);
                }else if($obj->system_schools_slug === $slug) {
                    return view('front::study-abroad.system_schools',$this->data);
                }

                return view('front::study-abroad.index',$this->data);
            }
        }
        return abort(404);
    }
    public function truongdaihoc(Request $request, $slug)
    {

        $obj = StudyAbroad::where('status',1)->where('slug',$slug)->first();
        $this->data['obj'] = $obj->toArray();
        $schools = School::with('levels','courses','majors','country')->where('country_id', $obj->country_id)->where('status', 1)->get();
        $this->data['schools'] = $schools;
        return view('front::study-abroad.truongdaihoc',$this->data);
    }
    public function chuongtrinhhocbong(Request $request, $slug)
    {
        $obj = StudyAbroad::where('status',1)->where('slug',$slug)->first();
        $this->data['obj'] = $obj->toArray();
        $category_id = $obj['category_id'];
        $this->data['news'] = News::where('category_id', $category_id)->get();
        return view('front::study-abroad.chuongtrinhhocbong',$this->data);
    }
    public function cacnganhhoc(Request $request, $slug)
    {
        $obj = StudyAbroad::where('status',1)->where('slug',$slug)->first();
        $this->data['obj'] = $obj->toArray();
        $category_id = $obj['major_id'];
        $this->data['news'] = News::where('category_id', $category_id)->get();
        return view('front::study-abroad.cacnganhhoc',$this->data);
    }
    public function cacthanhpho(Request $request, $slug)
    {
        $obj = StudyAbroad::where('status',1)->where('slug',$slug)->first();
        $this->data['obj'] = $obj->toArray();
        $category_id = $obj['city_id'];
        $this->data['news'] = News::where('category_id', $category_id)->get();
        return view('front::study-abroad.cacthanhpho',$this->data);
    }
    public function tintucducho(Request $request, $slug)
    {
        $obj = StudyAbroad::where('status',1)->where('slug',$slug)->first();
        $this->data['obj'] = $obj->toArray();
        $category_id = $obj['tintuc_id'];
        $this->data['news'] = News::where('category_id', $category_id)->get();
        return view('front::study-abroad.tintucduhoc',$this->data);
    }
    public function contactPage(Request $request)
    {
        $this->data['datas']        = LandingPagePositions::getDataByLandingPageId(4);
        return view("front::home.contact",$this->data);
    }
    public function getBlogByCategory(Request $request){
        $datas                       = LandingPagePositions::getDataByLandingPageId(9);
        $listNewByCategory = News::select('title','alias','image_location','description','created_at')->where('is_deleted', 0)->where('category_id',$request->id)->orderBy('id','DESC')->get();
        $categoryName = CategoryNew::where('id', $request->id)->first();
        return view('front::news.getNewByCategory',compact('listNewByCategory','datas','categoryName'));
    }
    public function getListTikTokContent(Request $request){
        $data = PostTiktok::all();
        return view('front::tiktok.index',compact('data'));
    }
}
