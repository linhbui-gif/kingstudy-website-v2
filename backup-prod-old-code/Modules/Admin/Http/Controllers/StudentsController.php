<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\AdminAuth\Entities\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\Students;
use Rap2hpoutre\FastExcel\FastExcel;
use Modules\AdminAuth\Entities\UserHasRole;
use Validator;
use File;

class StudentsController extends Controller
{
    private $_data = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Roles $mRoles)
    {
        $this->middleware('auth');
        $this->_data['title']           = 'Học viên';
        $this->_data['controllerName']  = 'admin::students';
        $this->mRoles                   = $mRoles;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message = $request->session()->get('message', '');
        $this->_data['message'] = json_decode($message, 1);

        return view("{$this->_data['controllerName']}.index", $this->_data);
    }

    public function search(Request $request)
    {
        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        if (!$request->has('page')) {
            $offset = $request->input('offset', 0);
            $page = round($offset / $limit) + 1;
            $request->request->add(['page' => $page]);
        }
        $objects = Students::select('students.id','students.username',
                                    'students.full_name',
                                    'students.image_location',
                                    'students.image_url',
                                    'students.created_at',
                                    'students.email',
                                    'students.phone')
                                    ->where('students.id', '!=', 1)
                                    ->where('students.is_deleted', 0);
        $province_id = $keyword = $request->input('province_id', 0);
        if ($province_id > 0) {
            $objects->where(function ($query) use ($province_id) {
                $query->where('students.province_id', $province_id );
            });
        }
        $district_id = $keyword = $request->input('district_id', 0);
        if ($district_id > 0) {
            $objects->where(function ($query) use ($district_id) {
                $query->where('students.district_id', $district_id );
            });
        }
        $ward_id = $keyword = $request->input('ward_id', 0);
        if ($ward_id > 0) {
            $objects->where(function ($query) use ($ward_id) {
                $query->where('students.ward_id', $ward_id );
            });
        }
        $keyword = $request->input('search', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('students.full_name', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('students.username', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('students.email', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('students.phone', 'LIKE', '%' . $keyword . '%');
            });
        }
        $date_from = $request->date_from ?? '';
        if ($date_from) {
            $objects->where(function ($query) use ($date_from) {
               $date_from = date('Y-m-d 00:00:00', strtotime($date_from));
               $query->where('students.created_at', '>=', $date_from);
            });
        }

        $date_to = $request->date_to ?? '';
        if ($date_to) {
            $objects->where(function ($query) use ($date_to) {
               $date_to = date('Y-m-d 00:00:00', strtotime($date_to));
               $query->where('students.created_at', '<=', $date_to);
            });
        }
        $sort = $request->input('sort', 'students.id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, [
            \DB::raw('students.*')
        ])->toArray();
        return response()->json(['rows' => $objects['data'], 'total' => $objects['total']]);
    }

    public function create(Request $request)
    {
        $this->_data['roles'] = $this->mRoles->getOptions();

        return view("{$this->_data['controllerName']}.create ", $this->_data);
    }

    public function store(Request $request)
    {
        $rules = [
            'full_name' => 'required',
            'username' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'phone' => 'required|unique:students',
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
        $data['created_at']  = date('Y-m-d H:i:s');
        $data['type_student'] = 'creatd admin';
        DB::beginTransaction();
        try {
            $id = DB::table('students')->insertGetId(
                $data
            );
            if ($id && isset($request['role'])) {
                $requestRole = $request['role'];
                if ($requestRole[0] == null) {
                    unset($requestRole[0]);
                }
                foreach ($requestRole as $value) {
                    $userHasRole = DB::table('user_has_roles')->insert(
                        [
                            'role_id' => $value,
                            'user_id' => $id
                        ]
                    );
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới học viên không thành công.',
                'type' => 'error',
            ]));

            return redirect()->route($this->_data['controllerName'] . '.index');
        }


        if ($id) {
            if (!empty($temp_path)) {
                General::moveImage($temp_path, $data['image_location']);
            }
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Thêm mới học viên thành công.',
                'type' => 'success',
            ]));

            return redirect()->route($this->_data['controllerName'] . '.index');
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Thêm mới học viên không thành công.',
            'type' => 'error',
        ]));

        return redirect()->route($this->_data['controllerName'] . '.create');
    }

    public function edit(Request $request, $id)
    {
        $this->_data['roles'] = $this->mRoles->getOptions();
        $object = Students::find($id);
        // $role = $object->role->pluck('role_id');
        if (!$object) {
            abort(404, 'Không tìm thấy học viên');
        }

        $object['birthday'] = $object['birthday'] && $object['birthday'] != '0000-00-00'
            ? date('d-m-Y', strtotime($object['birthday'])) : '';

        $this->_data['object'] = $object;
        // $this->_data['role'] = $role;

        $this->_data['id'] = $id;

        return view("{$this->_data['controllerName']}.create", $this->_data);
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
        $object             = Students::findOrFail($id);

        if (!$object) {
            abort(404, 'Không tìm thấy người dùng');
        }

        $rules = [
            'full_name' => 'required',
            'username' => 'required|unique:students,username,' . $id,
            'phone' => 'required|unique:students,phone,' . $id,
            'email' => 'required|unique:students,email,' . $id,
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
            unset($data['role']);
            $rs = $object->update($data);
            Cache::flush();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhập học viên không thành công.',
                'type' => 'error',
            ]));

            return redirect()->route($this->_data['controllerName'] . '.index');
        }
        if ($rs) {
            if (!empty($temp_path)) {
                General::moveImage($temp_path, $data['image_location']);
            }

            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Cập nhật học viên thành công.',
                'type' => 'success',
            ]));

            return redirect()->route($this->_data['controllerName'] . '.index');
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Cập nhật học viên không thành công.',
            'type' => 'error',
        ]));

        return response()->route($this->_data['controllerName'] . '.edit', ['id' => $id]);
    }

    public function profile(Request $request)
    {
        $object = auth()->user();
        if (!$object) {
            abort(404, 'Không tìm thấy học viên');
        }

        $object['birthday'] = $object['birthday'] && $object['birthday'] != '0000-00-00'
            ? date('d-m-Y', strtotime($object['birthday'])) : '';

        $this->_data['object'] = $object;

        $this->_data['id'] = $object['id'];
        $this->_data['action'] = 'profile';

        return view("{$this->_data['controllerName']}.profile", $this->_data);
    }

    public function profile_update(Request $request)
    {
        $is_change_image = $request->input('is_change_image', 0);

        $object = auth()->user();

        if (!$object) {
            abort(404, 'Không tìm thấy học viên');
        }

        $rules = [
            'full_name' => 'required',
            'email' => 'required|email|unique:students,email,' . $object['id'],
            'phone' => 'required|unique:students,phone,' . $object['id'],
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

            return redirect()->route($this->_data['controllerName'] . '.profile');
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Cập nhật Profile không thành công.',
            'type' => 'error',
        ]));

        return response()->route($this->_data['controllerName'] . '.profile');
    }

    public function change_password(Request $request)
    {
        return view("{$this->_data['controllerName']}.change-password", $this->_data);
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
            return redirect(route($this->_data['controllerName'].'.change-password'))
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

        return redirect()->route($this->_data['controllerName'].'.change-password');
    }

    /**
     * tạo lại mật khẩu cho user
     * @param unknown $id
     * @return \Illuminate\View\View
     * @author HaLV
     */

    public function showResetPassword($id)
    {
        $this->_data['id'] = $id;
        $student = Students::find($id);
        if(!$student) {
            abort(404, 'Không tìm thấy học viên');
        }
        return view("{$this->_data['controllerName']}.reset-password", $this->_data);
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

        $object = Students::find($id);

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

            return redirect()->route($this->_data['controllerName'] . ".index");
        }

        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Tạo lại mật khẩu không thành công.',
            'type' => 'warring',
        ]));

        return redirect()->route("{$this->_data['controllerName']}.show-reset-password", ['id' => $id]);
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

        $objects = Students::where('students.id', '!=', 1)
            ->where('students.is_deleted', 0);

        $keyword = $request->input('q', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('students.name', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('students.email', 'LIKE', '%' . $keyword . '%');
                $query->orWhere('students.phone', 'LIKE', '%' . $keyword . '%');
            });
        }

        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, ['students.*', 'students.full_name as name'])->toArray();

        return response()->json([
            'total' => $objects['total'],
            'rows' => isset($objects['data']) ? array_values($objects['data']) : [],
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id', 0);
        if ($id) {
            $rs = Students::where('id', $id)->update([
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

    public function import_excel(Request $request) {
        $data = $request->all();
        $valid = Validator::make($data,
          [
             'students_excel' => ['required','file','mimes:xlsx,xls'],
          ],
          [
              'students_excel.required'        => 'Chọn tập tin upload',
              'students_excel.mimes'            => 'Định dạng không hợp lệ',
          ]
        );
         if ($valid->fails())
        {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => $valid->errors()->messages()['students_excel'][0],
                'type' => 'error',
            ]));
            return redirect()->back();
        }
        $path = $request->file('students_excel')->getRealPath();
        $arr_data = (new FastExcel)->import($path)->toArray();
        $length_arr = count($arr_data);
        DB::beginTransaction();
        try {
        if($length_arr > 0 ) {
            DB::connection()->disableQueryLog();
            $new_data = [];
            foreach($arr_data as $k => $data) {
                $data['type_student'] = 'import';
                $data['is_enabled']   = 0 ;
                $data['password']     = '';
                $data['created_at']   = date('Y-m-d H:i:s');
                $new_data[$k]         = $data;
            }
            $chunks = array_chunk($new_data,500);
            foreach($chunks as $chunk) {
                $rs = Students::insert($chunk);
            }
            DB::commit();
        }} catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Import thất bại',
                'type' => 'error',
            ]));
            return redirect()->back();
        }
        if(isset($rs))
        {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Import thành công.',
                'type' => 'success',
            ]));
        }else {
            $request->session()->flash('message', json_encode([
                'title' => 'Thông báo',
                'text' => 'Import không thành công.',
                'type' => 'error',
            ]));
        }
        return redirect()->back();
    }

    public function export_excel(Request $request)
    {
        $path = (new FastExcel($this->get_students_export()))->export('download/students.xlsx');
        if(file_exists($path)) {
            return response()->download($path);
        }
        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Tải xuống thất bại.',
            'type' => 'error',
        ]));
        return redirect()->back();
    }
    public function get_students_export() {
        $lists = Students::select('username','full_name','phone','email','birthday','province_id','district_id','ward_id')
                         ->where('is_enabled',1)
                         ->where('is_deleted',0)->get()->toArray();
        if(count($lists)) {
            foreach($lists as $list ){
                yield $list;
            }
        }
    }
    public function download_excel(Request $request)
    {
        $path = public_path(). "/download/students-excel.xlsx";
        if(file_exists($path)) {
            return response()->download($path);
        }
        $request->session()->flash('message', json_encode([
            'title' => 'Thông báo',
            'text' => 'Tải xuống thất bại.',
            'type' => 'error',
        ]));
        return redirect()->back();
    }

}
