<?php
namespace Modules\Admin\Repositories\News;

interface NewsRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
