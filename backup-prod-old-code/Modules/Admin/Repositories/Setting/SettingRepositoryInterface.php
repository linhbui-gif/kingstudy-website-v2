<?php
namespace Modules\Admin\Repositories\Setting;

use Modules\Admin\Entities\Setting;

interface SettingRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
    public function  get_status_options();
    public function getObjectByKey($key = '');
    public function getObjectById($id);
    public function getObjectsByKeys($keys);
    public function getAllSettings();

}
