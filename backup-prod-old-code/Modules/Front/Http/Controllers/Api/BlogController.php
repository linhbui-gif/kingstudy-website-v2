<?php
namespace Modules\Front\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\Admin\Entities\News;
use Modules\Front\Traits\ApiResponseTrait;

class BlogController extends Controller {
    use ApiResponseTrait;
   public function index(Request $request) {
       $categoryID = $request->id;
       $data  = [];
       if(isset($categoryID)) {
           $data = News::select('title','alias','image_location','description','created_at')->where('is_deleted', 0)->where('category_id',$categoryID)->orderBy('id','DESC')->get();
       } else {
           $data = News::with('categories')->latest()->paginate(15);
       }
       return $this->successResponseJson($data,'Get list news success');
   }
   public function getListEvent() {
       $data = News::where('category_id', 26)->latest()->paginate(15);
       return $this->successResponseJson($data,'Get list event success');
   }
   public function getDetail($slug) {
       $details = '';
       if($slug != null) {
           $details = News::where('alias',$slug)->with('categories')->first();
       }
       return $this->successResponseJson($details,'Get detail news success');
   }
   public function getListCategory() {
       $data = DB::table('new_categories')->select(['name','id'])->where('parent_id', 0)->limit(10)->get();
       return $this->successResponseJson($data,'Get list category success');
   }
}
