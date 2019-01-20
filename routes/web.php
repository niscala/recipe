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

Route::get('/', 'RecipeController@index');
Route::get('/buat-resep', 'RecipeController@create');
Route::get('/getingunit', 'RecipeController@getIngUnit');
Route::post('/addrecipe', 'RecipeController@store');
Route::get('{id}/lihat-resep/{name}', 'RecipeController@show');
Route::get('/postrecing', 'RecipeController@addIng');
Route::get('/postediting', 'RecipeController@editIng');
Route::get('/deling', 'RecipeController@delIng');
Route::post('/deleterecipe', 'RecipeController@destroy');
Route::post('/upimages', 'RecipeController@updateImg');
Route::get('/getcategory', 'RecipeController@getCategory');
Route::get('/uprecipename', 'RecipeController@upRecipeName');

Route::get('/lihat-kategori', 'MasterController@indexCategory');
Route::post('/doaddcategory', 'MasterController@doAddCategory');
Route::post('/doeditcategory', 'MasterController@doEditCategory');
Route::get('/dodeletecategory/{id}', 'MasterController@delCategory');

Route::get('/lihat-bahan', 'MasterController@indexIngredients');
Route::post('/doadding', 'MasterController@doAddIngredients');
Route::post('/doediting', 'MasterController@doEditIngredients');
Route::get('/dodeleteing/{id}', 'MasterController@delIngredients');