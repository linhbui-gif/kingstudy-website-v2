<?php

namespace Modules\AdminAuth\Entities;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table        = 'permissions';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
    protected $fillable     = ['name', 'route', 'created_at', 'updated_at'];

    const PROJECT           = 'kingstudy';

    public static function getPermissionsByUser($user_id)
    {
        $role_ids = UserHasRole::where('user_id', $user_id)
            ->join('roles', function($join)
            {
                $join->on('roles.id', '=', 'user_has_roles.role_id')
                    ->where('roles.is_deleted', '=', 0);
            })
            ->pluck('role_id')->toArray();

        if ($role_ids) {
            $objects = self::select('permissions.route', 'role_has_permissions.permission_id')
                ->rightJoin('role_has_permissions', function($join) use ($role_ids)
                {
                    $join->on('role_has_permissions.permission_id', '=', 'permissions.id')
                        ->whereIn('role_has_permissions.role_id', $role_ids);
                })
                ->where('permissions.parent_id', '>', 0)
                ->where('permissions.is_deleted', '=', 0)
                ->where('permissions.project', '=', Permissions::PROJECT)
                ->pluck('permission_id', 'route')->toArray();
        }

        return $objects;
    }

    public function getParentPermissionOptions()
    {
        $object = Permissions::select('*')
            ->where('is_deleted', 0)
            ->where('parent_id', 0)
            ->where('permissions.project', '=', Permissions::PROJECT)
            ->pluck('name_label', 'id')
            ->toArray();

        return $object;
    }

    public function getChildPermission()
    {
        $object = Permissions::select('*')
            ->where('is_deleted', 0)
            ->where('parent_id', '<>', 0)
            ->where('permissions.project', '=', Permissions::PROJECT)
            ->orderBy('ordering', 'asc')
            ->get()->toArray();
        return $object;
    }

    public function getParentPermission()
    {
        $object = Permissions::select('*')
            ->where('is_deleted', 0)
            ->where('parent_id', 0)
            ->where('permissions.project', '=', Permissions::PROJECT)
            ->orderBy('ordering', 'asc')
            ->orderBy('id', 'desc')
            ->get()->toArray();
        return $object;
    }

    public function getPermissions()
    {
        $objects = Permissions::select('*')
            ->where('is_deleted', 0)
            ->where('permissions.project', '=', Permissions::PROJECT)
            ->orderBy('ordering', 'asc')
            ->orderBy('id', 'desc')
            ->get()->toArray();

        $result = [];
        foreach ($objects as $item) {
            $result[$item['parent_id']][] = $item;
        }
        return $result;
    }

    public static function getAllPermissions()
    {
        $objects = Permissions::select('*')
            ->where('is_deleted', 0)
            ->where('permissions.project', '=', Permissions::PROJECT)
            ->orderBy('ordering', 'asc')
            ->orderBy('id', 'desc')
            ->get()->toArray();
        return $objects;
    }
}
