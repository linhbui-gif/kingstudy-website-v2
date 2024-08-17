<?php
namespace Modules\Front\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\Controller;
use Modules\Front\Traits\UploadFile;
class UploadController extends Controller {
    use UploadFile;
    public function uploadTmp(Request $request) {
        $format = ['jpg', 'jpeg', 'png','svg','webp','pdf','docx'];
        return $this->uploadFileTmp($request, $format);
    }
}
