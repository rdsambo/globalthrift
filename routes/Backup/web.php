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

Route::get('getcenter', 'Member\MemberController@getlomember')->name('getcenter');


Auth::routes();
Route::get('logout', [
    "as"    => "logout",
    "uses"  => "Auth\LoginController@logout"
]);



Route::group(['middleware' => ['auth.admin']], function () {
#Admin Group
    Route::group(['prefix' =>'admin', "as"  => "admin."], function () {
         Route::get('/', ['as'    =>  'index', 'uses' => 'Admin\HomeController@index']);

    });

    #Member Group Under Admin
    Route::group(['prefix' => 'admin', "as"  => "admin."], function () {
        Route::get('member', ['as'    =>  'member', 'uses' => 'Admin\Member\MemberController@index']);
        Route::get('memberdelete',['as' => 'member.delete', 'uses' => 'Admin\Member\MemberController@delete']);
        Route::get('memberedit', ['as' => 'member.edit', 'uses' => 'Admin\Member\MemberController@edit']);
        Route::post('memberupdate/{member_id}', ['as' => 'member.update', 'uses' => 'Admin\Member\MemberController@update']);
        Route::get('memberview', ['as' => 'member.view', 'uses' => 'Admin\Member\MemberController@view']);
        Route::get('addmember', ['as' => 'member.add', 'uses' => 'Admin\Member\MemberController@addmember']);
        Route::post('savemember', ['as' => 'member.save', 'uses' => 'Admin\Member\MemberController@savemember']);

        Route::get('getdd-data', 'Admin\Member\MemberController@ddmember')->name('getdd-data');
        Route::get('getmember-data', 'Admin\Member\MemberController@getmember')->name('getmember-data');
        Route::get('getmember-data-serial-no', 'Admin\Member\MemberController@getMemberBySerialNo')->name('getmember-data-serial-no');
        Route::get('geteo-data', 'Admin\Member\MemberController@geteo')->name('geteo-data');
        Route::group(['prefix' => 'account', "as"  => "account."], function () {
            Route::get('createaccount', ['as'    =>  'create', 'uses' => 'Admin\Account\AccountController@create']);


        });
        #withdrawal Routes
        Route::get('withdraw', ['as' => 'account.withdraw', 'uses'    =>  'Admin\Account\AccountController@withdraw']);
        Route::get('withdrawal', ['as' => 'account.withdrwal', 'uses'    =>  'Admin\Account\AccountController@withdrawal']);

        #Passbook Route
        Route::get('passbook', ['as' => 'account.passbook', 'uses'    =>  'Admin\Account\AccountController@passbook']);
        Route::get('generate', ['as' => 'account.generate', 'uses'    =>  'Admin\Account\AccountController@generate']);

    });
    #User group for admin
    Route::group(['prefix' => "admin","as" =>'admin.user.'],function(){
        Route::get('userprofile',["as" => "profile","uses" => "Admin\User\UserController@index"]);

    });

    #new DD/MD Account Opening
    Route::group(['prefix' => 'admin', "as"  => "admin."], function () {
        Route::get('newddaccount', ['as'    =>  'account.ddaccount', 'uses' => 'Admin\Account\AccountController@index']);
        Route::get('ddaccountlist', ['as'    =>  'account.ddlist', 'uses' => 'Admin\Account\AccountController@ddaccountlist']);
        Route::get('ddaccountlistindiv', ['as'    =>  'account.ddlistindiv', 'uses' => 'Admin\Account\AccountController@ddaccountlistindiv']);
        Route::get('newmdaccount', ['as'    =>  'account.mdaccount', 'uses' => 'Admin\Account\AccountController@indexm']);
        Route::get('mdaccountlist', ['as'    =>  'account.mdlist', 'uses' => 'Admin\Account\AccountController@mdaccountlist']);
        Route::get('accountreportdd', ['as'    =>  'accountreport', 'uses' => 'Admin\Account\AccountController@accountreportdd']);
        Route::get('pdfview', array('as' => 'pdfview', 'uses' => 'Admin\Account\AccountController@pdfview'));
    });

    #DD/MD Collection
    Route::group(['prefix' => 'admin', "as"  => "admin."], function () {
        Route::get('ddcollection', ['as'    =>  'account.ddcollection', 'uses' => 'Admin\Account\AccountController@ddcollection']);
        Route::get('mdcollection', ['as'    =>  'account.mdcollection', 'uses' => 'Admin\Account\AccountController@mdcollection']);
        Route::get('ddaccount',['as'    =>  'getaccountdata','uses'   =>  'Admin\Account\AccountController@getacctdata']);
        Route::get('transfer',['as'    =>  'transferac','uses'   =>  'Admin\Account\AccountController@transferdata']);
        Route::get('mdaccount', ['as'    =>  'getaccountdatamd', 'uses'   =>  'Admin\Account\AccountController@getacctdatamd']);
        Route::post("postddcollection",['as'    =>  'collection.dd', 'uses'     =>  'Admin\Account\AccountController@collectiondd']);
        Route::post("postmdcollection", ['as'    =>  'collection.md', 'uses'     =>  'Admin\Account\AccountController@collectionmd']);
    });

});
Route::group(['middleware' => ['auth.user']], function () {
    Route::group(['prefix' => 'user',"as"  => "user."], function () {
        Route::get('/',['as'    =>  'index','uses' => 'Home\HomeController@userindex']);
        Route::get('member/view', ['as'   =>  'member.view', "uses"  =>  'Member\MemberController@viewmember']);
        Route::get('member/add', ['as'   =>  'member.add', "uses"  =>  'Member\MemberController@addmember']);
        Route::get('member/add/mem', ['as'   =>  'member.addmem', "uses"  =>  'Member\MemberController@addmember']);
    });
});

