<?php

namespace Modules\AdminAuth\Http\Controllers;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\AdminAuth\Entities\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\AdminAuth\Entities\User;
use Modules\AdminAuth\Entities\UserHasRole;
use Validator;

class StudentController extends Controller
{
    protected $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title']           = 'Học viên';
        $this->data['controllerName']  = 'adminauth::student';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message = $request->session()->get('message', '');
        $this->data['message'] = json_decode($message, 1);
        return view("{$this->data['controllerName']}.index", $this->data);
    }

    public function search(Request $request)
    {
        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        if (!$request->has('page')) {
            $offset = $request->input('offset', 0);
            $page = round($offset / $limit) + 1;
            $request->request->add(['page' => $page]);
        }

        $objects = User::select('users.*')
            ->where('users.user_type', 2)
            ->where('users.is_deleted', 0);
        $keyword = $request->input('search', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('users.full_name', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('users.username', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('users.email', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('users.phone', 'LIKE', '%' . $keyword . '%');
            });
        }

        $sort = $request->input('sort', 'users.id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, [
            \DB::raw('users.*')
        ])->toArray();

        return response()->json(['rows' => $objects['data'], 'total' => $objects['total']]);
    }

    public function create(Request $request)
    {
        $this->data['title'] = 'Thêm mới Học viên';
        return view("{$this->data['controllerName']}.create ",$this->data);
    }

    public function store(Request $request)
    {
        $rules = [
            'full_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
            'birthday' => 'nullable',
            'image_location' => 'nullable',
            'gender' => 'nullable',
            'province_id' => 'required|exists:province,id'
        ];

        $messages = [
            'full_name.required' => 'Vui lòng nhập họ tên',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'province_id.required' => 'Tỉnh/Thành không hợp lệ',
            'province_id.exists' => 'Tỉnh/Thành không hợp lệ',
        ];

        $data = $this->validate($request, $rules, $messages);

        $temp_path = '';
        if (!empty($data['image_location'])) {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);
            $data['image_url'] = config('app.url');
        } else {
            unset($data['avatar']);
        }

        if (isset($data['birthday']) && $data['birthday']) {
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
        }

        $data['password'] = Hash::make($request->input('password'));
        $data['province_id'] = $request->input('province_id');
        $data['district_id'] = $request->input('district_id');
        $data['ward_id'] = $request->input('ward_id');
        $data['is_enabled'] = $request->input('is_enabled', 0);
        $data['address'] = $request->input('address', '');
        $data['user_type'] = 2;
        DB::beginTransaction();
        try {
            $users = DB::table('users')->insert(
                $data
            );
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới user không thành công.',
                'type' => 'error',
            ]));

            return redirect()->route($this->data['controllerName'] . '.index');
        }


        if ($users) {
            if (!empty($temp_path)) {
                General::moveImage($temp_path, $data['image_location']);
            }
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới user thành công.',
                'type' => 'success',
            ]));

            return redirect()->route($this->data['controllerName'] . '.index');
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Thêm mới user không thành công.',
            'type' => 'error',
        ]));

        return redirect()->route($this->data['controllerName'] . '.create');
    }

    public function edit(Request $request, $id)
    {
        $object = User::find($id);

        if (!$object) {
            abort(404, 'Không tìm thấy người dùng');
        }

        $object['birthday'] = $object['birthday'] && $object['birthday'] != '0000-00-00'
            ? date('d-m-Y', strtotime($object['birthday'])) : '';

        $this->data['object'] = $object;

        $this->data['id'] = $id;

        return view("{$this->data['controllerName']}.create", $this->data);
    }

    /**
     * Enter description here ...
     * @param JobLevelsRequest $request
     * @param unknown $id
     * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
     * @author HaLV
     */
    public function update(Request $request, $id)
    {
        $is_change_image    = $request->input('is_change_image', 0);
        $object             = User::find($id);

        if (!$object) {
            abort(404, 'Không tìm thấy người dùng');
        }

        $rules = [
            'full_name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'birthday' => 'nullable',
            'image_location' => 'nullable',
            'gender' => 'nullable',
            'is_change_image' => 'nullable',
            'province_id' => 'required|exists:province,id'
        ];

        $messages = [
            'full_name.required' => 'Vui lòng nhập họ tên',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'province_id.required' => 'Tỉnh/Thành không hợp lệ',
            'province_id.exists' => 'Tỉnh/Thành không hợp lệ',
        ];

        $data = $this->validate($request, $rules, $messages);

        $data['province_id'] = $request->input('province_id');
        $data['district_id'] = $request->input('district_id');
        $data['ward_id'] = $request->input('ward_id');
        $data['is_enabled'] = $request->input('is_enabled', 0);
        $data['address'] = $request->input('address', '');
        $data['user_type'] = 2;
        $temp_path = '';
        if ($is_change_image) {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);
            $data['image_url'] = config('app.url');
        }

        if (isset($data['birthday']) && $data['birthday']) {
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
        }

        DB::beginTransaction();
        try {
            $rs = $object->update($data);
            Cache::flush();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhập user không thành công.',
                'type' => 'error',
            ]));

            return redirect()->route($this->data['controllerName'] . '.index');
        }


        if ($rs) {
            if (!empty($temp_path)) {
                General::moveImage($temp_path, $data['image_location']);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật user thành công.',
                'type' => 'success',
            ]));

            return redirect()->route($this->data['controllerName'] . '.index');
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Cập nhật user không thành công.',
            'type' => 'error',
        ]));

        return response()->route($this->data['controllerName'] . '.edit', ['id' => $id]);
    }

    public function profile(Request $request)
    {
        $object = auth()->user();

        if (!$object) {
            abort(404, 'Không tìm thấy người dùng');
        }

        $object['birthday'] = $object['birthday'] && $object['birthday'] != '0000-00-00'
            ? date('d-m-Y', strtotime($object['birthday'])) : '';

        $this->data['object'] = $object;

        $this->data['id'] = $object['id'];
        $this->data['action'] = 'profile';

        return view("{$this->data['controllerName']}.profile", $this->data);
    }

    public function profile_update(Request $request)
    {
        $is_change_image = $request->input('is_change_image', 0);

        $object = auth()->user();

        if (!$object) {
            abort(404, 'Không tìm thấy người dùng');
        }

        $rules = [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $object['id'],
            'phone' => 'required|unique:users,phone,' . $object['id'],
            'birthday' => 'nullable',
            'image_location' => 'nullable',
            'gender' => 'nullable',
            'province_id' => 'required|exists:province,id'
        ];

        $messages = [
            'full_name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'province_id.required' => 'Tỉnh/Thành không hợp lệ',
            'province_id.exists' => 'Tỉnh/Thành không hợp lệ',
        ];

        $data = $this->validate($request, $rules, $messages);

        $temp_path = '';
        if ($is_change_image) {
            $temp_path = $data['image_location'];
            $data['image_location'] = General::generateImageLocation($temp_path);
            $data['image_url'] = config('app.url');
        }

        if (isset($data['birthday']) && $data['birthday']) {
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
        }

        $data['province_id'] = $request->input('province_id');
        $data['district_id'] = $request->input('district_id');
        $data['ward_id'] = $request->input('ward_id');

        $rs = $object->update($data);

        if ($rs) {
            if (!empty($temp_path)) {
                General::moveImage($temp_path, $data['image_location']);
            }
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật Profile thành công.',
                'type' => 'success',
            ]));

            return redirect()->route($this->data['controllerName'] . '.profile');
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Cập nhật Profile không thành công.',
            'type' => 'error',
        ]));

        return response()->route($this->data['controllerName'] . '.profile');
    }

    public function change_password(Request $request)
    {
        return view("{$this->data['controllerName']}.change-password", $this->data);
    }

    /**
     * Enter description here ...
     * @param JobLevelsRequest $request
     * @param unknown $id
     * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
     * @author HaLV
     */
    public function change_password_store(Request $request)
    {
        $this->validate($request, [
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new'
        ], [
            "password_new.required" => "Vui lòng nhập mật khẩu!",
            "password_confirm.required" => 'Mật khẩu xác nhận không đúng, vui lòng nhập lại!',
            "password_confirm.same" => 'Mật khẩu xác nhận không đúng, vui lòng nhập lại!'
        ]);

        $object = auth()->user();
        $data = $request->all();

        if (!Hash::check($data['password_old'], $object->password)) {
            return redirect(route($this->data['controllerName'].'.change-password'))
                ->withInput($request->input())
                ->withErrors([
                    'password_old' => 'Mật khẩu cũ chưa đúng',
                ]);
        }

        $object->password = Hash::make($request->input('password_new'));
        $object->save();

        if ($object) {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Đổi mật khẩu thành công.',
                'type' => 'success',
            ]));
        } else {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Đổi mật khẩu không thành công.',
                'type' => 'warring',
            ]));
        }

        return redirect()->route($this->data['controllerName'].'.change-password');
    }

    /**
     * tạo lại mật khẩu cho user
     * @param unknown $id
     * @return \Illuminate\View\View
     * @author HaLV
     */
    public function showResetPassword($id)
    {
        $this->data['id'] = $id;

        return view("{$this->data['controllerName']}.reset-password", $this->data);
    }

    public function postResetPassword(Request $request, $id)
    {
        $this->validate($request, [
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new'
        ], [
            "password_new.required" => "Vui lòng nhập mật khẩu!",
            "password_confirm.required" => 'Mật khẩu xác nhận không đúng, vui lòng nhập lại!',
            "password_confirm.same" => 'Mật khẩu xác nhận không đúng, vui lòng nhập lại!'
        ]);

        $object = User::find($id);

        if (!$object) {
            return response()->json([
                'rs' => 0,
                'messase' => 'Không tìm thấy người dùng: ' . $id
            ]);
        }

        $object->password = Hash::make($request->input('password_new'));
        $object->save();

        if ($object) {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Tạo lại mật khẩu thành công.',
                'type' => 'success',
            ]));

            return redirect()->route($this->data['controllerName'] . ".index");
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Tạo lại mật khẩu không thành công.',
            'type' => 'warring',
        ]));

        return redirect()->route("{$this->data['controllerName']}.show-reset-password", ['id' => $id]);
    }

    public function getCombogridData(Request $request)
    {
        $filter = [
            'offset' => $request->input('offset', 0),
            'limit' => $request->input('limit', env('LIMIT_LIST', 10)),
            'sort' => $request->input('sort', 'id'),
            'order' => $request->input('order', 'desc'),
            'search' => $request->input('q', ''),
        ];

        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        if (!$request->has('page')) {
            $offset = $request->input('offset', 0);
            $page = round($offset / $limit) + 1;
            $request->request->add(['page' => $page]);
        }

        $objects = User::where('users.id', '!=', 1)
            ->where('users.is_deleted', 0);

        $keyword = $request->input('q', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('users.name', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('users.email', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('users.phone', 'LIKE', '%' . $keyword . '%');
            });
        }

        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, ['users.*', 'users.full_name as name'])->toArray();

        return response()->json([
            'total' => $objects['total'],
            'rows' => isset($objects['data']) ? array_values($objects['data']) : [],
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id', 0);

        if ($id) {
            $rs = User::where('id', $id)->update([
                'is_deleted' => 1
            ]);
            if ($rs) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Xoá thành công',
                ]);
            }
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Xoá không thành công'
        ]);
    }
}
