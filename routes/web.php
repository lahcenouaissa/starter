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

Route::get('/', function () {
    return view('welcome');
});

//Route::get("home","HomeController@index");

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



Route::get('/fillable', 'CrudController@getOffers')->middleware('auth');



Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');


Route::group(['prefix'=>'offers'],function (){
//    Route::get('store','CrudController@store');
    Route::get('create','CrudController@create')->middleware('auth');
    Route::post('store','CrudController@store')->middleware('auth')->name('offer.store');

});
