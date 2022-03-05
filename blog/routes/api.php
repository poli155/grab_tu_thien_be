<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Controller\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('profile', 'AuthController@getAuthUser');
    Route::put('profile', 'AuthController@updateProfile');
    Route::resources([
        'users' => 'UserController'
    ]);
    Route::get('selects/{id}', 'BlogController@showselect');
    Route::get('selects/blogs/{id}', 'BlogController@showselectbyblog');
    Route::get('choosenselects/blogs/{id}', 'BlogController@showchoosenselectbyblog');
    Route::post('selects/blogs/{id}', 'BlogController@addselect');
    Route::put('selects/{id}', 'BlogController@editselect');
    Route::put('selects/{id}/confirm', 'BlogController@confirmselect');
    Route::delete('selects/{id}', 'BlogController@deleteselect');
    Route::get('comments/{id}', 'BlogController@showcomment');
    Route::get('comments/blogs/{id}', 'BlogController@showcommentbyblog');
    Route::post('comments/blogs/{id}', 'BlogController@addcomment');
    Route::put('comments/{id}', 'BlogController@editcomment');
    Route::delete('comments/{id}', 'BlogController@deletecomment');
    Route::get('blogs/users/{id}', 'BlogController@showBlogByUser');
    Route::get('blogs/users/{id}/register', 'BlogController@showBlogWithSelect');
    Route::get('blogs/search/location/{location_id}/status/{status}/sort/{sort}', 'BlogController@searchBlog');
    Route::post('evaluate/helpers/selects/{id}', 'BlogController@evaluatehelper');
    Route::post('evaluate/customers/blogs/{id}', 'BlogController@evaluatecustomer');
    Route::get('points/users/{id}/blogs/{blog_id}', 'BlogController@getPointEvaluate');
    Route::get('points/blogs/{id}', 'BlogController@showpointbyblog');
    Route::get('points/users/{id}', 'BlogController@showpointbyuser');
    Route::get('points/{id}', 'BlogController@showpoint');
    Route::put('points/{id}', 'BlogController@editpoint');
    Route::get('stars/users/{id}/blogs/{blog_id}', 'BlogController@getStarEvaluate');
    Route::get('stars/users/{id}', 'BlogController@showstarbyuser');
    Route::get('stars/{id}', 'BlogController@showstar');
    Route::put('stars/{id}', 'BlogController@editstar');
    Route::resources([
        'blogs' => 'BlogController'
    ]);
});