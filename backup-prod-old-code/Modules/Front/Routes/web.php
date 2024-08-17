<?php

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

Route::prefix('')->group(function() {
    Route::get('/', 'HomeController@index')->name('trang-chu');
    Route::get('tin-tuc', 'HomeController@news')->name('news');
    Route::get('lien-he', 'HomeController@contact')->name('contact');
    Route::get('/search-school', 'HomeController@search_school')->name('search_school');
    Route::get('/khao-sat', 'HomeController@survey')->name('survey');
    Route::get('/danh-sach-truong-sau-khao-sat', 'HomeController@survey_school')->name('survey_school');
    Route::post('/danh-sach-truong-sau-khao-sat', 'HomeController@survey_school')->name('survey_school.post');
    Route::post('/add-contacts', 'HomeController@create_contacts')->name('create_contacts');
    Route::get('/danh-sach-content', 'HomeController@getListTikTokContent')->name('list_content_titkok');

    Route::post('/post-login', 'Auth\LoginController@login')->name('front.login');
    Route::post('/post-register', 'Auth\LoginController@register')->name('front.register');
    Route::post('/post-logout', 'Auth\LoginController@logout')->name('front.logout');
    Route::post('/auth/reset-password', 'Auth\ResetPasswordController@sendmail')->name('front.sendmail');

    Route::prefix('')->middleware('auth')->group(function() {
        Route::get('/chinh-sua-thong-tin-ca-nhan', 'UserController@formProfile')->name('formProfile');
        Route::post('/chinh-sua-thong-tin-ca-nhan', 'UserController@postProfile')->name('postProfile');

        Route::get('/nop-ho-so', 'UserController@formNopHoSo')->name('formNopHoSo');
        Route::post('/cap-nhat-nop-ho-so', 'UserController@postNopHoSo')->name('postNopHoSo');
        Route::get('/nop-ho-so-ngay', 'UserController@nopHoSoNgay')->name('nopHoSoNgay');
        Route::get('/theo-doi-ho-so', 'UserController@theodoiHoSo')->name('theodoiHoSo');
        Route::get('/chi-tiet-ho-so/{id}', 'UserController@hosoDetail')->name('hosoDetail');
        Route::get('/quan-ly-ho-so', 'UserController@manageProfile')->name('manageProfile');
        Route::get('/add-wishlist', 'UserController@addWishlist')->name('addWishlist');
        Route::get('/truong-yeu-thich', 'UserController@listWishlist')->name('listWishlist');
        Route::get('/remove-wishlist/{id}', 'UserController@removeWishlist')->name('removeWishlist');
        Route::get('/thay-doi-mat-khau', 'UserController@changePassWord')->name('changePassWord');
        Route::post('/thay-doi-mat-khau', 'UserController@changePassWord')->name('changePassWord.post');
        Route::get('/cap-nhat-thong-tin-du-hoc', 'HomeController@study_abroad_information')->name('study_abroad_information');
        Route::post('/cap-nhat-thong-tin-du-hoc', 'HomeController@study_abroad_information')->name('study_abroad_information.post');
    });
    Route::get('/dieu-khoan-chinh-sach', 'HomeController@dieukhoan')->name('dieukhoan');
    Route::get('/export-pdf', 'HomeController@exportPDF')->name('exportPDF');
    Route::get('/them-so-sanh', 'HomeController@addCompare')->name('addCompare');
    Route::get('/so-sanh-truong', 'HomeController@listCompare')->name('listCompare');
    Route::get('/xoa-so-sanh', 'HomeController@removeCompare')->name('removeCompare');
    Route::get('/chi-tiet-tin-tuc/{slug}', 'HomeController@details_news')->name('details_news');
    Route::get('/tin-tuc/{id}', 'HomeController@getBlogByCategory')->name('getBlogByCategory');
    Route::get('/chi-tiet-truong/{slug}', 'HomeController@details_school')->name('details_school');
    Route::get('/gioi-thieu', 'HomeController@introduce')->name('introduce');
    Route::get('/lien-he', 'HomeController@contactPage')->name('contactPage');
    Route::get('/quoc-gia-du-hoc/{slug?}', 'HomeController@studyAbroad')->name('studyAbroad');
    Route::get('/cac-truong-dai-hoc/{slug}', 'HomeController@truongdaihoc')->name('truongdaihoc');
    Route::get('/chuong-trinh-hoc-bong/{slug}', 'HomeController@chuongtrinhhocbong')->name('chuongtrinhhocbong');
    Route::get('/cac-nganh-hoc/{slug}', 'HomeController@cacnganhhoc')->name('cacnganhhoc');
    Route::get('/cac-thanh-pho/{slug}', 'HomeController@cacthanhpho')->name('cacthanhpho');
    Route::get('/tin-tuc-du-hoc/{slug}', 'HomeController@tintucducho')->name('tintucducho');
});

Route::group(['prefix' => 'location'], function () {
    Route::get('/', '\Modules\Admin\Http\Controllers\LocationController@index')->name('admin::location.index');
    Route::get('get-provinces', '\Modules\Admin\Http\Controllers\LocationController@get_provinces');
    Route::get('get-districts', '\Modules\Admin\Http\Controllers\LocationController@get_districts');
    Route::get('list-districts', '\Modules\Admin\Http\Controllers\LocationController@getAllDistricts')->name('admin::location.districts');
    Route::get('get-wards', '\Modules\Admin\Http\Controllers\LocationController@get_wards');
    Route::get('get-country', '\Modules\Admin\Http\Controllers\LocationController@get_country');
    Route::get('get-city', '\Modules\Admin\Http\Controllers\LocationController@get_city');
});
