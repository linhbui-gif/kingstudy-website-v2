<?php
namespace Modules\Admin\Repositories\City;

interface CityRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
