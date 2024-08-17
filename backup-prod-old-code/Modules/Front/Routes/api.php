<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1'], function () {
    Route::group(['prefix' => 'common',], function () {
        Route::get('/', 'CommonController@index');
        Route::get('/get-country', 'CommonController@getCountry');
        Route::get('/get-ranking', 'CommonController@getRanking');
        Route::get('/get-level', 'CommonController@getLevel');
        Route::get('/get-city-by-country', 'CommonController@getCityByCountry');
        Route::get('/get-major', 'CommonController@getMajor');
        Route::get('/list-content-tiktok', 'CommonController@getListContentTikTok')->name('api_content_tiktok');
        Route::post('/save-content-tiktok', 'CommonController@saveContentTikTok')->name('api_content_tiktok_save');
    });
    Route::group(['prefix' => 'school',], function () {
        Route::get('/', 'Api\SchoolController@index');
        Route::get('/get-detail/{slug}', 'Api\SchoolController@getDetail');
        Route::get('/filter-school', 'Api\SchoolController@filterSchool');
        Route::get('/add-compare-school', 'Api\SchoolController@addCompareSchool');
        Route::get('/list-compare-school', 'Api\SchoolController@listCompare');
        Route::get('/remove-compare-school', 'Api\SchoolController@removeCompare');
        Route::post('/survey', 'Api\SchoolController@surveySchool');
    });
    Route::group(['prefix' => 'blog',], function () {
        Route::get('/', 'Api\BlogController@index');
        Route::get('/get-detail/{slug}', 'Api\BlogController@getDetail');
        Route::get('/get-event', 'Api\BlogController@getListEvent');
        Route::get('/get-category', 'Api\BlogController@getListCategory');
    });
    Route::group([
        'prefix'     => 'auth'
    ], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signUp', 'Api\AuthController@signUp');
    });
    Route::post('upload-temp', 'Api\UploadController@uploadTmp');
    Route::group([
        'prefix'     => 'profile',
        'middleware' => 'api'
    ], function () {
        Route::get('get-profile', 'Api\UserController@getProfile');
        Route::post('update-profile', 'Api\UserController@updateProfile');
        Route::post('save-profile-file', 'Api\UserController@saveProfileFile');
        Route::get('/process-course-by-school', 'Api\UserController@processCourseBySchool');
        Route::get('/follow-profile-user', 'Api\UserController@followProfile');
        Route::get('/profile-detail/{id}', 'Api\UserController@detailProfile');
        Route::get('/school-wishlist', 'Api\UserController@listWishlistSchool');
        Route::get('/add-school-wishlist', 'Api\UserController@addWishlistSchool');
        Route::get('/remove-school-wishlist/{school_id}', 'Api\UserController@removeWishlistSchool');
        Route::post('/update-information-study-aboard', 'Api\UserController@updateInformationStudyAboard');
    });
});
