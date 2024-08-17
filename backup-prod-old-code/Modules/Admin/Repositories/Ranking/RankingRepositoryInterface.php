<?php
namespace Modules\Admin\Repositories\Ranking;

interface RankingRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
