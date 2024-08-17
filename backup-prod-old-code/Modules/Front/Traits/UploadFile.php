<?php
namespace Modules\Front\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait UploadFile {
    public function uploadFileTmp($request, $format, $fileName = 'files') {
        $fileArr = [];
        if ($request->hasFile($fileName)) {
            $file = $request->file($fileName);
            $object = trim($request->input('object', 'products'), '');
            foreach($file as $files) {
                $extension = $files->getClientOriginalExtension();
                if (!in_array(strtolower($extension), $format)) {
                    return response()->json(
                        [
                            'message' => 'Vui lòng Upload file đúng định dạng',
                            'status' => 404,
                        ],
                        404
                    );
                }

                $filename = $files->getClientOriginalName();
                $picture = sha1($filename . time()) . '.' . $extension;

                /**
                 * Path to the 'public' folder
                 */
                $path_image = 'tmp/'.$object.'/';

                $path = public_path($path_image);
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $destinationPath = $path;

                $files->move($destinationPath, $picture);

                $fileTmp = array();
                $fileTmp['file_name'] = pathinfo($filename, PATHINFO_FILENAME);
                $fileTmp['name'] = $path_image . $picture;
                $fileTmp['size'] = $this->get_file_size($destinationPath.$picture);
                $fileTmp['file_name_extension'] = $filename;

                if ($fileTmp['size'] > 2000000 && $object != 'home') {
                    unlink($destinationPath.$picture);
                    return ['error' => 'Kích thước file không được quá 2MB'];
                }

                $fileArr['files'][] = $fileTmp;
            }
            return $fileArr;
        }
    }

    protected function get_file_size($file_path, $clear_stat_cache = false) {
        if ($clear_stat_cache) {
            if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
                clearstatcache(true, $file_path);
            } else {
                clearstatcache();
            }
        }
        return $this->fix_integer_overflow(filesize($file_path));
    }
    protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }
    public static function resizeWriteMark($sourceType, $imgWidth, $imgHeight, $sizeImgSource){
        $resizeStandard = ( $sizeImgSource < 200 ? $sizeImgSource : 1024 )/ 7;
        $resizeWidth = $resizeStandard;
        if($imgHeight <= 0){
            return false;
        }
        $resizeHeight = $resizeStandard/($imgWidth / $imgHeight);
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        $transparencyIndex = imagecolortransparent($sourceType);
        $transparencyColor = array('red' => 0, 'green' => 0, 'blue' => 0);
        if($sizeImgSource == 960){
            $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);
        }
        if ($transparencyIndex >= 0) {
            $transparencyColor    = imagecolorsforindex($sourceType, $transparencyIndex);
        }
        $transparencyIndex    = imagecolorallocate($imageLayer, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
        imagefill($imageLayer, 0, 0, $transparencyIndex);
        imagecolortransparent($imageLayer, $transparencyIndex);
        imagecopyresized($imageLayer, $sourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $imgWidth, $imgHeight);
        return $imageLayer;
    }
    public static function resizeImageHD($sourceType, $imgWidth, $imgHeight){
        $resizeWidthStand = 2560;
        $resizeHeightStand = 1440;
        $resizeWidth = 0;
        $resizeHeight = 0;
        $r = $imgWidth / $imgHeight;
        if($r >= 1){
            if($imgWidth > $resizeWidthStand){
                $resizeWidth = $resizeWidthStand;
                $resizeHeight = floor($resizeWidth / ($imgWidth / $imgHeight));
            }else {
                $resizeWidth = $imgWidth;
                $resizeHeight = $imgHeight;
            }
        }
        else if($r < 1){
            if($imgHeight > $resizeHeightStand){
                $resizeHeight = $resizeHeightStand;
                $resizeWidth = floor($resizeHeight* ($imgWidth / $imgHeight));
            }else{
                $resizeWidth = $imgWidth;
                $resizeHeight = $imgHeight;
            }
        }
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresized($imageLayer, $sourceType, 0,0,0,0,$resizeWidth,$resizeHeight,$imgWidth,$imgHeight);

        return $imageLayer;
    }
    public static function resizeImage($sourceType, $imgWidth, $imgHeight){
        $resizeStandard = [100,300,1000];
        $r = $imgWidth / $imgHeight;
        $arrImg = [];
        foreach ($resizeStandard as $standard){
            if($r >= 1){
                if($imgWidth > $standard){
                    $resizeWidth = $standard;
                    $resizeHeight = $standard/($imgWidth / $imgHeight);
                }else{
                    $resizeWidth = $imgWidth;
                    $resizeHeight = $imgHeight;
                }
            }
            else if($r < 1){
                if($imgHeight > $standard){
                    $resizeHeight = $standard;
                    $resizeWidth = $standard*($imgWidth / $imgHeight);
                }else{
                    $resizeWidth = $imgWidth;
                    $resizeHeight = $imgHeight;
                }
            }
            $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
            imagecopyresized($imageLayer, $sourceType, 0,0,0,0,$resizeWidth,$resizeHeight,$imgWidth,$imgHeight);
            $arrImg[] = $imageLayer;
        }

        return [$arrImg,$resizeStandard];
    }
}
