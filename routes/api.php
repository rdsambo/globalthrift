<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login','Api\UserController@login');
Route::get('fin_year','Api\UserController@fin_year');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('master', [
        "uses"  => "Api\UserController@master"
    ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Get Daily  and  monthly Collection member information
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'member'], function () {
        Route::get('/daily_collection', [
            'as'   => 'member.daily_collection',
            'uses' => 'Api\Member\MemberController@daily_collection',
        ]);

        Route::get('/monthly_collection', [
            'as'   => 'member.monthly_collection',
            'uses' => 'Api\Member\MemberController@monthly_collection',
        ]);


    });
});


//Store Deposite Amount
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'deposite'], function () {
        Route::post('/store_temp', [
            'as'   => 'deposite.store',
            'uses' => 'Api\DepositeController@store_temp_deposite',
        ]);


    });
});

//Get transaction history
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'records'], function () {
        Route::get('/', [
            'as'   => 'deposite.record',
            'uses' => 'Api\DepositeRecordController@getrecord',
        ]);
    });
});

