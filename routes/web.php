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

//Route::get('/', function () {
//    return view('index');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Admin Routes
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){

    //admin authentication
    Route::group(['namespace' => 'Auth'],function (){
        Route::get('login','adminsauthenticationcontroller@login')->name('admin.login');
        Route::post('login','adminsauthenticationcontroller@postlogin')->name('admin.postLogin');
        Route::post('logout','adminsauthenticationcontroller@logout')->middleware('admin','auth:admin')->name('admin.logout');
    });


    Route::group(['middleware' =>['auth:admin'],'admin'],function (){
        Route::get('/','admincontroller@dashboard')->name('admin.dashboard');
        route::get('settings','admincontroller@settings')->name('admin.settings');
        route::post('check-current-password','admincontroller@checkcurrentpassword')->name('admin.check.currentpassword');
        route::post('update-password','admincontroller@updatepassword')->name('admin.update.password');
        route::get('update-admin-details','admincontroller@getupdateadmindetails')->name('get.updateAdminDetails');
        route::post('update-admin-details','admincontroller@postupdateadmindetails')->name('post.updateAdminDetails');
    });

});


//front routes
Route::group(['namespace'=>'Front'],function (){
    Route::get('/','frontController@index')->name('get.index');
    Route::get('contactUs','frontController@contactUs')->name('get.contactUs');
    Route::post('receive-email','MailController@sendEmail')->name('receive.email');
});



