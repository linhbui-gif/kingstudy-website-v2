<?php
namespace Modules\Admin\Repositories\Course;

interface CourseRepositoryInterface
{
    public function getListAll($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
}
