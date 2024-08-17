<?php

namespace Modules\AdminAuth\Entities;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table        = 'roles';
    protected $primaryKey   = 'id';
//    protected $guarded    = ['id'];
    protected $fillable     = ['name', 'project'];

    const PROJECT           = 'kingstudy';

    public static function getAllData()
    {
        $query = self::select('*')->where(['is_deleted' => 0, 'project' => self::PROJECT]);
        return $query->get()->toArray();
    }

    public function getRoleById($id)
    {
        $object = Roles::where('id', $id)
            ->where('project', Roles::PROJECT)
            ->select('*')
            ->first();

        return $object;
    }

    public function getAllRole()
    {
        $object = Roles::where(['is_deleted' => 0, 'project' => Roles::PROJECT]);
        return $object;
    }

    public function getOptions()
    {
        return self::select('name', 'id')
            ->where(['is_deleted' => 0, 'project' => Roles::PROJECT])
            ->get()->pluck('name', 'id')->toArray();
    }

    /**
     * @param $name
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'role_has_permissions', 'role_id', 'permission_id');
    }
}
