<?php
namespace Modules\Front\Http\Controllers\Api;

use App\Helpers\General;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Entities\Country;
use Modules\Admin\Entities\Course;
use Modules\Admin\Entities\LevelCourse;
use Modules\Admin\Entities\ProfileAbroad;
use Modules\Admin\Entities\ProfileSubmited;
use Modules\Admin\Entities\School;
use Modules\Admin\Entities\Wishlist;
use Modules\Front\Traits\UploadFile;

class UserController extends BaseController {
    use UploadFile;
    public function getProfile() {
        $user = auth()->user();
        $data['profile'] = ProfileSubmited::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        $data['profile']->attachment_1 = json_decode($data['profile']->attachment_1);
        $data['profile']->attachment_2 = json_decode($data['profile']->attachment_2);
        $data['profile']->attachment_3 = json_decode($data['profile']->attachment_3);
        $data['profile']['country'] = Country::find($data['profile']->country_id);
        $data['profile']['user'] = $user;
        $data['profile']['level'] = LevelCourse::find($data['profile']->level);
        return $this->successResponseJson($data);
    }
    public function updateProfile(Request $request) {
        $data = $request->all();
        $valid = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'email',
        ], [
            'full_name.required' => 'Họ tên không được rỗng',
            'email.email' => 'Email đã tồn tại'
        ]);

        if ($valid->fails()) {
            return $this->errorResponseJson('Dữ liệu nhập không hợp lệ');
        }
        $user = auth()->user();
        $user->full_name = $request->full_name;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->image){
            $temp_path = $data['image'];
            $image_url = General::generateImageLocation($temp_path);
            if (!empty($image_url))
            {
                General::moveImage($temp_path, $image_url);
            }
            $user->image_url = $image_url;
        }

        if($user->user_type != 1){
            $user->user_type = 2;
        }
        $user->save();
        return $this->successResponseJson($user);
    }
    public function saveProfileFile(Request $request) {
        $user = auth()->user();
        $profile = new ProfileSubmited();
        $profile->user_id = $user->id;

        $profile->name =  $request->full_name;
        $profile->phone =  $request->phone;
        $profile->email =  $request->email;
        $profile->country_id = $request->country_id;
        $profile->level = $request->level_id;
        $profile->english_skill = $request->english_skill;
        $profile->course_id = $request->course_id;

        $arrAttachMent_1 = $this->uploadAttachMent($request,'academic_files');
        $arrAttachMent_2 = $this->uploadAttachMent($request,'profile_files');
        $arrAttachMent_3 = $this->uploadAttachMent($request,'finance_files');
        $profile->attachment_1 = json_encode($arrAttachMent_1);
        $profile->attachment_2 = json_encode($arrAttachMent_2);
        $profile->attachment_3 = json_encode($arrAttachMent_3);

        if ($request->school_id){
            $profile->school_id = $request->school_id;
        }

        $profile->save();
        return $this->successResponseJson($profile);
    }
    protected function uploadAttachMent($request, $attachmentName = '') {
        $format = ['pdf','docx'];
        $attach_ment = [];
        if($request->$attachmentName){
            $arrFiles = $this->uploadFileTmp($request, $format, $attachmentName);
            if(!empty($arrFiles)) {
                foreach ($arrFiles['files'] as $k => $arrFile) {
                    $url = $arrFile['name'];
                    $att = [];
                    $nameOrigin = $arrFile['file_name_extension'];
                    $url_new = General::generateImageLocation($url);
                    $att['name'] = $nameOrigin;
                    $att['url'] = $url_new;
                    $attach_ment[] = $att;
                    General::moveImage($url, $url_new);
                }
            }
        }
        return $attach_ment;
    }
    public function processCourseBySchool(Request $request) {
        $school_id = $request->school_id;
        $user = auth()->user();

        $profile = ProfileSubmited::where('user_id', $user->id)->orderBy('created_at','desc')->first();
        $profileNew = new ProfileSubmited();
        $profileNew->user_id = $user->id;

        $profileNew->name = $profile->name;
        $profileNew->phone = $profile->phone;
        $profileNew->email = $profile->email;

        $profileNew->school_id = $school_id;
        $profileNew->country_id = $profile->country_id;
        $profileNew->level = $profile->level;
        $profileNew->english_skill = $profile->english_skill;
        $profileNew->attachment_1 = $profile->attachment_1;
        $profileNew->attachment_2 = $profile->attachment_2;
        $profileNew->attachment_3 = $profile->attachment_3;
        $profileNew->course_id = $request->course_id;
        $profileNew->status = 0;
        $data = $profileNew->save();
        return $this->successResponseJson($data);
    }
    public function followProfile(Request $request) {
        $user = auth()->user();
        $profiles = ProfileSubmited::where('user_id', $user->id)->where('school_id',"!=", "")->orderBy('id','DESC')->get();
        $data = [];
        foreach ($profiles as $k => $profile){
            $data[$profile->school_id][] = $profile;
        }
        $schools = School::where('status', 0)->get();
        foreach($schools as $j => $school){
            if(!in_array($school->id, $data)){
                unset($data[$school->id]);
            }
        }
        if(!empty($data)) {
            foreach ($data as $id => $item){
                foreach ($item  as $value) {
                    $value->attachment_1 = json_decode($value->attachment_1);
                    $value->attachment_2 = json_decode($value->attachment_2);
                    $value->attachment_3 = json_decode($value->attachment_3);
                    $value->school = School::find($id);
                    $value->country = Country::find($value->country_id);
                    $value->course = Course::find($value->course_id);
                }
            }
        }
        return $this->successResponseJson($data);
    }
    public function detailProfile($id) {
        $user = auth()->user();
        $profile = ProfileSubmited::where('user_id', $user->id)->where('id', $id)->orderBy('id','desc')->first();
        return $this->successResponseJson($profile);
    }
    public function listWishlistSchool() {
        $user = auth()->user();
        $listWish = Wishlist::where('user_id', $user->id)->orderBy('id','desc')->get();
        $items = [];
        foreach ($listWish as $wish){
            $school_id = $wish->school_id;
            $items[] = School::where('status', 1)->find($school_id);
        }
        foreach($items as $k => $item){
            if(!isset($item)){
                unset($items[$k]);
            }
        }
        $count = count($items);
        return $this->successResponseJson([
            $items,
            'count' => $count
        ]);
    }
    public function addWishlistSchool(Request $request){
        $user = auth()->user();
        $wish =  Wishlist::where('user_id', $user->id)->where('school_id', $request->school_id)->first();
        if(!$wish){
            Wishlist::create(['user_id' => $user->id, 'school_id' =>$request->school_id]);
            return $this->successResponseJson([],'Thêm vào danh sách yêu thích thành công', 200);
        }
        return $this->successResponseJson([],'Đã có trong danh sách', 200);
    }
    public function removeWishlistSchool(Request $request){
        $user = auth()->user();
        $wish =  Wishlist::where('user_id', $user->id)->where('school_id', $request->school_id)->delete();
        return $this->successResponseJson([],'Xóa trường thành công', 200);
    }
    public function updateInformationStudyAboard(Request $request) {
        DB::beginTransaction();
        try {
            $data = $request->all();
            if (isset($data['job_salary'])) {
                $data['job_salary'] = (int)str_replace(',', '', $data['job_salary']);
            }

            $fields = [
                'birth_day',
                'identity_card_date',
                'identity_card_expiration_date',
                'passport_date',
                'father_birth_day'
            ];

            foreach ($fields as $field) {
                if (isset($data[$field])) {
                    $data[$field] = date('Y-m-d', strtotime($data[$field]));
                }
            }

            $data['user_id']                             = Auth::user()->id;
            $rs                                          = ProfileAbroad::updateOrCreate(['user_id' => Auth::user()->id],$data);
            if($rs)
            {
                $user = User::findOrFail(Auth::user()->id);
                $user->update(['status_profile_aborad' => 1]);
                DB::commit();
                return $this->successResponseJson([],'Cập nhật thành công');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            $this->errorResponseJson('Cập nhật thất bại');
        }
    }
}
