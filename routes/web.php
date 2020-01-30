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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::post('copy_element', 'Voyager\VoyagerController@copy')->name('admin.copy');
});

Auth::routes();

$locale = \Illuminate\Support\Facades\App::getLocale();
if($locale == 'pl') $locale = '';
Route::group(['prefix' => $locale], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/colors','HomeController@getColors');
    Route::get('/', 'HomeController@index')->name('home');
    /*Route::get('/strona/{slug}', 'PageController@show')->name('page');*/
    Route::get('/configs', 'BagConfigController@index');
    Route::post('/sendEmail', 'HomeController@sendEmail');
    Route::get('refresh_cache', function (){
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return back()->with(['message' => 'Odświeżono poprawnie']);
    })->name('refresh');
    Route::get('/{slug}', 'PageController@show')->name('page')->where('slug', '.*');
    /*->where('slug', '.*')*/
});

