<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repo;

    public function get_user_id() {
        return auth()->id();
    }

    public function inactive(Request $request)
    {
        $ids = $request->input('ids', 0);

        if ($ids) {
            $rs = $this->repo->inactive($ids);

            if ($rs) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Ngừng kích hoạt thành công',
                ]);
            }
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Ngừng koạt không thành công'
        ]);
    }

    public function active(Request $request)
    {
        $ids = $request->input('ids', 0);

        if ($ids) {
            $rs = $this->repo->active($ids);

            if ($rs) {
                return response()->json([
                    'rs' => 1,
                    'msg' => 'Kích hoạt thành công',
                ]);
            }
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Kích hoạt không thành công'
        ]);
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids', 0);
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        if ($ids) {
            $rs = $this->repo->delete($ids);

            return response()->json([
                'rs' => 1,
                'msg' => 'Xóa thành công',
            ]);
        }

        return response()->json([
            'rs' => 0,
            'msg' => 'Xóa không thành công'
        ]);
    }
}
