<?php
namespace Modules\Front\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
   public function login () {
       $credentials = request(['email', 'password']);
       $token = null;
       try {
           if (!$token = JWTAuth::attempt($credentials)) {
               return response()->json(['message' => 'Sai Email hoặc mật khẩu', 'status' => 422], 422);
           }
           if (auth()->user()->user_type == 1) {
               return response()->json(['message' => 'Đây là tài khoản Admin! Bạn không có quyền truy cập', 'status' => Response::HTTP_UNAUTHORIZED], Response::HTTP_UNAUTHORIZED);
           };
           return $this->createNewToken($token);
       } catch (JWTAuthException $e) {
           return response()->json(['failed_to_create_token'], 500);
       }
   }
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'me' => auth()->user()
        ]);
    }
    public function signUp(Request $request) {
        $validator = Validator::make($request->all(),
            [
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            ],
            [
                'email.unique' => 'Email đã tồn tại !'
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors(),
                    'status' => 400
                ],
                400
            );
        }
       $data = $validator->validated();
       $data['user_type'] = 2;
       $data['username'] = $data['email'];
       $data['password'] = bcrypt($data['password']);
       unset($data['confirm_password']);
       $result =  DB::table('users')->insert($data);
       if($result) {
           return response()->json(
               [
                   'data' => [],
                   'message' => 'Đăng ký tài khoản thành công',
                   'status' => 200
               ],
               200
           );
       }
    }
}
