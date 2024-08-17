<?php

namespace Modules\AdminAuth\Entities;

use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    protected $table = 'user_has_roles';

    protected $fillable = ['role_id', 'user_id'];

    public $timestamps = false;

    public function remove_user_role($role_id, $user_id)
    {
        UserHasRole::where('role_id', $role_id)
            ->where('user_id', $user_id)
            ->delete();
        return true;
    }

    public function user_has_role($role_id)
    {
        $object = UserHasRole::select('users.*')
            ->leftJoin('users', 'users.id', '=', 'user_has_roles.user_id')
            ->where('role_id', $role_id)
            ->get()->toArray();
        return $object;
    }
}
