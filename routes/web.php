<?php

use App\Http\Controllers\FileManagerController;
use Illuminate\Support\Facades\Auth;
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

Route::get('clear_cache', function () {
    \Artisan::call('config:cache');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    dd("Cache is cleared");
});


Route::get('/login', 'LoginController@index')->name('login')->middleware(['guest']);
Route::post('/login', 'LoginController@store')->name('login.store')->middleware(['guest']);
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware(['auth']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware'=>['auth']],function (){
    Route::get('/edit-profile','UserController@editProfile')
        ->name('edit.profile');
    Route::put('/edit-profile','UserController@storeEditProfile')
        ->name('store.edit.profile');
});
Route::group(['prefix' => 'albums'], function () {
    Route::get('/get-architect', 'AdminController@getArchitectForAlbum')
        ->name('get.architect.forAlbum')->middleware(['admin']);
    Route::get('/', 'AlbumController@getAlbums')
        ->name('get.albums');
    Route::get('/{id}/{slut}', 'AlbumController@showImages')
        ->name('get.album.images');
    Route::get('/define-album', 'AlbumController@defineAlbum')
        ->name('defineAlbum')->middleware('admin');
    Route::group(['prefix'=>'/admin' , 'middleware' => ['admin']],function (){
        Route::delete('/delete-image/{id}', 'AlbumController@deleteAlbumImage')
            ->name('delete.album.image');
        Route::post('/store-album', 'AlbumController@storeAlbum')
            ->name('store.album');
        Route::get('/add-images/{album}', 'AlbumController@addImagesToAlbum')
            ->name('addImagesToAlbum');
        Route::post('/add-images', 'AlbumController@storeImages')
            ->name('store.albumImages');
    });

});

/** prefix admin */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/define-architect', 'AdminController@defineArchitect')
        ->name('define.architect');
    Route::post('/define-architect', 'AdminController@storeArchitect')
        ->name('store.architect');
    Route::get('/detail-architect', 'AdminController@detailArchitect')
        ->name('detail.architect');
    Route::get('/architects-list','AdminController@architectsList')
        ->name('architects.list');
    Route::get('/architect/{id}','AdminController@singleArchitect')
        ->name('admin.singleArchitect');

    Route::group(['prefix' => 'albums'], function () {
//        Route::get('/get-architect', 'AdminController@getArchitectForAlbum')
//            ->name('get.architect.forAlbum');
        Route::get('/get', 'AdminController@getAlbumsForAdmin')
            ->name('get.albums.forAdmin');
    });
    Route::group(['prefix' => '/edit-architect'], function () {
        Route::get('/password/{id}', 'AdminController@editArchitectPassword')
            ->name('architect.password');
        Route::post('/store-password', 'AdminController@storeArchitectPassword')
            ->name('store.architect.password');
    });

});

Route::group(['prefix' => 'architect', 'middleware' => ['auth', 'architect']], function () {
    Route::get('/define-customer/{id?}/{password?}', 'ArchitectController@defineCustomer')
        ->name('define.customer');
    Route::post('/define-customer', 'ArchitectController@storeCustomer')
        ->name('store.customer');
    Route::get('/customers','ArchitectController@totalCustomers')
        ->name('total.customers');

    Route::group(['prefix' => '/edit-customer'], function () {
        Route::get('/', 'ArchitectController@editCustomerPassword')->name('customer.password');
        Route::post('/store', 'ArchitectController@storeCustomerPassword')->name('store.customer.password');
    });
    Route::get('get.album.accessible/{id}', 'AlbumController@albumAccessible')
        ->name('set.album.accessible');
    Route::post('/store-set-accessible/{albumId}','AlbumController@storeAlbumAccessible')
        ->name('store.album.accessible');
    Route::get('get.customer.accessible/{id}', 'AlbumController@customerAccessible')
        ->name('set.customer.accessible');
    Route::post('/store-customer-accessible/{customerId}','AlbumController@storeCustomerAccessible')
        ->name('store.customer.accessible');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'customer']], function () {
    Route::group(['prefix' => 'cart'], function () {
        Route::post('/add','CartController@create')
            ->name('cart.create');
        Route::get('/show','CartController@show')
            ->name('carts.show');
        Route::delete('/destroy/{id}','CartController@delete')
            ->name('cart.delete');
    });
});
Route::get('/total-orders','OrderController@total')
    ->name('total.orders');
Route::group(['prefix' => 'orders', 'middleware' => ['auth']], function () {
    Route::get('/{id}','OrderController@show')
        ->name('order.show');

    Route::delete('/delete/{id}','OrderController@delete')
        ->name('order.delete')->middleware('customer');
    Route::group(['prefix' => '/submit','middleware'=>['customer']], function () {
        Route::get('/form','OrderController@create')
            ->name('order.create');
        Route::post('/store','OrderController@store')
            ->name('order.store');
    });
    Route::group(['prefix' => 'admin','middleware'=>['admin']], function () {
        Route::get('/total/{type}','OrderController@getOrders')
            ->name('orders.get');
        Route::put('/submit/{id}','OrderController@submit')
            ->name('order.submit');
    });

});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
