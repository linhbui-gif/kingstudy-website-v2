<?php
namespace Modules\Admin\Repositories\School;

interface SchoolRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
