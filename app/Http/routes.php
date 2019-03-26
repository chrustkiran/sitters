<?php
Route::
get('/', function () {
    return view('welcome');
});


Route::get('/login', 'MainController@index');
Route::get('verifyEmail/{username}', 'MainController@verifyEmail');
Route::post('verifyCode', 'MainController@verifyCode');
Route::post('/login/checklogin', 'MainController@checklogin');
Route::get('main/customers/home', 'HomeController@showHome');

Route::get('/main/guest/home', 'HomeController@showHome');
Route::get('main/logout', 'MainController@logout');
Route::get('/register', 'MainController@register');
Route::post('/register/createuser', 'MainController@createUser');

Route::post('main/guest/filter', 'HomeController@filtering');

Route::get('main/sitters/home', 'SittersController@showHome');
Route::post('main/sitters/filter', 'SittersController@filtering');
Route::get('main/sitters/advertisement', 'SittersController@showAdvertise');
Route::post('main/sitters/createad', 'SittersController@createAd');
Route::post('main/sitters/editAd', 'SittersController@editAd');
Route::get('main/sitters/deleteAd/{id}','SittersController@deleteAd');
Route::get('main/sitters/expire/{id}','SittersController@expire');

Route::get('main/customers/profile', 'HomeController@showProfile');

Route::get('createcaptcha', 'MainController@createCaptcha');
Route::post('captcha', 'MainController@captchaValidate');
Route::get('refreshcaptcha', 'MainController@refreshCaptcha');

?>
