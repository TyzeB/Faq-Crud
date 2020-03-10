<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/faq/add', ['as' => 'faq.add', 'uses' => 'FAQController@store'])->middleware(['auth:api', 'scopes:add-faq']);
Route::post('/faq/edit/{faq}', ['as' => 'faq.edit', 'uses' => 'FAQController@update'])->middleware(['auth:api', 'scopes:edit-faq']);
Route::post('/faq/delete/{faq}', ['as' => 'faq.delete', 'uses' => 'FAQController@destroy'])->middleware(['auth:api', 'scopes:delete-faq']);
Route::post('/category/add', ['as' => 'category.add', 'uses' => 'CategoryController@store'])->middleware(['auth:api', 'scopes:add-category']);
Route::post('/category/edit/{category}', ['as' => 'category.edit', 'uses' => 'CategoryController@update'])->middleware(['auth:api', 'scopes:edit-category']);
Route::post('/category/delete/{category}', ['as' => 'category.delete', 'uses' => 'CategoryController@destroy'])->middleware(['auth:api', 'scopes:delete-category']);

Route::get('/category', ['as' => 'category.list', 'uses' => 'CategoryController@list']);
Route::get('/faq/all/{category}', ['as' => 'faq.list', 'uses' => 'FAQController@list']);
Route::get('/faq/{faq}', ['as' => 'faq.show', 'uses' => 'FAQController@show']);
Route::get('/faq/category/{category}', ['as' => 'category.show', 'uses' => 'CategoryController@show']);

Route::get('/token', 'AppController@getCsrfToken')->middleware('auth');
