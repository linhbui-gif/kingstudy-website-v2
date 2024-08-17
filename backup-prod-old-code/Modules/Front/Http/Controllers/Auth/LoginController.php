<?php
namespace Modules\Front\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\PhoneOrEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Entities\CRM\Lead;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('adminauth::auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($request->all(), [
            'email' => ['required', new PhoneOrEmail],
            'password' => 'required'
        ], [
            'email.required' => 'Email/SĐT không được rỗng',
            'email.email' => 'Phải là định dạng email/SĐT',
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

        $input = $request->input('email');
        $user = User::where(function($query) use ($input) {
            $query->where('email', $input);
            $query->orWhere('phone', $input);
        })->where('user_type', 2)->where('is_deleted', 0)->first();

        if (!$user) {
            return response()->json([
                'rs' => 1,
                'msg' => 'Email hoặc mật khẩu không đúng',
            ]);
        }

            if (!Hash::check($request->input('password'), $user->password))
        {
            return response()->json([
                'rs' => 1,
                'msg' => 'Email hoặc mật khẩu không đúng',
            ]);
        }

        Auth::loginUsingId($user->id, true);

        $user->last_login = Carbon::now()->toDateTimeString();
        $user->save();

        return response()->json([
            'rs' => 2,
            'msg' => 'Đăng nhập thành công',
            'redirect_url' => route('trang-chu')
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $valid = Validator::make($request->all(), [
            'register_email' => 'required|unique:users,email',
            'register_phone' => 'required|unique:users,phone|regex:/^\+?[0-9]{10,15}$/',
            'register_password' => 'required|same:password_confirmation',
        ], [
            'register_email.required' => 'Email không được rỗng',
            'register_email.email' => 'Phải là định dạng email',
            'register_email.unique' => 'Email đã tồn tại',
            'register_phone.required' => 'SĐT không được rỗng',
            'register_phone.unique' => 'SĐT đã tồn tại',
            'register_phone.regex' => 'Phải là định dạng SĐT',
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
        $lead = Lead::create([
            'email' => $request->register_email,
            'tel' => $request->register_phone,
        ]);
        $user = new User();
        $user->email = $request->register_email;
        $user->phone = $request->register_phone;
        $user->username = $user->email;
        $user->password = Hash::make($request->register_password);
        $user->user_type = 2;
        $user->crm_lead_id = $lead->id;
        $user->save();

        Auth::loginUsingId($user->id, true);
        return response()->json([
            'rs' => 1,
            'msg' => 'Đăng ký thành công',
            'redirect_url' => route('trang-chu')
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
