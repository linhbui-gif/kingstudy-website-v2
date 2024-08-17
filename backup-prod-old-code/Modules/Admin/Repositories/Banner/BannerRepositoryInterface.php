<?php
namespace Modules\Admin\Repositories\Banner;

interface BannerRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
