<?php
namespace Modules\Admin\Repositories\Widget;

interface WidgetRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
