<?php
namespace Modules\Admin\Repositories\StudyAbroad;

interface StudyAbroadRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
