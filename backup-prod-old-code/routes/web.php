<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$namespace = "App\\Http\\Controllers\\";
Route::group(['middleware' => ['auth'] ], function () use ($namespace){
    Route::post('upload', $namespace.'UploadController@index')->name('upload');
    Route::post('upload-temp', $namespace.'UploadController@uploadTempImg')->name('upload-temp');
    Route::post('upload-contract-form', $namespace.'UploadController@uploadContractForm')->name('upload-contract-form');
    Route::post('upload-video', $namespace.'UploadController@uploadVideo')->name('upload-video');
    Route::post('upload-temp-all-file', $namespace.'UploadController@uploadTemp')->name('upload-temp-all-file');
    Route::post('summer-note-file-upload', $namespace.'UploadController@summernote_file_upload')->name('summerNoteFileUpload');
    Route::get('download-file', $namespace.'UploadController@downloadFile')->name('downloadFile');
});
