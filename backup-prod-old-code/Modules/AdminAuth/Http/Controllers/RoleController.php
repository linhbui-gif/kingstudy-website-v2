<?php

namespace Modules\AdminAuth\Http\Controllers;

use App\Helpers\Auth;
use Modules\AdminAuth\Entities\Permissions;
use Modules\AdminAuth\Entities\UserHasRole;
use Illuminate\Http\Request;
use Modules\AdminAuth\Entities\Roles;
use Modules\AdminAuth\Entities\RoleHasPermission;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    private $_data = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->_data['title'] = 'Vai trò';
        $this->_data['controllerName'] = 'adminauth::role';
    }

    public function remove_user($role_id, $user_id) {
        $mUserRole = new UserHasRole();
        $mUserRole->remove_user_role($role_id, $user_id);

        Cache::flush();

        return response()->json([
            'rs' => 1,
            'msg' => 'Xoá nhân sự thành công khỏi vai trò',
        ]);
    }

    public function detail($id) {
        $mRole = new Roles();
        $object = $mRole->getRoleById($id);
        $this->_data['object'] = $object;

        $mHasPermissions = new RoleHasPermission();
        $has_permissions = $mHasPermissions->getHasPermission($id);
        $this->_data['has_permissions'] = $has_permissions;

        $mUserHasRole = new UserHasRole();
        $users = $mUserHasRole->user_has_role($id);
        $this->_data['users'] = $users;

        return view("{$this->_data['controllerName']}.detail", $this->_data);
    }

    public function getShowAll(Request $request) {
        $message = $request->session()->get('message', '');
        $this->_data['message'] = json_decode($message, 1);

        return view("{$this->_data['controllerName']}.show-all", $this->_data);
    }

    /**
     * List staffs request
     * @return JSON
     * @author HaLV
     */
    public function getAjaxData(Request $request)
    {
        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        if (!$request->has('page')) {
            $offset = $request->input('offset', 0);
            $page = round($offset / $limit) + 1;
            $request->request->add(['page' => $page]);
        }

        $mRole = new Roles();
        $objects = $mRole->getAllRole();

        $keyword = $request->input('search', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, [
            \DB::raw('roles.*')
        ])->toArray();
        $objects['rows'] = isset($objects['data']) ? array_values($objects['data']) : [];
        unset($objects['data']);

        return response()->json($objects);
    }

    public function getAdd() {
        $mPermission = new Permissions();
        $this->_data['permissions'] = $mPermission->getPermissions();

        return view("{$this->_data['controllerName']}.edit", $this->_data);
    }

    public function add_users(Request $request)
    {
        $rules = [
            'role_id' => 'required|integer',
            'user_ids' => 'required|array',
        ];

        $data = $this->validate($request, $rules);

        foreach ($data['user_ids'] as $user_id) {
            $user_id = intval($user_id);

            if (!$user_id) continue;

            UserHasRole::firstOrCreate(['role_id' => $data['role_id'], 'user_id' => $user_id]);
        }

        Cache::flush();

        return response()->json([
            'rs' => 1,
            'msg' => 'Thêm nhân sự thành công',
        ]);
    }

    public function postAdd(Request $request) {
        $data = $request->all();

        unset($data['_token']);

        /**
         * create is_default when sign up in agent app get role default
         */
        $role = Roles::create(['name' => $data['name'], 'is_default' => $data['is_default'] ?? 0]);
        if ($role)
        {
            if(!empty($data['permissions']))
            {
                foreach ($data['permissions'] as $permission_id)
                {
                    RoleHasPermission::insert(['permission_id' => $permission_id, 'role_id' => $role->id]);
                }
                $request->session()->flash('message', json_encode([
                    'title' => 'Thông báo',
                    'text' => 'Thêm vai trò thành công.',
                    'type' => 'success',
                ]));
                Cache::flush();
            }

//            return redirect()->route('roles.index');
            return redirect()->route("{$this->_data['controllerName']}.getShowAll");
        }
        return redirect("/{$this->_data['controllerName']}/add");
    }

    public function getEdit($id) {
        $mRole = new Roles();
        $object = $mRole->getRoleById($id);

        if (!$object) {
            abort(404, 'Không tìm thấy vai trò: '.$id);
        }

        $mRoleHasPermission = new RoleHasPermission();
        $permissions = $mRoleHasPermission->getPermissionByRoleId($id);

        $object = $object->toArray();

        $object['permissions'] = [];

        if(!empty($permissions))
        {
            foreach ($permissions as $item)
            {
                $object['permissions'][$item['permission_id']] = $item['permission_id'];
            }
        }

        $this->_data['object'] = $object;

        $mPermission = new Permissions();
        $this->_data['permissions'] = $mPermission->getPermissions();
        return view("{$this->_data['controllerName']}.edit", $this->_data);
    }

    public function postEdit(Request $request, $id) {

        $data = $request->all();
        unset($data['_token']);

        /**
         * create is_default when sign up in agent app get role default
         */
        $rs = Roles::where('id', $id)->update(['name' => $data['name']]);

        if ($rs)
        {
            if(!empty($data['permissions']))
            {
                RoleHasPermission::where('role_id', $id)->delete();
                foreach ($data['permissions'] as $permission_id)
                {
                    RoleHasPermission::insert(['permission_id' => $permission_id, 'role_id' => $id]);
                }

                $request->session()->flash('message', json_encode([
                    'title' => 'Thông báo',
                    'text' => 'Cập nhật vai trò thành công.',
                    'type' => 'success',
                ]));

                Auth::forget_permissions();
                Cache::flush();
            }
            return redirect()->route("{$this->_data['controllerName']}.getShowAll");
        }

        return redirect("/{$this->_data['controllerName']}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($id) {
            $object = Roles::find($id);

            if ($object) {
                $object->is_deleted = 1;
                $object->save();

                return response()->json([
                    'rs' => 1,
                    'msg' => 'Xóa vai trò thành công',
                ]);
            }
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Xóa vai trò không thành công'
        ]);
    }
}
