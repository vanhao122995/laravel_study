<?php
/*
|--------------------------------------------------------------------------
| Routes Module Site
|--------------------------------------------------------------------------
*/
Route::get('/'                                  , "site\HomeController@index");
Route::get('san-pham.html'                      , "site\ProductController@index");
Route::get('san-pham/{slug}.html'               , "site\ProductController@category");
Route::get('chi-tiet-san-pham/{slug}.html'      , "site\ProductController@detail");
Route::get('tim-kiem.html'                      , "site\ProductController@search");
Route::group(['middleware' => ['site'], 'prefix' => 'order'], function () {
    Route::prefix('cart')->group(function() {
        Route::get('/'          , "site\OrderController@index");
        Route::match(
                        ['get', 'post'], 
                        'add/{id?}',
                        "site\OrderController@addCart"
                    )->where('id', '[0-9]+');
        Route::get('delete/{id}' , "site\OrderController@delete")->where('id', '[0-9]+');
        Route::post('update'     , "site\OrderController@update");
    });
    Route::post('checkout'          , "site\OrderController@postCheckout");
    Route::get('checkout'           , "site\OrderController@checkout");   
});

Route::get('login'      , 'site\CustomerController@login');
Route::post('login'     , 'site\CustomerController@postLogin');
Route::get('register'   , 'site\CustomerController@register');
Route::post('register'  , 'site\CustomerController@postRegister');
Route::get('message'  , 'site\CustomerController@message');

Route::group(['middleware' => ['site'], 'prefix' => 'customer'], function () {
    Route::get('/'              , "site\CustomerController@index");
    Route::post('checkout'      , "site\CustomerController@checkout");
    Route::get('logout'         , "site\CustomerController@logOut");
});
/*
|--------------------------------------------------------------------------
| Routes Module Admin
|--------------------------------------------------------------------------
*/
Route::get('admin/login', 'admin\UserController@login');
Route::post('admin/post-login', 'admin\UserController@postLogin');
$prefix_admin = 'admin';
Route::group(['middleware' => ['admin'], 'prefix' => $prefix_admin], function () {
    Route::get('/'          ,'admin\ProductController@index');
    Route::get('logout'     ,'admin\UserController@logOut');
    //route for banner
    $folder = 'admin';
    $prefix_controller = 'banner';
    $controller = $folder . '\\' . ucfirst($prefix_controller) . 'Controller@';
    Route::prefix($prefix_controller)->group(function () use ($controller){
        Route::get('/'                      , $controller . 'index');
        Route::get('/create'                , $controller . 'create');
        Route::get('/edit/{id}'             , $controller . 'edit')->where('id', '[0-9]+');   
        Route::post('/edit'                 , $controller . 'postEdit');     
        Route::get('/delete/{id}'           , $controller . 'delete')->where('id', '[0-9]+');
        Route::post('/delete-all'           , $controller . 'delete_all');
        Route::post('/store'                , $controller . 'store');
        Route::get('/status-{curent}/{id}'  , $controller . 'status')->where('id', '[0-9]+');
    });
    //route for product
    $folder = 'admin';
    $prefix_controller = 'product';
    $controller = $folder . '\\' . ucfirst($prefix_controller) . 'Controller@';
    Route::prefix($prefix_controller)->group(function () use ($controller){
        Route::get('/'                      , $controller . 'index');
        Route::get('/create'                , $controller . 'create');
        Route::get('/edit/{id}'             , $controller . 'edit')->where('id', '[0-9]+');   
        Route::post('/edit'                 , $controller . 'postEdit');     
        Route::get('/delete/{id}'           , $controller . 'delete')->where('id', '[0-9]+');
        Route::post('/delete-all'           , $controller . 'delete_all');
        Route::post('/store'                , $controller . 'store');
        Route::get('/status-{curent}/{id}'  , $controller . 'status')->where('id', '[0-9]+');
    });
    //route for category
    $folder = 'admin';
    $prefix_controller = 'category';
    $controller = $folder . '\\' . ucfirst($prefix_controller) . 'Controller@';
    Route::prefix($prefix_controller)->group(function () use ($controller){
        Route::get('/'                      , $controller . 'index');
        Route::get('/create'                , $controller . 'create');
        Route::get('/edit/{id}'             , $controller . 'edit')->where('id', '[0-9]+');   
        Route::post('/edit'                 , $controller . 'postEdit');     
        Route::get('/delete/{id}'           , $controller . 'delete')->where('id', '[0-9]+');
        Route::post('/delete-all'           , $controller . 'delete_all');
        Route::post('/store'                , $controller . 'store');
        Route::get('/status-{curent}/{id}'  , $controller . 'status')->where('id', '[0-9]+');
    });
    //route for order
    $folder = 'admin';
    $prefix_controller = 'order';
    $controller = $folder . '\\' . ucfirst($prefix_controller) . 'Controller@';
    Route::prefix($prefix_controller)->group(function () use ($controller){
        Route::get('/'                      , $controller . 'index');     
        Route::get('/delete/{id}'           , $controller . 'delete')->where('id', '[0-9]+');
        Route::post('/delete-all'           , $controller . 'delete_all');
        Route::get('/status-{curent}/{id}'  , $controller . 'status')->where('id', '[0-9]+');
        Route::get('detail/{id}'            , $controller . 'detail')->where('id', '[0-9]+');;
    });

    //route for customer
    $folder = 'admin';
    $prefix_controller = 'customer';
    $controller = $folder . '\\' . ucfirst($prefix_controller) . 'Controller@';
    Route::prefix($prefix_controller)->group(function () use ($controller){
        Route::get('/'                      , $controller . 'index');
        Route::get('/create'                , $controller . 'create');
        Route::get('/edit/{id}'             , $controller . 'edit')->where('id', '[0-9]+');   
        Route::post('/edit'                 , $controller . 'postEdit');     
        Route::get('/delete/{id}'           , $controller . 'delete')->where('id', '[0-9]+');
        Route::post('/delete-all'           , $controller . 'delete_all');
        Route::post('/store'                , $controller . 'store');
    });
    //route for user
    $folder = 'admin';
    $prefix_controller = 'user';
    $controller = $folder . '\\' . ucfirst($prefix_controller) . 'Controller@';
    Route::prefix($prefix_controller)->group(function () use ($controller){
        Route::get('/'                      , $controller . 'index');
        Route::get('/create'                , $controller . 'create');
        Route::get('/edit/{id}'             , $controller . 'edit')->where('id', '[0-9]+');   
        Route::post('/edit'                 , $controller . 'postEdit');     
        Route::get('/delete/{id}'           , $controller . 'delete')->where('id', '[0-9]+');
        Route::post('/delete-all'           , $controller . 'delete_all');
        Route::post('/store'                , $controller . 'store');
    });

});
