<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ajaxray\PHPWatermark\Watermark;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->data['controllerName'] = 'upload';
    }

    public function index(Request $request)
    {
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $object = trim($request->input('object', 'products'), '');

            foreach($file as $files) {
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = sha1($filename . time()) . '.' . $extension;

                /**
                 * Path to the 'public' folder
                 */
                $path_image = 'app/public/data/'.$object.'/';
                $path_image .= date("Y/m/d/");

                $path = storage_path($path_image);

                // tao thu muc
                if (! is_dir ( $path )) {
                    mkdir ( $path, 0777, true );
                    if( chmod($path, 0777) ) {
                        // more code
                        chmod($path, 0755);
                    }
                }
                //specify your folder

                $destinationPath = $path;
                $files->move($destinationPath, $picture);
//                $destinationPath1='http://'.$_SERVER['HTTP_HOST'].'/files_clients/' .$folder[0]->folder. '/';
                $filest = array();
                $filest['file_name'] = basename($filename, '.'.$extension);
                $filest['name'] = $path_image.$picture;
                $filest['size'] = $this->get_file_size($destinationPath.$picture);
//                $filest['url'] = $destinationPath1.$picture;
//                $filest['thumbnailUrl'] = $destinationPath1.$picture;
                $filesa['files'][] = $filest;
            }

            return $filesa;
        }
    }

    /**
     * @param $sourceType
     * @param $imgWidth
     * @param $imgHeight
     * @return false|\GdImage|resource
     * function resize img with 3 size
     */
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

    /**
     * @param $sourceType
     * @param $imgWidth
     * @param $imgHeight
     * @param $sizeImgSource
     * @return false|\GdImage|resource
     */
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

    /**
     * @param $sourceType
     * @param $imgWidth
     * @param $imgHeight
     * @return false|\GdImage|resource
     */
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

    /**
     * @param Request $request
     * @return array|string[]
     */
    public function uploadTempImg(Request $request)
    {
        $image_formats = ['jpg', 'jpeg', 'png'];
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $object = trim($request->input('object', 'products'), '');
            $verifyObject = ['user-avatar', 'home', 'agents', 'investor', 'meta-seo'];
            $updateWaterMark = in_array($object,$verifyObject);
            foreach($file as $files) {
                $sourceProp = getimagesize($files);

                $extension = $files->getClientOriginalExtension();
                if (!in_array(strtolower($extension), $image_formats)) {
                    return ['error' => 'Định dạng phải nằm trong các format sau đây: jpeg, jpg, png'];
                }
                $fileWidth = $sourceProp[0];
                $fileHeight = $sourceProp[1];
                $filetype = $sourceProp[2];

                $filename = $files->getClientOriginalName();
                $picture = sha1($filename . time()) . '.' . $extension;

                /**
                 * Path to the 'public' folder
                 */
                $path_image = 'tmp/'.$object.'/';

                $path = public_path($path_image);
                // tao thu muc
                if (! is_dir ( $path )) {
                    mkdir ( $path, 0777, true );
                    if( chmod($path, 0777) ) {
                        // more code
                        chmod($path, 0755);
                    }
                }
                //specify your folder

                $destinationPath = $path;
                switch($filetype){

                    case IMAGETYPE_GIF:
                        $imgType = imagecreatefromgif($files);
                        if($object == "meta-seo"){
                           // $imgTypeChange = self::resizeWriteMark($imgType, imagesx($imgType), imagesy($imgType),960);
                            $file1new  = imagecreatetruecolor(960, 960);
                            $white = imagecolorallocate($file1new, 255, 255, 255);
                            imagefill($file1new, 0, 0, $white);  //Line 1
                            $rightOffset = (960 - (imagesx($file1new) - imagesx($imgTypeChange)) / 2) + 1;
                            //imagecopymerge($file1new, $imgTypeChange, (imagesx($file1new) - imagesx($imgTypeChange)) / 2, (imagesy($file1new) - imagesy($imgTypeChange)) / 2, 0, 0, imagesx($imgTypeChange), imagesy($imgTypeChange),100);
                            imagefill($file1new, $rightOffset, 0, $white); //Line 2
                            imagejpeg($file1new, $destinationPath.$picture);
                        }else {
                            $imgHD = self::resizeImageHD($imgType, $fileWidth, $fileHeight);
                            $imgLayers = self::resizeImage($imgHD, imagesx($imgHD), imagesy($imgHD))[0];
                            $standardSize = self::resizeImage($imgHD, imagesx($imgHD), imagesy($imgHD))[1];
                            if(!$updateWaterMark){
                                imagegif($imgHD, $destinationPath . $picture);
                                foreach ($imgLayers as $key => $imgLayer) {
                                    // tao thu muc cho các size
                                    if (!is_dir($destinationPath . "$standardSize[$key]x$standardSize[$key]")) {
                                        mkdir($destinationPath . "$standardSize[$key]x$standardSize[$key]", 0777, true);
                                        if (chmod($destinationPath . "$standardSize[$key]x$standardSize[$key]", 0777)) {
                                            // more code
                                            chmod($destinationPath . "$standardSize[$key]x$standardSize[$key]", 0755);
                                        }
                                    }
                                    if (!$updateWaterMark) {
                                        $stampResize = self::resizeWriteMark($stamp, $widthWatermark, $heightWatermark, $standardSize[$key]);
                                        $sxResize = imagesx($stampResize);
                                        $syResize = imagesy($stampResize);
                                        imagecopymerge($imgLayer, $stampResize, (imagesx($imgLayer) - $sxResize) / 2, (imagesy($imgLayer) - $syResize) / 2, 0, 0, imagesx($stampResize), imagesy($stampResize), 20);
                                    }
                                    imagegif($imgLayer, $destinationPath . "$standardSize[$key]x$standardSize[$key]/" . $picture);
                                }
                            }else{
                                $files->move($destinationPath, $picture);
                            }

                        }
                        break;
                    case IMAGETYPE_PNG:
                        $imgType = imagecreatefrompng($files);
                        if($object == "meta-seo"){
                            $imgTypeChange = self::resizeWriteMark($imgType, imagesx($imgType), imagesy($imgType),960);
                            $file1new  = imagecreatetruecolor(960, 960);
                            $white = imagecolorallocate($file1new, 255, 255, 255);
                            imagefill($file1new, 0, 0, $white);  //Line 1
                            $rightOffset = (960 - (imagesx($file1new) - imagesx($imgTypeChange)) / 2) + 1;
                            imagecopymerge($file1new, $imgTypeChange, (imagesx($file1new) - imagesx($imgTypeChange)) / 2, (imagesy($file1new) - imagesy($imgTypeChange)) / 2, 0, 0, imagesx($imgTypeChange), imagesy($imgTypeChange),100);
                            imagefill($file1new, $rightOffset, 0, $white); //Line 2
                            imagejpeg($file1new, $destinationPath.$picture);
                        }else{
                            $files->move($destinationPath, $picture);
                        }
                        break;
                    case IMAGETYPE_JPEG:
                        $imgType = imagecreatefromjpeg($files);
                        if($object == "meta-seo"){
                           // $imgTypeChange = self::resizeWriteMark($imgType, imagesx($imgType), imagesy($imgType),960);
                            $file1new  = imagecreatetruecolor(960, 960);
                            $white = imagecolorallocate($file1new, 255, 255, 255);
                            imagefill($file1new, 0, 0, $white);  //Line 1
                            $rightOffset = (960 - (imagesx($file1new) - imagesx($imgTypeChange)) / 2) + 1;
                           // imagecopymerge($file1new, $imgTypeChange, (imagesx($file1new) - imagesx($imgTypeChange)) / 2, (imagesy($file1new) - imagesy($imgTypeChange)) / 2, 0, 0, imagesx($imgTypeChange), imagesy($imgTypeChange),100);
                            imagefill($file1new, $rightOffset, 0, $white); //Line 2
                            imagejpeg($file1new, $destinationPath.$picture);
                        }else {
                            $files->move($destinationPath, $picture);
                        }
                        break;
                    case IMAGETYPE_BMP:
                        $imgType = imagecreatefrombmp($files);
                        if($object == "meta-seo"){
                            $imgTypeChange = self::resizeWriteMark($imgType, imagesx($imgType), imagesy($imgType),960);
                            $file1new  = imagecreatetruecolor(960, 960);
                            $white = imagecolorallocate($file1new, 255, 255, 255);
                            imagefill($file1new, 0, 0, $white);  //Line 1
                            $rightOffset = (960 - (imagesx($file1new) - imagesx($imgTypeChange)) / 2) + 1;
                            imagecopymerge($file1new, $imgTypeChange, (imagesx($file1new) - imagesx($imgTypeChange)) / 2, (imagesy($file1new) - imagesy($imgTypeChange)) / 2, 0, 0, imagesx($imgTypeChange), imagesy($imgTypeChange),100);
                            imagefill($file1new, $rightOffset, 0, $white); //Line 2
                            imagejpeg($file1new, $destinationPath.$picture);
                        }else {
                            $imgHD = self::resizeImageHD($imgType, $fileWidth, $fileHeight);
                            $imgLayers = self::resizeImage($imgHD, imagesx($imgHD), imagesy($imgHD))[0];
                            $standardSize = self::resizeImage($imgHD, imagesx($imgHD), imagesy($imgHD))[1];
                            if(!$updateWaterMark){
                                imagebmp($imgHD, $destinationPath . $picture);
                                foreach ($imgLayers as $key => $imgLayer) {
                                    // tao thu muc cho các size
                                    if (!is_dir($destinationPath . "$standardSize[$key]x$standardSize[$key]")) {
                                        mkdir($destinationPath . "$standardSize[$key]x$standardSize[$key]", 0777, true);
                                        if (chmod($destinationPath . "$standardSize[$key]x$standardSize[$key]", 0777)) {
                                            // more code
                                            chmod($destinationPath . "$standardSize[$key]x$standardSize[$key]", 0755);
                                        }
                                    }
                                    if (!$updateWaterMark) {
                                        $stampResize = self::resizeWriteMark($stamp, $widthWatermark, $heightWatermark, $standardSize[$key]);
                                        $sxResize = imagesx($stampResize);
                                        $syResize = imagesy($stampResize);
                                        imagecopymerge($imgLayer, $stampResize, (imagesx($imgLayer) - $sxResize) / 2, (imagesy($imgLayer) - $syResize) / 2, 0, 0, imagesx($stampResize), imagesy($stampResize), 20);
                                    }
                                    imagebmp($imgLayer, $destinationPath . "$standardSize[$key]x$standardSize[$key]/" . $picture);
                                }
                            }else{
                                $files->move($destinationPath, $picture);
                            }

                        }
                        break;
                }
                $filest = array();
                $filest['file_name'] = pathinfo($filename,PATHINFO_FILENAME);
                $filest['name'] = $path_image.$picture;
                $filest['size'] = $this->get_file_size($destinationPath.$picture);
                if ($filest['size'] > 2000000 && $object != 'home') {
                    unlink($destinationPath.$picture);
                    return ['error' => 'Kích thước file không được quá 2MB'];
                }
                $filesa['files'][] = $filest;
            }
            return $filesa;
        }
    }

    public function uploadContractForm(Request $request)
    {
        $image_formats = ['pdf'];
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $object = trim($request->input('object', 'products'), '');
            foreach($file as $files) {
                $extension = $files->getClientOriginalExtension();
                if (!in_array(strtolower($extension), $image_formats)) {
                    return ['error' => 'Định dạng tải lên phải là PDF'];
                }

                $filename = $files->getClientOriginalName();
                $picture = sha1($filename . time()) . '.' . $extension;

                /**
                 * Path to the 'public' folder
                 */
                $path_image = 'tmp/'.$object.'/';
                $path_image .= date("Y/m/d/");

                $path = public_path($path_image);

                // tao thu muc
                if (! is_dir ( $path )) {
                    mkdir ( $path, 0777, true );
                    if( chmod($path, 0777) ) {
                        // more code
                        chmod($path, 0755);
                    }
                }

                $destinationPath = $path;

                $files->move($destinationPath, $picture);

                $filest = array();
                $filest['file_name'] = pathinfo($filename,PATHINFO_FILENAME);
                $filest['name'] = $path_image.$picture;
                $filest['size'] = $this->get_file_size($destinationPath.$picture);
                if ($filest['size'] > 2000000) {
                    unlink($destinationPath.$picture);
                    return ['error' => 'Kích thước file không được quá 2MB'];
                }
                $filesa['files'][] = $filest;
            }
            return $filesa;
        }
    }
    public function uploadVideo(Request $request)
    {
        $image_formats = ['mp4', 'webm', 'mkv', 'wmv', 'mpeg', 'mov', 'm4v', 'avi'];
        if (count($request->file('videos')) > 0) {
            $file = $request->file('videos');
            $object = trim($request->input('object', 'products'), '');
            foreach($file as $files) {
                $extension = $files->getClientOriginalExtension();
                if (!in_array(strtolower($extension), $image_formats)) {
                    return ['error' => 'Định dạng tải lên phải là video'];
                }

                $filename = $files->getClientOriginalName();
                $picture = sha1($filename . time()) . '.' . $extension;

                /**
                 * Path to the 'public' folder
                 */
                $path_image_video = 'tmp/'.$object.'/videos/';
                $path_image_video .= date("Y/m/d/");

                $path_video = public_path($path_image_video);

                // tao thu muc
                if (! is_dir ( $path_video )) {
                    mkdir ( $path_video, 0777, true );
                    if( chmod($path_video, 0777) ) {
                        // more code
                        chmod($path_video, 0755);
                    }
                }

                $destinationPathVideo = $path_video;

                $files->move($destinationPathVideo, $picture);

                $filest = array();
                $filest['file_name'] = pathinfo($filename,PATHINFO_FILENAME);
                $filest['name'] = $path_image_video.$picture;
                $filest['size'] = $this->get_file_size($destinationPathVideo.$picture);
                if ($filest['size'] > 204800000) {
                    unlink($destinationPathVideo.$picture);
                    return ['error' => 'Kích thước file không được quá 200MB'];
                }
                $filesa['files'][] = $filest;
            }
            return $filesa;
        }
    }

    public function uploadTempImgOld(Request $request)
    {
        $image_formats = ['jpg', 'jpeg', 'png'];
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $object = trim($request->input('object', 'products'), '');

            foreach($file as $files) {
                $extension = $files->getClientOriginalExtension();
                if (!in_array(strtolower($extension), $image_formats)) {
                    return ['error' => 'Định dạng phải nằm trong các format sau đây: jpeg, jpg, png'];
                }
                $filename = $files->getClientOriginalName();
                $picture = sha1($filename . time()) . '.' . $extension;

                /**
                 * Path to the 'public' folder
                 */
                $path_image = 'tmp/'.$object.'/';

                $path = public_path($path_image);

                // tao thu muc
                if (! is_dir ( $path )) {
                    mkdir ( $path, 0777, true );
                    if( chmod($path, 0777) ) {
                        // more code
                        chmod($path, 0755);
                    }
                }
                //specify your folder

                $destinationPath = $path;

                $files->move($destinationPath, $picture);
                $filest = array();
                $filest['file_name'] = pathinfo($filename,PATHINFO_FILENAME);
                $filest['name'] = $path_image.$picture;
                $filest['size'] = $this->get_file_size($destinationPath.$picture);
                if ($filest['size'] > 2000000) {
                    unlink($destinationPath.$picture);
                    return ['error' => 'Kích thước file không được quá 2MB'];
                }
                $filesa['files'][] = $filest;
            }

            return $filesa;
        }
    }

    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $object = trim($request->input('object', 'products'), '');

            foreach($file as $files) {
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                //$picture = sha1($filename . time()) . '.' . $extension;
                $filename = pathinfo($filename,PATHINFO_FILENAME) . time();
                $picture =  $filename . '.' . $extension;


                $path_image = 'tmp/'.$object.'/';
                $path = public_path($path_image);

                // tao thu muc
                if (! is_dir ( $path )) {
                    mkdir ( $path, 0777, true );
                    if( chmod($path, 0777) ) {
                        // more code
                        chmod($path, 0755);
                    }
                }
                //specify your folder

                $destinationPath = $path;
                $files->move($destinationPath, $picture);
//                $destinationPath1='http://'.$_SERVER['HTTP_HOST'].'/files_clients/' .$folder[0]->folder. '/';
                $filest = array();
                $filest['file_name'] = $filename;
                $filest['name'] = $path_image.$picture;
                $filest['size'] = $this->get_file_size($destinationPath.$picture);
//                $filest['url'] = $destinationPath1.$picture;
//                $filest['thumbnailUrl'] = $destinationPath1.$picture;
                $filesa['files'][] = $filest;
            }

            return $filesa;
        }
    }

    // add more customized code available at https://github.com/blueimp/jQuery-File-Upload
    // in https://github.com/blueimp/jQuery-File-Upload/blob/master/server/php/UploadHandler.php
    /*
     * jQuery File Upload Plugin PHP Class
     * https://github.com/blueimp/jQuery-File-Upload
     *
     * Copyright 2010, Sebastian Tschan
     * https://blueimp.net
     *
     * Licensed under the MIT license:
     * http://www.opensource.org/licenses/MIT
     */
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

    public function checkfile($check_file){
        $check = ['jpeg','jpg','bmp','png','gif'];
        if (in_array($check_file, $check)){
            return true;
        }
        return false;
    }

    public function summernote_file_upload(Request $request)
    {

        if (!file_exists('static/editor-image')) {
            mkdir('static/editor-image', 0777, true);
        }
        $files = $request->files;
        $image_url = [];
        foreach ($files as $file) {
            foreach ($file as $k => $f) {
                if ($this->checkfile($f->getClientOriginalExtension())){
                    $filename = $f->getClientOriginalName();
                    $extension = $f->getClientOriginalExtension();
                    $picture = sha1($filename . time()) . '.' . $extension;

                    $f->move('static/editor-image/', $picture);
                    $image_url[$k] = asset('static/editor-image/' . $picture);
                }

            }
        }

        return response()->json($image_url);
    }

    public function downloadFile(Request $request){
        $dir = public_path($request->fileName);
        $ext = pathinfo($dir, PATHINFO_EXTENSION);
        if(file_exists($dir)){
            if($ext == "pdf"){
                $headers = array(
                    'Content-Type: application/pdf',
                );
            }else{
                $headers = array(
                    'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                );
            }
            return \Response::download($dir, $request->name, $headers);
        }

    }
}

