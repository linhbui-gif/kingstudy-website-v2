<?php
namespace Modules\Admin\Entities;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $is_deleted = false;

    public static function getInstance(){
        return (new static) ;
    }

    public function scopeNotDeleted($query,$table=null)
    {
        if(!$this->is_deleted){
            return;
        }
        $table = $table?$table:$this->table;
        return $query->where($table.'.'.'is_deleted',0);
    }
    public function scopeActive($query,$table=null)
    {
        $table = $table?$table:$this->table;
        return $query->where($table.'.'.'status',1);
    }
    public function scopeSoftDelete($query,$table=null)
    {
        if($this->is_deleted){
            return $query->update(['is_deleted' => 1]);
        }
        return $query->delete();
    }

    public function deleteItem($id){
        $object = self::find($id);
        if(!$object) return false;
        if($this->is_deleted){
            return $object->update(['is_deleted' => 1]);
        }
        return $object->delete();
    }

    public function isSoftDelete(){
        return $this->is_deleted;
    }
}
