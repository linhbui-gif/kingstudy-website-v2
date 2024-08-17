<?php
namespace Modules\Admin\Repositories\Level;

interface LevelRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
