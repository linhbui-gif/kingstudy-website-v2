<?php
namespace Modules\Admin\Repositories\Country;

interface CountryRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
