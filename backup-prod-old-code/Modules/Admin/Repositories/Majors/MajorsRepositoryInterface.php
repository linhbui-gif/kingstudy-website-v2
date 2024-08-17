<?php
namespace Modules\Admin\Repositories\Majors;

interface MajorsRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
