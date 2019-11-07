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

Route::get('/', function () {
    return view('static_page/home');
});
Route::get('/help','StaticPageController@help')->name('help');
Route::get('/about','StaticPageController@about')->name('about');
Route::get("/home",'StaticPageController@home')->name('home');

Route::get('/signup','UserController@create')->name('signup');
Route::get('/signup/confirm/{token}','UserController@confirmEmail')->name('confirm_email'); //验证邮箱

Route::resource('users', 'UserController'); //资源路由 包括get post


Route::get('/login','SessionController@create')->name('login');  //展示页面
Route::post('/login','SessionController@store')->name('login');   //请求登录 不同方式不同路由
Route::delete('/logout','SessionController@destroy')->name('logout');


Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('statuses','StatusesController');


Route::resource('question','QuestionController'); //题库
Route::get('question/category/{category_id}','QuestionController@categoryList')->name('question_category');

Route::resource('category','QuestionCategoryController'); //题库分类


Route::get('/news/recommend','NewController@recommend');
Route::get('/news','NewController@list');
Route::get('/show/{id}','NewController@show');
