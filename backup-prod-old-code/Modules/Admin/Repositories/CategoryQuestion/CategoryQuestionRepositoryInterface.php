<?php
namespace Modules\Admin\Repositories\CategoryQuestion;

interface CategoryQuestionRepositoryInterface
{
    public function get_all_items($filter,$search_fields=[],$with=[],$search_relate_fields=[]);
    public function getQuestions();
}
