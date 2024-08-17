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

Route::group(['middleware' => ['web', 'auth','authadmin'], 'prefix' => 'admin'], function()
{
    $moduleName = "admin";
    Route::get('/', 'AdminController@index')->name('admin::dashboard.index');

    /* === Banners === */
    $prefix = "banners";
    $controllerName = "banner"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::post('delete', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
        Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
        Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
        Route::get('/{type}', $controller . 'index')->name('type')->where([
            'type' => '[a-z\-0-9]+'
        ])->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
    });

     /* === Level course === */
     $prefix = "levelCourse";
     $controllerName = "levelCourse"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
         Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
         Route::post('/search', $controller . 'search')->name('search.post')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
         Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
         Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
         Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
         Route::post('delete', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
         Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
     });
     /* ===  Course === */
     $prefix = "course";
     $controllerName = "course"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
         Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
         Route::post('/search', $controller . 'search')->name('search.post')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
         Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
         Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
         Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
         Route::post('delete', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
         Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
         Route::post('/import', $controller . 'import')->name('import');
     });
     /* ===  Major === */
     $prefix = "majors";
     $controllerName = "majors"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index');
         Route::get('/search', $controller . 'search')->name('search');
         Route::post('/search', $controller . 'search')->name('search.post');
         Route::get('/create', $controller . 'create')->name('create');
         Route::post('/create', $controller . 'store')->name('store');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit');
         Route::post('/edit/{id}', $controller . 'update')->name('update');
         Route::post('delete', $controller . 'destroy')->name('delete');
         Route::post('/active', $controller . 'active')->name('active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive');
     });
     /* ===  Ranking === */
     $prefix = "ranking";
     $controllerName = "ranking"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index');
         Route::get('/search', $controller . 'search')->name('search');
         Route::post('/search', $controller . 'search')->name('search.post');
         Route::get('/create', $controller . 'create')->name('create');
         Route::post('/create', $controller . 'store')->name('store');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit');
         Route::post('/edit/{id}', $controller . 'update')->name('update');
         Route::post('delete', $controller . 'destroy')->name('delete');
         Route::post('/active', $controller . 'active')->name('active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive');
     });
     /* ===  Country === */
     $prefix = "country";
     $controllerName = "country"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index');
         Route::get('/search', $controller . 'search')->name('search');
         Route::post('/search', $controller . 'search')->name('search.post');
         Route::get('/create', $controller . 'create')->name('create');
         Route::post('/create', $controller . 'store')->name('store');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit');
         Route::post('/edit/{id}', $controller . 'update')->name('update');
         Route::post('delete', $controller . 'destroy')->name('delete');
         Route::post('/active', $controller . 'active')->name('active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive');
     });
    /* ===  City === */
    $prefix = "city";
    $controllerName = "city"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index');
        Route::get('/search', $controller . 'search')->name('search');
        Route::post('/search', $controller . 'search')->name('search.post');
        Route::get('/create', $controller . 'create')->name('create');
        Route::post('/create', $controller . 'store')->name('store');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit');
        Route::post('/edit/{id}', $controller . 'update')->name('update');
        Route::post('delete', $controller . 'destroy')->name('delete');
        Route::post('/active', $controller . 'active')->name('active');
        Route::post('/inactive', $controller . 'inactive')->name('inactive');
    });
     /* ===  Study Abroad  === */
     $prefix = "studyAbroad";
     $controllerName = "studyAbroad"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index');
         Route::get('/search', $controller . 'search')->name('search');
         Route::post('/search', $controller . 'search')->name('search.post');
         Route::get('/create', $controller . 'create')->name('create');
         Route::post('/create', $controller . 'store')->name('store');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit');
         Route::post('/edit/{id}', $controller . 'update')->name('update');
         Route::post('delete', $controller . 'destroy')->name('delete');
         Route::post('/active', $controller . 'active')->name('active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive');
     });
     /* ===  Menus === */
     $prefix = "menus";
     $controllerName = "menus"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index');
         Route::get('/search', $controller . 'search')->name('search');
         Route::post('/search', $controller . 'search')->name('search.post');
         Route::get('/create', $controller . 'create')->name('create');
         Route::post('/create', $controller . 'store')->name('store');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit');
         Route::post('/edit/{id}', $controller . 'update')->name('update');
         Route::post('delete', $controller . 'destroy')->name('delete');
         Route::post('/active', $controller . 'active')->name('active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive');
     });
     /* ===  School === */
     $prefix = "school";
     $controllerName = "school"; // key dùng để phân quyền
     Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
         $controller = ucfirst($controllerName) . "Controller@";
         Route::get('/', $controller . 'index')->name('index');
         Route::get('/search', $controller . 'search')->name('search');
         Route::post('/search', $controller . 'search')->name('search.post');
         Route::get('/create', $controller . 'create')->name('create');
         Route::post('/create', $controller . 'store')->name('store');
         Route::get('/edit/{id}', $controller . 'edit')->name('edit');
         Route::post('/edit/{id}', $controller . 'update')->name('update');
         Route::post('delete', $controller . 'destroy')->name('delete');
         Route::post('/active', $controller . 'active')->name('active');
         Route::post('/inactive', $controller . 'inactive')->name('inactive');
        Route::post('/addGallery', $controller . 'addGallery')->name('addGallery');
     });

    Route::group(['prefix' => 'location'], function () {
        Route::get('/', 'LocationController@index')->name('admin::location.index');
        Route::get('get-provinces', 'LocationController@get_provinces');
        Route::get('get-districts', 'LocationController@get_districts');
        Route::get('list-districts', 'LocationController@getAllDistricts')->name('admin::location.districts');
        Route::get('get-wards', 'LocationController@get_wards');
        Route::get('get-country', 'LocationController@get_country');
        Route::get('get-city', 'LocationController@get_city');
    });

    /* === Category news === */
    $prefix = "categoryNew";
    $controllerName = "categoryNew"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::delete('delete/{id}', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
        Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
        Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
    });
    /* === News === */
    $prefix = "news";
    $controllerName = "news"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        Route::delete('delete', $controller . 'delete')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
        Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
        Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
    });

    /* === Setting === */
    $prefix = "setting";
    $controllerName = "setting";
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function() use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('/meta-seo', $controller . 'metaSeo')->name('meta-seo')->middleware('can:'.$moduleName.'::'.$controllerName.'.meta-seo');
        Route::post('/meta-seo', $controller . 'storeMetaSeo')->name('storeMetaSeo')->middleware('can:'.$moduleName.'::'.$controllerName.'.meta-seo-update');
        Route::get('/vimeo', $controller . 'vimeo')->name('vimeo')->middleware('can:'.$moduleName.'::'.$controllerName.'.vimeo');
        Route::post('/vimeo', $controller . 'storeVimeo')->name('storeVimeo')->middleware('can:'.$moduleName.'::'.$controllerName.'.vimeo-update');
        Route::post('add', $controller . 'store')->name('add')->middleware('can:'.$moduleName.'::'.$controllerName.'.add');
    });

    Route::prefix('landing-page')->group(function() use ($controllerName, $moduleName) {
        /* === Landing page position === */
        $prefix = "landingPagePosition";
        $controllerName = "landingPagePosition"; // key dùng để phân quyền
        Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
            $controller = ucfirst($controllerName) . "Controller@";
            Route::get('/{landing_page_id}/position/{position_id?}', $controller . 'index')
                ->where([
                    'landing_page_id' => '[0-9]+',
                    'position_id' => '[0-9]+',
                ])
                ->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
            Route::get('/search-relationship', $controller . 'search')->name('search-relationship')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
            Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
            Route::post('/store-all', $controller . 'storeAll')->name('store-all')->middleware('can:'.$moduleName.'::'.$controllerName.'.storeAll');
            Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
            Route::post('{position_id}', $controller . 'update')
                ->where([
                    'position_id' => '[0-9]+',
                ])
                ->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
            Route::delete('delete/{id}', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
            Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
            Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
        });

        // $prefix = "faqs";
        // $controllerName = "faqs"; // key dùng để phân quyền
        // Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        //     $controller = ucfirst($controllerName) . "Controller@";
        //     Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        //     Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        //     Route::get('/create', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        //     Route::post('/create', $controller . 'store')->name('store')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        //     Route::get('/edit/{id}', $controller . 'edit')->name('edit')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        //     Route::post('/edit/{id}', $controller . 'update')->name('update')->middleware('can:'.$moduleName.'::'.$controllerName.'.update');
        //     Route::delete('delete', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
        //     Route::post('/active', $controller . 'active')->name('active')->middleware('can:'.$moduleName.'::'.$controllerName.'.active');
        //     Route::post('/inactive', $controller . 'inactive')->name('inactive')->middleware('can:'.$moduleName.'::'.$controllerName.'.inactive');
        // });
    });
    /* === Contact === */
    $prefix = "contacts";
    $controllerName = "contacts"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::get('create_contacts', $controller . 'create')->name('create')->middleware('can:'.$moduleName.'::'.$controllerName.'.create');
        Route::get('/search', $controller . 'search')->name('search')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::post('/search', $controller . 'search')->name('search.post')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
        Route::delete('delete/{id}', $controller . 'destroy')->name('delete')->middleware('can:'.$moduleName.'::'.$controllerName.'.delete');
    });
    /* === Contact === */
    $prefix = "province";
    $controllerName = "province"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index')->middleware('can:'.$moduleName.'::'.$controllerName.'.index');
    });

    /* === widget === */
    $prefix = "widget";
    $controllerName = "widget"; // key dùng để phân quyền
    Route::prefix($prefix)->name($moduleName .'::' . $controllerName . ".")->group(function () use ($controllerName, $moduleName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/', $controller . 'index')->name('index');
        Route::get('/search', $controller . 'search')->name('search');
        Route::post('/search', $controller . 'search')->name('search.post');
        Route::get('/create', $controller . 'create')->name('create');
        Route::post('/create', $controller . 'store')->name('store');
        Route::get('/edit/{id}', $controller . 'edit')->name('edit');
        Route::post('/edit/{id}', $controller . 'update')->name('update');
        Route::post('delete', $controller . 'destroy')->name('delete');
        Route::post('/active', $controller . 'active')->name('active');
        Route::post('/inactive', $controller . 'inactive')->name('inactive');
    });
});

