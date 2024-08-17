<?php
namespace Modules\Admin\Repositories\CategoryCourse;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\CategoryCourses;

class CategoryCourseRepository extends BaseRepository implements CategoryCourseRepositoryInterface
{
    public function getModel()
    {
        return CategoryCourses::class;
    }

    public function getOptionsCategoryCourse() {
        $positions = $this->model->select('id', 'name')
            ->where('is_deleted', '=', 0)
            ->orderBy('ordering', 'asc');
        $positions = $positions->get()->pluck('name','id')->toArray();
        return ["0" => "-- Chọn danh mục --" ] + $positions;

    }
}
