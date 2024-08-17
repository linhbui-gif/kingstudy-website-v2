<?php
namespace App\Helpers;

use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class General
{

    public static function getOptionStatusImport(){
        return  array(
            '' => '',
            'wait' => 'Chờ thực hiện',
            'working' => 'Đang thực hiện',
            'success' => 'Import thành công',
            'fail' => 'Import không thành công',
        );
    }

    public static function output_textarea($text)
    {
        return nl2br(str_replace(" ", " &nbsp;", e($text)));
    }

    public static function ranges_date_options() {
        $options = [];
        $date = Carbon::now();
        $options[] = '"Hôm nay": ["'.self::output_date($date).'", "'.self::output_date($date).'"]';
        $options[] = '"Hôm qua": ["'.self::output_date($date->subDays(1)).'", "'.self::output_date($date).'"]';
        $options[] = '"7 ngày trước": ["'.self::output_date(Carbon::now()->subDays(6)).'", "'.self::output_date(Carbon::now()).'"]';
        $options[] = '"30 ngày trước": ["'.self::output_date(Carbon::now()->subDays(29)).'", "'.self::output_date(Carbon::now()).'"]';
        $options[] = '"Tháng này": ["'.self::output_date($date->startOfMonth()).'", "'.self::output_date($date->lastOfMonth()).'"]';
        $date = $date->subMonth();
        $options[] = '"Tháng trước": ["'.self::output_date($date->startOfMonth()).'", "'.self::output_date($date->lastOfMonth()).'"]';

        return "{".implode(", ", $options)."}";
    }
    public static function generateJWT(array $data=[], $jwt_key) {
        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode($data);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $jwt_key, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public static function telegram_log($content) {
        $url = 'https://api.telegram.org/sendMessage'; // dùng get chat id
        $url .= '?chat_id='.config('app.telegram_id');
        $url .= '&text='. urlencode(env("APP_NAME")). ': '.$content;

        $res = Curl::to($url)->get();
    }

    public static function uptime_day()
    {
        return [
            0 => 'Chủ nhật',
            1 => 'Thứ hai',
            2 => 'Thứ ba',
            3 => 'Thứ tư',
            4 => 'Thứ năm',
            5 => 'Thứ sáu',
            6 => 'Thứ bảy',
            7 => 'Chủ nhật'
        ];
    }

    public static function parse_date($date, $format_in="d/m/Y", $format_out='Y-m-d')
    {
        if (!$date) return '';

        $date = \Carbon\Carbon::createFromFormat($format_in, $date);

        return $date->format($format_out);
    }

    public static function get_scripts_include_type_options() {
        return [
            ''          => '',
            'head'      => 'head',
            'body'      => 'body'
        ];
    }

    public static function getOptionGender() {
        return  array(
            'male'       => 'Nam',
            'female'     => 'Nữ',
            'other'      => 'Khác',
        );
    }

    public static function getOptionUserType() {
        return  array(
            '3' => 'Quản lý theo đơn vị',
            '2' => 'Quản lý theo địa phương',
            '1' => 'Quản lý cao cấp',

        );
    }
   public static function renderStatus($name){
        switch ($name){
            case 0 :
                return '<strong class="pending">Processing</strong>';
                case 1 :
                return '<strong class="pending">Applied</strong>';
                case 2 :
                return '<strong class="pending">Chase</strong>';
                case 3 :
                return '<strong class="pending">Conditional Offer</strong>';
                case 4 :
                return '<strong class="pending">Unconditional Offer</strong>';
                case 5 :
                return '<strong class="text-danger">Cancel</strong>';
                case 6 :
                return '<strong class="pending">Accept Offer</strong>';
                case 7 :
                return '<strong class="pending">Fail</strong>';
                case 8 :
                return '<strong class="text-success">Successful</strong>';
        }
   }
    public static function moveImage($old, $new_path){
        $dirImage = env('DIR_IMAGE');
        $tmp = pathinfo($new_path);
        $path = $dirImage.$tmp['dirname'];
        $tmpOld = pathinfo($old);
        $pathOld = public_path($tmpOld['dirname']);
        $standardSize = [100,300,1000];
        if (! is_dir ( $path )) {
            mkdir ( $path, 0777, true );
            if( chmod($path, 0777) ) {
                chmod($path, 0755);
            }
        }

        try{
            rename($old, $path.'/'.$tmp['basename']);
            foreach ($standardSize as $size){
                $pathSize = '/'.$size.'x'.$size;
                if (! is_dir ( $path.$pathSize )) {
                    mkdir ( $path.$pathSize, 0777, true );
                    if( chmod($path.$pathSize, 0777) ) {
                        chmod($path.$pathSize, 0755);
                    }
                }
                rename($pathOld.$pathSize.'/'.$tmpOld['basename'], $path.$pathSize.'/'.$tmp['basename']);
            }
        }catch(\Exception $e){
            \Log::info($e->getMessage());
        }
    }
    public static function moveFile($old, $new_path){
        $dirImage = env('DIR_IMAGE');
        $tmp = pathinfo($new_path);
        $path = $dirImage.$tmp['dirname'];
        if (! is_dir ( $path )) {
            mkdir ( $path, 0777, true );
            if( chmod($path, 0777) ) {
                chmod($path, 0755);
            }
        }

        try{
            rename(public_path($old), $path.'/'.$tmp['basename']);
        }catch(\Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public static function checkChangeImage($path, $text='tmp/') {
        return strpos($path,$text) !== false;
    }

    public static function saveImageWithMutipleSize($path, $folder=''){
        $filename = substr(strrchr($path, "/"), 1);
        $standardSize = [100,300,1000];
        $arrImage = [];
        foreach ($standardSize as $standard){
            $path_image = '/static/' .($folder ? $folder.'/' : ''). date("Y/m/d") . "/".$standard."x".$standard;
            $arrImage[$standard] = $path_image. "/" .$filename;
        }

        return $arrImage;
    }

    public static function generateImageLocation($path, $folder='') {
        $filename = substr(strrchr($path, "/"), 1);
        $path_image = '/static/' .($folder ? $folder.'/' : ''). date("Y/m/d") . '/';

        return $path_image . $filename;
    }

    public static function generateVideoEmbedUrl($url){
        //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
        $finalUrl = $url;
        if(strpos($url, 'facebook.com/') !== false) {
            //it is FB video
            $finalUrl='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';
        }else if(strpos($url, 'vimeo.com/') !== false) {
            //it is Vimeo video
            $videoId = explode("vimeo.com/",$url)[1];
            if(strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
                $finalUrl='https://player.vimeo.com/video/'.$videoId;
            }
        }else if(strpos($url, 'youtube.com/') !== false) {
            //it is Youtube video
            $videoId = explode("v=",$url);
            $videoId = $videoId[1] ?? false;
            if($videoId && strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
                $finalUrl='https://www.youtube.com/embed/'.$videoId;
            }
        }else if(strpos($url, 'youtu.be/') !== false){
            //it is Youtube video
            $videoId = explode("youtu.be/",$url)[1];
            if($videoId){
                $finalUrl='https://www.youtube.com/embed/'.$videoId;
            }
        }else{
            //Enter valid video URL
        }
        return $finalUrl;
    }

    public static function get_menus_footer()
    {
        $objects = self::getMenuItemsByPosition('footer');
        $tmp = [];
        foreach ($objects as $item) {
            $tmp[$item['parent_id']][] = $item;
        }

        return $tmp;
    }

    public static function getMenuItemsByPosition($position='main-nav', $re_cache=false) {
        $key = 'MenuItems:Position:'.$position;

        $objects = Cache::get( $key );

        if ($re_cache || !$objects) {
            $query = \App\Models\MenuItem::where('menu_items.position', '=', $position)
                ->leftjoin('pages as p','p.id', '=', 'menu_items.page_id')
                ->orderBy('ordering', 'asc');

            $objects = $query->get([
                'menu_items.*',
                'p.slug as page_slug'
            ])->toArray();

            foreach ($objects as $i => $item) {
                $objects[$i]['link_full'] = self::get_link_menu($item);
            }

            Cache::forever($key, $objects);
        }

        return $objects;
    }

    public static function get_link_menu($item, $locale='') {
        if ($item['type']=='page_link') {
            $tmp = $locale.'/'.$item['page_slug'];
        } elseif ($item['type']=='internal_link') {
            $tmp = $locale.$item['link'];
        } else {
            $tmp = $item['link'];
        }

        return url($tmp ? $tmp : '/');
    }

    public static function get_scripts_include($type='body', $re_cache=false) {
        $key = 'ScriptInclude:All';

        $objects = Cache::get( $key );

        if ($re_cache || !$objects) {
            $objects = \App\Models\ScriptInclude::getAllScripts();

            Cache::forever($key, $objects);
        }

        foreach ($objects as $item) {
            if (!isset($item['type']) || $item['type']===$type) echo $item['value'];
        }
    }

    public static function getAddress($ward_id,$address=''){
        $ward = \App\Models\Ward::select(
            \DB::raw("CONCAT_WS(' ', provinces.type, provinces.name) as province_name"),
            \DB::raw("CONCAT_WS(' ', districts.type, districts.name) as district_name"),
            \DB::raw("CONCAT_WS(' ', wards.type, wards.name) as ward_name")
        )
            ->where('ward_id', $ward_id)
            ->leftJoin('districts', 'districts.district_id', '=', 'wards.district_id')
            ->leftJoin('provinces', 'provinces.province_id', '=', 'districts.province_id')
            ->first();
        $address = [$address];
        if ($ward['ward_name'] && strpos($address[0], $ward['ward_name']) === false) {
            $address[] = $ward['ward_name'];
        }
        if ($ward['district_name'] && strpos($address[0], $ward['district_name']) === false) {
            $address[] = $ward['district_name'];
        }
        if ($ward['province_name'] && strpos($address[0], $ward['province_name']) === false) {
            $address[] = $ward['province_name'];
        }
        $address = implode(", ", $address);
        return $address;
    }

    public static function get_settings($name=null, $re_cache=false) {
        $key = 'Settings:All';
        $objects = [];
        //$objects = Cache::get( $key );

        if ($re_cache || !$objects) {
            $objects = \App\Models\Setting::getAllSettings();
            Cache::forever($key, $objects);
        }

        if ($name) {
            return @$objects[$name];
        }

        return $objects;
    }

    public static function handlingCategories(&$result, $data, $parent=0, $step = 0) {
        $str_step = '';
        for ($i=0; $i<$step; $i++) {
            $str_step .= '|--';
        }

        if (!isset($data['parent'])) return $result;

        foreach( $data['parent'][$parent] as $key => $item){

            $result[] = array(
                'category_id' => $item,
                'category' => $str_step.$data['item'][$item]['category'],
            );

            //$step < 2 &&
            if(isset($data['parent'][$item]))
                self::handlingCategories($result, $data, $item, $step+1);
        }
    }

    public static function get_format_date() {
        return 'd-m-Y';
    }

    public static function order_sources() {
        return ['' => 'Web', 'web' => 'Web',
            'wap' => 'Mobile Web', 'admin' => 'Admin','ios' => 'IOS',
            'android' => 'Android'
        ];
    }

    public static function string_area_to_array($string)
    {
        if ($string != ''){
            $arr_barcode = preg_split('/\r\n|[\r\n]|,|;/', $string);
            foreach ($arr_barcode as $key => $value) {
                $tmp = trim($value);
                if ($tmp == '') {
                    unset($arr_barcode[$key]);
                    continue;
                }
                $arr_barcode[$key] = $tmp;
            }

            return $arr_barcode;
        }

        return array();
    }

    public static function get_status_actions() {
        return [
            '1' => 'Kích hoạt',
            '0' => 'Không kích hoạt',
        ];
    }
    public static function get_status_category_options() {
        return self::get_status_product_options();
    }
    public static function get_status_product_options() {
        return [
            '' => 'Chọn trạng thái',
            'A' => 'Kích hoạt',
            'D' => 'Vô hiệu hoá',
            'H' => 'Ẩn',
            'X' => 'Đã xóa',
        ];
    }

    public static function get_time_options() {
        return [
            "" => "Chọn thời gian",
            "to_day" => "Hôm nay",
            "this_week" => "Trong tuần",
            "this_month" => "Trong tháng",
            "this_year" => "Trong năm",
            "last_year" => "Năm trước",
        ];
    }

    public static function get_status_options() {
        return [
            '' => 'Chọn trạng thái',
            '1' => 'Đã kích hoạt',
            '0' => 'Chưa kích hoạt',
        ];
    }

    public static function get_menu_type_options() {
        return [
            ''              => '',
            'page_link'     => 'Page Link',
            'internal_link' => 'Internal Link',
            'external_link' => 'External Link'
        ];
    }

    public static function get_gender_options() {
        return [
            '' => 'Chọn giới tính',
            '0' => 'Nữ',
            '1' => 'Nam',
            '2' => 'Khác'
        ];
    }

    public static function get_sort_options($id=null) {
        return [
            'price-asc' => 'Giá từ thấp đến cao',
            'price-desc' => 'Gia từ cao đến thấp',
            'product_count-desc' => 'Số lượng',
        ];
    }

    public static function get_ordering_options($id=null) {
        $rs = [];
        for ($i=1; $i<20; $i++) {
            $rs[$i] = 'Vị trí ' . $i;
        }

        return $rs;
    }

    static function get_version_js($re_cache=false) {
        $key = 'get_version_js';

        $value = Cache::get( $key );

        if ($re_cache || !$value) {
            $value = time();

            Cache::forever($key, $value);
        }

        return $value;
    }
    static function get_version_css($re_cache=false) {
        $key = 'get_version_css';

        $value = Cache::get( $key );

        if ($re_cache || !$value) {
            $value = time();

            Cache::forever($key, $value);
        }

        return $value;
    }

    public static function output_datetime($date, $format='H\hi - d/m/Y')
    {
        return self::output_date($date, $format);
    }
    public static function output_date($date, $format='d/m/Y') {
        if(!$date || $date=="0000-00-00") {
            return "";
        }

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        return $date->format($format);
    }
    public static function output_date_coupon($date, $is_return=false, $format='d-m-Y') {
        if(!$date || $date=="0000-00-00" || strlen($date) < 10) {
            if ($is_return) {
                return "";
            }
            echo "";
            return;
        }

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        if ($is_return) {
            return $date->format($format);
        }

        echo $date->format($format);
    }

    public static function output_time_of_date($date, $is_return=false) {
        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        if ($is_return) {
            return $date->format('H:i');
        }

        echo $date->format('H:i');
    }

    public static function get_controller_action() {
        $action = app('request')->route()->getAction();

        $route = isset($action['as']) ? $action['as'] : '';
        $controller = class_basename($action['controller'] ?? '');

        $controller = explode('@', $controller);

        return array(
            'controller' => $controller[0] ?? '',
            'action' => $controller[1] ?? '',
            'route_name' => $route,
            'as' => $route,
            'prefix' => $action['prefix'],
            'namespace' => $action['namespace'],
            'parameters' => app('request')->route()->parameters
        );
    }

    public static function get_data_fillable($model, $data) {
        $fillable = $model->getFillable();

        $rs = [];
        foreach ($fillable as $field) {
            if (array_key_exists($field, $data)) {
                $rs[$field] = $data[$field];
            }
        }

        if(method_exists($model,'get_default_value')){
            $defaul_value = $model->get_default_value();

            foreach ($defaul_value as $key => $value){
                if(!isset($rs[$key]) || $rs[$key] == null){
                    $rs[$key] = $value;
                }

            }
        }
        return $rs;
    }

    public static function saveFileUpload($filename, $path)
    {
        if (empty($filename)) return '';

        $root = rtrim(public_path(), '/') . '/';

        // file goc
        $path_file = realpath( $root ."uploads/tmp/". $filename );

        if( file_exists ($path_file) ) {

            // tao thu muc
            if (! is_dir ( $root . $path )) {
                mkdir ( $root . $path, 0777, true );
                if( chmod($root . $path, 0777) ) {
                    // more code
                    chmod($root . $path, 0755);
                }
            }

            // file dich
            $info = pathinfo($path_file);
            $filename = $path .time().'-'. Str::slug(basename($path_file,'.'.$info['extension']), '-' ).'.'.$info['extension'];

            rename($path_file, $root . $filename );

            // xoa hinh tmp
            @unlink($path_file);
//            $filename = url($filename);

            return array('url' => url('/'), 'filename' => $filename);
        }

        return '';
    }

    public static function get_limit_options() {
        return [
            '10' => '10 dòng/Trang',
            '20' => '20 dòng/Trang',
            '30' => '30 dòng/Trang',
            '40' => '40 dòng/Trang',
            '50' => '50 dòng/Trang',
        ];
    }

    public static function classIcon(){
        return [
            'icon-air-conditioner',
            'icon-tivi',
            'icon-water-heater',
            'icon-washing-machine',
            'icon-fan',
            'icon-customer-support',
            'icon-gas',
        ];
    }

    public static function titleRole(){
        return [
            'head'  => 'Giám đốc',
            'deputy' => 'Phó giám đốc',
            'leader' => 'Trưởng phòng',
            'normal' => 'Bình thường'
        ];
    }

    /**
     * This function fillter attri array and clear any request hard code
     * Author Phuoc Nguyen
     */
    public static function preg_array_key_exists($pattern, &$array) : array
    {
        $allKeysParams = array_keys($array);
        $arrayResult = [];
        foreach($allKeysParams as $key){
            if (preg_match($pattern, $key) == 1){
                $keyItem = preg_split($pattern, $key)[0];
                $arrayResult[$keyItem] = $array[$key];
                unset($array[$key]);
            }
        }
        return $arrayResult;
    }
    public static function getUrlImageThumb($url, $width= null){
        return $url;
        if($width){
            $strReplace = "https://kingstudy.vn";
            $url = str_replace($strReplace,"", $url);
            $path_file = public_path($url);
            if(file_exists($path_file)){
                $baseName = pathinfo($url, PATHINFO_FILENAME);
                //$ext = pathinfo($url, PATHINFO_EXTENSION);
                $ext = "webp";
                $dir = pathinfo($url, PATHINFO_DIRNAME);
                $dir = str_replace("/" , "-", $dir);
                $newName = $dir ."-".  $baseName . "-" . $width ."px.". $ext;
                $path_save = public_path('thumbs');
                if (!is_dir($path_save)) {    //  Tạo folder nếu không tồn tại
                    mkdir($path_save, 0755, true);
                }

                if(file_exists($path_save . "/" . $newName)){
                    return "/thumbs/" .  $newName;
                }

                \Image::make($path_file)->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_save . "/" . $newName);
                return "/thumbs/" .  $newName;
            }
        }
        return $url;
    }


}
