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
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {

    $moduleName = "adminauth";

    $prefix = "roles";
    $controllerName = "role";
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function() use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::post('add-users', $controller . 'add_users')->name('add-users')->middleware('can:'.$moduleName.'::'.$controllerName.'.add_users');
        Route::delete('/{role_id}/remove-user/{user_id}', $controller . 'remove_user')->name('remove-user')->middleware('can:'.$moduleName.'::'.$controllerName.'.remove_user');
        Route::get('/', $controller . 'getShowAll')->name('getShowAll')->middleware('can:'.$moduleName.'::'.$controllerName.'.getShowAll');
        Route::get('ajax-data', $controller . 'getAjaxData')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.getShowAll');
        Route::get('add', $controller . 'getAdd')->name('add')->middleware('can:'.$moduleName.'::'.$controllerName.'.postAdd');
        Route::get('detail/{id}', $controller . 'detail')->name('detail')->middleware('can:'.$moduleName.'::'.$controllerName.'.detail');
        Route::post('add', $controller . 'postAdd')->middleware('can:'.$moduleName.'::'.$controllerName.'.postAdd');
        Route::get('edit/{id}', $controller . 'getEdit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.postEdit');
        Route::post('edit/{id}', $controller . 'postEdit')->middleware('can:'.$moduleName.'::'.$controllerName.'.postEdit');
        Route::delete('delete/{id}', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.destroy');
    });

    $prefix = "users";
    $controllerName = "user";
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function() use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::post('/delete', $controller . 'delete')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
        Route::get('/profile', $controller . 'profile')->name('profile')->middleware('can:'.$moduleName.'::'.$controllerName.'.profile');
        Route::post('/profile', $controller . 'profile_update')->name('profile_update')->middleware('can:'.$moduleName.'::'.$controllerName.'.profile_update');
        Route::get('/change-password', $controller . 'change_password')->name('change-password')->middleware('can:'.$moduleName.'::'.$controllerName.'.change_password');
        Route::post('/change-password', $controller . 'change_password_store')->name('change_password_store')->middleware('can:'.$moduleName.'::'.$controllerName.'.change_password');
        Route::get('/reset-password/{id}', $controller . 'showResetPassword')->name('show-reset-password')->middleware('can:'.$moduleName.'::'.$controllerName.'.reset_password');
        Route::post('/reset-password/{id}', $controller . 'postResetPassword')->name('postResetPassword')->middleware('can:'.$moduleName.'::'.$controllerName.'.reset_password');
        Route::post('/get-combogrid-data', $controller . 'getCombogridData')->name('get-combogrid-data')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
    });
    $prefix = "student";
    $controllerName = "student";
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function() use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::post('/delete', $controller . 'delete')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
        Route::get('/profile', $controller . 'profile')->name('profile')->middleware('can:'.$moduleName.'::'.$controllerName.'.profile');
        Route::post('/profile', $controller . 'profile_update')->name('profile_update')->middleware('can:'.$moduleName.'::'.$controllerName.'.profile_update');
        Route::get('/change-password', $controller . 'change_password')->name('change-password')->middleware('can:'.$moduleName.'::'.$controllerName.'.change_password');
        Route::post('/change-password', $controller . 'change_password_store')->name('change_password_store')->middleware('can:'.$moduleName.'::'.$controllerName.'.change_password');
        Route::get('/reset-password/{id}', $controller . 'showResetPassword')->name('show-reset-password')->middleware('can:'.$moduleName.'::'.$controllerName.'.reset_password');
        Route::post('/reset-password/{id}', $controller . 'postResetPassword')->name('postResetPassword')->middleware('can:'.$moduleName.'::'.$controllerName.'.reset_password');
        Route::post('/get-combogrid-data', $controller . 'getCombogridData')->name('get-combogrid-data')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
    });

    $prefix = "profile";
    $controllerName = "profile";
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function() use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index');
        Route::get('/search', $controller . 'search')->name('search');
        Route::get('/view/{id}', $controller . 'view')->name('view');
        Route::post('/view/{id}', $controller . 'postView')->name('postView');
        Route::get('/ho-so-du-hoc', $controller . 'study_broad_profile')->name('study_broad_profile');
    });

});
