<?php
namespace Modules\AdminAuth\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request->input('email');
        $user = User::where(function($query) use ($email) {
            $query->where('email', $email)->orWhere('username', $email);
        })->where('is_deleted', 0)->first();

        if (!$user) {
            return redirect(route('login'))
                ->withInput($request->input())
                ->withErrors([
                    'email' => 'Tên đăng nhập chưa đúng',
                ]);
        }

        if(!$user->is_enabled){
            return redirect(route('login'))
                ->withInput($request->input())
                ->withErrors([
                    'email' => 'Tài khoản chưa kích hoạt',
                ]);
        }

        if (!Hash::check($request->input('password'), $user->password))
        {
            return redirect(route('login'))
                ->withInput($request->input())
                ->withErrors([
                    'email' => 'Mật khẩu chưa đúng',
                ]);
        }

        Auth::loginUsingId($user->id, true);

        $user->last_login = Carbon::now()->toDateTimeString();
        $user->save();
        return redirect()->intended($this->redirectPath());
    }

}
