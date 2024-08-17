<?php

namespace Modules\Front\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\LandingPagePositionImages;
use Modules\Admin\Entities\LandingPagePositions;
use Modules\Admin\Entities\PostTiktok;
use Modules\Admin\Entities\School;

class CommonController extends Controller
{
  protected $data = [];
  public function index(){
      $datas                       = LandingPagePositions::getDataByLandingPageId(1);
      if($datas) {
          foreach($datas as $data) {
              $position_id[] = $data['id'];
          }
      }
      $this->data['data']     = $datas;
      $this->data['items'] = LandingPagePositionImages::with(['localeVi'])->whereIn('home_position_id',$position_id)
          ->orderBy('ordering')->get()->groupBy('home_position_id')->toArray();
      $this->data['banners'] = DB::table('banners')
          ->select(['name', 'position_id','ordering','status','is_deleted','image_location','image_url','title_sub','description','url'])
          ->where('position_id',1)
          ->where('status', 1)
          ->where('is_deleted', 0)
          ->orderBy('ordering','ASC')
          ->get();
      return response()->json(
          [
              'data' => $this->data,
              'message' => 'Get List common success',
              'code' => 200
          ],
          200
      );
  }
  public function getCountry(){
      $this->data['countries'] = DB::table('country')->select(['id','name','icon','logo'])->get();
      return response()->json(
          [
              'data' => $this->data,
              'message' => 'Get List countries success',
              'code' => 200
          ],
          200
      );
  }
    public function getRanking(){
        $this->data['ranking'] = DB::table('ranking')->select(['id','name'])->get();
        return response()->json(
            [
                'data' => $this->data,
                'message' => 'Get List ranking success',
                'code' => 200
            ],
            200
        );
    }
    public function getLevel(){
        $this->data['level'] = DB::table('level')->select(['id','name'])->get();
        return response()->json(
            [
                'data' => $this->data,
                'message' => 'Get List level success',
                'code' => 200
            ],
            200
        );
    }
    public function getCityByCountry(Request $request){
        $province_id = $request->province_id;
        $this->data['cities'] = DB::table('cities')->select(['id','name'])->where('country_id', $province_id)->get();
        return response()->json(
            [
                'data' => $this->data,
                'message' => 'Get List cities success',
                'code' => 200
            ],
            200
        );
    }
    public function getMajor(){
        $this->data['majors'] = DB::table('majors')->select(['id','name','icon_name'])->limit(9)->get();
        return response()->json(
            [
                'data' => $this->data,
                'message' => 'Get List majors success',
                'code' => 200
            ],
            200
        );
    }
    public function getListContentTikTok(){
        $data = DB::table('post_tiktok')->select("*")->get();
        $html = '';
        if(!empty($data)) {
            foreach ($data as $k => $v) {
                $html .= view('front::tiktok.item')->with(['data' => $v])->render();
            }
        }

        return response()->json(
            [
                'data' => $html,
                'message' => 'Get List post tiktok success',
                'code' => 200
            ],
            200
        );
    }
}
