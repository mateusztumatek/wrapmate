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


/* PAMENT LINKS */
    Route::post('tpay_confirm', 'OrderController@tpay_confirm')->name('tpay_confirm');
/* END PAYMENT LINKS */


$locale = \Illuminate\Support\Facades\App::getLocale();
if($locale == 'pl') $locale = '';
Route::group(['prefix' => $locale], function(){
    Route::get('/kontakt', 'HomeController@contact')->name('contact');
    Route::get('/bank_lists', 'OrderController@getBankLists');
    Route::get('/bank_image/{name}', function (Request $request){
        $tmp_path = 'https://secure.tpay.com/_/g/';
        $segments = \Illuminate\Support\Facades\Request::segments();
        $tmp = $segments[count($segments) - 1];
        try{
            if(file_exists(storage_path('/app/public/banks/'.$tmp))){
                $img = \Intervention\Image\Facades\Image::make(storage_path('app/public/banks/'.$tmp));
            }else{
                $img = \Intervention\Image\Facades\Image::make($tmp_path.$tmp);
                $img->save(storage_path('app/public/banks/'.$tmp));
            }
        }catch(Exception $e){
            $img = \Intervention\Image\Facades\Image::make(storage_path('/app/public/default/nophoto.png'));
            return $img->response();
        }
        header('Content-Type: image/png');
        return $img->response();
    });
    Route::get('/pliki', function (){
        $page = \App\Page::where('slug', 'pliki')->first();

       return view('iframe', compact('page'));
    });
    Route::post('/message', 'HomeController@message');
    Route::post('/upload/{path}', 'UploadController@upload');
    Route::resource('/orders', 'OrderController');
    Route::resource('elements', 'ElementController');
    Route::get('/kreator/', 'KreatorController@index')->name('creator');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    /*Route::get('/strona/{slug}', 'PageController@show')->name('page');*/
    Route::post('/sendEmail', 'HomeController@sendEmail');
    Route::get('refresh_cache', function (){
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return back()->with(['message' => 'Odświeżono poprawnie']);
    })->name('refresh');
    Route::get('/{slug}', 'PageController@show')->name('page')->where('slug', '.*');
    /*->where('slug', '.*')*/
});

