<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\General;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Contacts;


class ContactsController extends Controller
{
    protected $model;
    /**
     * Create a new controller instance.
     */
    public function __construct(Contacts $model)
    {
        $this->model = $model;
        $this->data['title'] = 'Quản lý lời nhắn';
        $this->data['controllerName'] = 'admin::contacts';
        $this->view = 'admin::contacts';
    }
    public function search(Request $request)
    {
        $limit = $request->input('limit', env('LIMIT_LIST', 10));
        if (!$request->has('page')) {
            $offset = $request->input('offset', 0);
            $page = round($offset / $limit) + 1;
            $request->request->add(['page' => $page]);
        }

        $objects = Contacts::select('contacts.*')
            ->where('contacts.id', '!=', 1)
            ->where('contacts.is_deleted', 0);

        $keyword = $request->input('search', '');
        if ($keyword) {
            $objects->where(function ($query) use ($keyword) {
                $query->where('contacts.name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $sort = $request->input('sort', 'contacts.id');
        $order = $request->input('order', 'desc');
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }

        $objects = $objects->paginate($limit, [
            \DB::raw('contacts.*')
        ])->toArray();
        return response()->json(['rows' => $objects['data'], 'total' => $objects['total']]);
    }
    public function index(Request $request){
        $params = $request->all();
        $limit = $request->get('limit',10);

        $objects = Contacts::with('level_courses','school_of_contact:id,name','national_of_contact:id,name')
                            ->where(['is_deleted' => 0])->paginate($limit);
        $this->data['objects']  = $objects->toArray();
        return view("{$this->view}.index", $this->data);
    }

    public function destroy($id){
        $object = $this->model->find($id);
        if($object){
            $object->is_deleted = 1;
            $object->save();
            return response()->json([
                'rs' => 1,
                'msg' => 'Xóa thành công!',
            ]);
        }
        return response()->json([
            'rs' => 0,
            'msg' => 'Xóa không thành công!',
        ]);
    }
}
