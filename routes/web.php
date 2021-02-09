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

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'CategoryDiscountRuleController@editAllDiscountRules')->name('home');
Route::get('/home', 'CategoryDiscountRuleController@editAllDiscountRules')->name('home');

//Auth::routes();

Route::get('/getSubCatWiseDetail', 'CategoryDiscountRuleController@getSubCatWiseDetail')->name('getSubCatWiseDetail');
Route::get('/getExistingRule', 'CategoryDiscountRuleController@getExistingRule')->name('getExistingRule');
Route::get('/getSubCategories', 'CategoryDiscountRuleController@getSubCategories')->name('getSubCategories');
Route::get('/getProductTypes', 'CategoryDiscountRuleController@getProductTypes')->name('getProductTypes');
Route::get('/editAllDiscountRules', 'CategoryDiscountRuleController@editAllDiscountRules')->name('editAllDiscountRules');
Route::get('/nonClubDiscDiffConditions', 'CategoryDiscountRuleController@nonClubDiscDiffConditions')->name('nonClubDiscDiffConditions');
Route::post('/updateCategoryDiscountRule/{id}', 'CategoryDiscountRuleController@updateCategoryDiscountRule')->name('updateCategoryDiscountRule');
Route::post('/addCategoryDiscountRule', 'CategoryDiscountRuleController@addCategoryDiscountRule')->name('addCategoryDiscountRule');
Route::post('/deleteCatRule', 'CategoryDiscountRuleController@deleteCatRule')->name('deleteCatRule');


Route::get('/prodNonClubDiscDiff', 'ProductDiscountRuleController@prodNonClubDiscDiff')->name('prodNonClubDiscDiff');
Route::any('/searchProductDiscRule', 'ProductDiscountRuleController@searchProductDiscRule')->name('searchProductDiscRule');
Route::post('/updateProductDiscountRule', 'ProductDiscountRuleController@updateProductDiscountRule')->name('updateProductDiscountRule');

//
Route::any('/nonClubDiscDiffConditionsLog', 'DiscountDifferenceLogController@nonClubDiscDiffConditionsLog')->name('nonClubDiscDiffConditionsLog');
Route::any('/prodNonClubDiscDiffLog', 'ProductDiscountDifferenceLogController@prodNonClubDiscDiffLog')->name('prodNonClubDiscDiffLog');
Route::any('/getDiffConditionLogData', 'DiscountDifferenceLogController@getDiffConditionLogData')->name('getDiffConditionLogData');
Route::any('/getProductDiffConditionLogData', 'ProductDiscountDifferenceLogController@getProductDiffConditionLogData')->name('getProductDiffConditionLogData');
//
Route::any('/cronLog', 'CronLogController@cronLog')->name('cronLog');
Route::any('/getCronLogData', 'CronLogController@getCronLogData')->name('getCronLogData');

