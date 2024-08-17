<?php
namespace Modules\Admin\Repositories\CategoryQuestion;
use App\Repositories\BaseRepository;
use Modules\Admin\Entities\CategoryQuestion;

class CategoryQuestionRepository extends BaseRepository implements CategoryQuestionRepositoryInterface
{
    public function getModel()
    {
        return CategoryQuestion::class;
    }

    public function getQuestions() {

    }

     public function get_all_items($filter,$search_fields=[],$field_addition=[],$with=[],$search_relate_fields=[])
    {
        $sql = $this->model->select('question_categories.id',
                                    'question_categories.name',
                                    'question_categories.status',
                                    'question_categories.created_at',)
                            ->where('question_categories.is_deleted', 0)
                            ->withCount(['getQuestions']);
        if (!empty($filter['keyword']) && !empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('question_categories.name', 'LIKE', '%' . $filter['keyword'] . '%');
                $query->orWhere('question_categories.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }
        else if(!empty($filter['keyword']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('question_categories.name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        else if(!empty($filter['search']))
        {
            $sql->where(function ($query) use ($filter)
            {
                $query->where('question_categories.name', 'LIKE', '%' . $filter['search'] . '%');
            });
        }

        $date_from = $filter['date_from'] ?? '';
        if ($date_from) {
            $date_from = date('Y-m-d 00:00:00', strtotime($date_from));
            $sql->where('question_categories.created_at', '>=', $date_from);
        }
        $date_to = $filter['date_to'] ?? '';
        if ($date_to) {
            $date_to = date('Y-m-d 23:59:59', strtotime($date_to));
            $sql->where('question_categories.created_at', '<=', $date_to);
        }
        $total = $sql->count();

        $data = $sql->skip($filter['offset'])
            ->take($filter['limit'])
            ->orderBy($filter['sort'], $filter['order'])
            ->get()->toArray();
        return ['total' => $total, 'data' => $data];
    }
}
