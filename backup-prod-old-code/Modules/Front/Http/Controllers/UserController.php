<?php

namespace Modules\Front\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Admin\Entities\LandingPagePositions;
use Modules\Admin\Entities\ProfileSubmited;
use Modules\Admin\Entities\School;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\Wishlist;

class UserController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $repo;
    protected $view;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->data['controllerName'] = 'front::user';
    }

    public function formProfile(){
        return view("front::myAccount.profile");
    }

    public function formNopHoSo(){
        $datas                       = LandingPagePositions::getDataByLandingPageId(7);
        $object = $datas[30];
        return view("front::myAccount.formHoSo")->with('object', $object);
    }

    public function postProfile(Request $request){

        $data = $request->all();
        $valid = Validator::make($request->all(), [
            'profile_full_name' => 'required',
            'profile_email' => 'email',
        ], [
            'profile_full_name.required' => 'Họ tên không được rỗng',
            'profile_email.email' => 'Email đã tồn tại'
        ]);

        if ($valid->fails())
        {
            return response()->json([
                'rs' => 0,
                'msg' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $valid->errors()->messages(),
                'data' => $data
            ]);
        }

        $user = auth()->user();
        $user->full_name = $request->profile_full_name;
        $user->birthday = $request->profile_birthday;
//        $user->email = $request->profile_email;
        $user->gender = $request->profile_gender;
        $user->phone = $request->profile_phone;
        $user->address = $request->profile_address;

        if($request->image_location){
            $temp_path = $data['image_location'];
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

        return response()->json([
            'rs' => 1,
            'msg' => 'Cập nhật thành công',
        ]);
    }

    public function postNopHoSo(Request $request)
    {
        $user = auth()->user();

        $profile = new ProfileSubmited();
        $profile->user_id = $user->id;

        $profile->name =  $request->full_name;
        $profile->phone =  $request->phone;
        $profile->email =  $request->email_user;

        $profile->country_id = $request->country_id;
        $profile->level = $request->level_id;
        $profile->english_skill = $request->english_skill;
        $profile->course_id = $request->course_id;
        $attachment_1 = [];
        if($request->preview_file_1_file_url && count($request->preview_file_1_file_url) > 0){
            foreach($request->preview_file_1_file_url as $k => $url){
                $att = [];
                $nameOrigin = $request->preview_file_1_file_name[$k];
                $url_new = General::generateImageLocation($url);
                $att['name'] = $nameOrigin;
                $att['url'] = $url_new;
                $attachment_1[] = $att;

                General::moveImage($url, $url_new);
            }
        }
        $profile->attachment_1 = json_encode($attachment_1);

        $attachment_2 = [];
        if($request->preview_file_2_file_url && count($request->preview_file_2_file_url) > 0){
            foreach($request->preview_file_2_file_url as $k => $url){
                $att = [];
                $nameOrigin = $request->preview_file_2_file_name[$k];
                $url_new = General::generateImageLocation($url);
                $att['name'] = $nameOrigin;
                $att['url'] = $url_new;
                $attachment_2[] = $att;

                General::moveImage($url, $url_new);
            }
        }
        $profile->attachment_2 = json_encode($attachment_2);

        $attachment_3 = [];
        if($request->preview_file_3_file_url && count($request->preview_file_3_file_url) > 0){
            foreach($request->preview_file_3_file_url as $k => $url){
                $att = [];
                $nameOrigin = $request->preview_file_3_file_name[$k];
                $url_new = General::generateImageLocation($url);
                $att['name'] = $nameOrigin;
                $att['url'] = $url_new;
                $attachment_3[] = $att;

                General::moveImage($url, $url_new);
            }
        }
        $profile->attachment_3 = json_encode($attachment_3);
//        $temp_path_banner = $data['image_location'];
//        $data['banner'] = General::generateImageLocation($temp_path_banner);

        if($request->school_id){
            $profile->school_id = $request->school_id;
        }

        $profile->save();

        return [
            'rs' => 1,
            'msg' => 'Update success'
        ];
    }

    public function nopHoSoNgay(Request $request){
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
        $profileNew->save();

        return [
            'rs' => 1,
            'msg' => 'Update success'
        ];

    }

    public function theodoiHoSo(){
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
        return view("front::myAccount.theodoiHoSo")->with('data', $data);
    }

    public function hosoDetail(Request $request, $id){
        $user = auth()->user();
        $profile = ProfileSubmited::where('user_id', $user->id)->where('id', $id)->orderBy('id','desc')->first();
        return view("front::myAccount.detailHoSo")->with('profile', $profile);
    }

    public function manageProfile(Request $request){
        $user = auth()->user();
        $profile = ProfileSubmited::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

        return view("front::myAccount.manageProfile")->with('profile', $profile);
    }

    public function addWishlist(Request $request){
        $user = auth()->user();
        $wish =  Wishlist::where('user_id', $user->id)->where('school_id', $request->id)->first();
        if(!$wish){
            Wishlist::create(['user_id' => $user->id, 'school_id' =>$request->id]);
            return [
                'rs' => 1,
                'msg' => 'Thêm thành công'
            ];
        }
        return [
            'rs' => 0,
            'msg' => 'Đã có trong danh sách'
        ];
    }
    public function removeWishlist(Request $request){
        $user = auth()->user();
        $wish =  Wishlist::where('user_id', $user->id)->where('school_id', $request->id)->delete();
        return redirect()->back();
    }

    public function listWishlist(Request $request){
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
        return view("front::myAccount.wishList")->with('items', $items);
    }
    public function changePassWord (Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $valid = Validator::make($data,[
                'password_new' => 'required',
                'password_confirm' => 'required|same:password_new'
            ], [
                "password_new.required" => "Vui lòng nhập mật khẩu!",
                "password_confirm.required" => 'Mật khẩu xác nhận không đúng, vui lòng nhập lại!',
                "password_confirm.same" => 'Mật khẩu xác nhận không đúng, vui lòng nhập lại!'
            ]);
            if ($valid->fails())
            {
                return response()->json([
                    'rs' => 0,
                    'msg' => 'Dữ liệu nhập không hợp lệ',
                    'errors' => $valid->errors()->messages(),
                    'data' => $data,
                    'type' => 'error',
                ]);
            }
            $object = auth()->user();
            $data = $request->all();

            if (!Hash::check($data['password_old'], $object->password)) {
                return redirect(route('changePassWord'))
                    ->withInput($request->input())
                    ->withErrors([
                        'password_old' => 'Mật khẩu cũ chưa đúng',
                    ]);
            }

            $object->password = Hash::make($request->input('password_new'));
            $object->save();

            if ($object) {
                return response()->json([
                    'rs' => 1,
                    'message' => 'Đổi mật khẩu thành công',
                    'type' =>'success',
                    'redirect_url' => route('changePassWord'),
                ]);
            } else {
                return response()->json([
                    'rs' => 0,
                    'message' => 'Đổi mật khẩu không thành công',
                    'type' =>'error',
                    'redirect_url' => route('changePassWord'),
                ]);
            }

            return redirect()->back();
        }
        return view('front::myAccount.change-password');
    }

}
