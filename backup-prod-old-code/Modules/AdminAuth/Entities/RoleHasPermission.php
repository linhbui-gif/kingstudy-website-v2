<?php

namespace Modules\AdminAuth\Entities;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    protected $table        = 'role_has_permissions';
//    protected $primaryKey = 'permission_id';
    protected $fillable     = ['permission_id', 'role_id', 'user_created', 'user_modified'];

    public function getHasPermission($id)
    {
        $has_permissions = Permissions::select('permissions.*',
            'parent.name_label as parent_name', 'parent.ordering as parent_ordering')
            ->leftJoin(\DB::Raw('permissions parent'), 'parent.id', '=', 'permissions.parent_id')
            ->whereExists(function ($query1) use ($id) {
                $query1->select(\DB::raw(1))
                    ->from('role_has_permissions')
                    ->whereRaw('role_has_permissions.permission_id = permissions.id')
                    ->where('role_has_permissions.role_id', '=', $id);
            })
            ->where('permissions.project', '=', Permissions::PROJECT)
            ->orderBy('parent.ordering', 'asc')
            ->orderBy('permissions.ordering', 'asc')
            ->get()->toArray();

        return $has_permissions;
    }

    public function getPermissionByRoleId($role_id)
    {
        $object = RoleHasPermission::select('permission_id')
            ->where('role_id', $role_id)
            ->get()->toArray();

        return $object;
    }
}
