<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Province;
use Modules\Admin\Entities\District;
use Modules\Admin\Entities\Ward;


class ProvinceController extends Controller
{
    protected $model;
    /**
     * Create a new controller instance.
     */
    public function __construct(Province $model)
    {
        $this->model = $model;
        $this->data['title'] = 'Quản lý tỉnh thành';
        $this->data['controllerName'] = 'admin::province';
        $this->view = 'admin::province';
    }
    public function search(Request $request)
    {
        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        if (!$request->has('page')) {
            $offset = $request->input('offset', 0);
            $page = round($offset / $limit) + 1;
            $request->request->add(['page' => $page]);
        }

        $objects = Province::select('province.*')
            ->where('province.id', '!=', 1)
            ->where('province.is_deleted', 0);

        $keyword = $request->input('search', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('province.name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $sort = $request->input('sort', 'units.id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, [
            \DB::raw('province.*')
        ])->toArray();
        return response()->json(['rows' => $objects['data'], 'total' => $objects['total']]);
    }
    public function index(Request $request){
        $params = $request->all();
        $province = $request->province;
        $district = $request->district;
        $limit = $request->get('limit',100);
        if($request->filled('province')){
            $provinces = District::where('_province_id', $province)->get();
            $this->data['provinces']  = $provinces ->toArray();
        }
        if($request->filled('district')){
            $districts = Ward::where('_district_id', $district)->where('_province_id', $province)->get();
            $this->data['districts']  = $districts ->toArray();
        }

        $objects = $this->model->paginate($limit);
        $this->data['objects']  = $objects ->toArray();
        return view("{$this->view}.index", $this->data);
    }
}
