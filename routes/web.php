<?php

use Illuminate\Support\Facades\Auth;
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


    #Dashboard
    Route::group(['prefix' => "admin","as" =>'admin.'],function(){
        Route::post('provideyearlyint',["as" => "provideyearlyint","uses" => "Admin\HomeController@ProvideInt"]);

    });



    #Member Group Under Admin
    Route::group(['prefix' => 'admin', "as"  => "admin."], function () {
        Route::get('member', ['as'    =>  'member', 'uses' => 'Admin\Member\MemberController@index']);
        Route::get('memberdelete',['as' => 'member.delete', 'uses' => 'Admin\Member\MemberController@delete']);
        Route::get('memberedit', ['as' => 'member.edit', 'uses' => 'Admin\Member\MemberController@edit']);
        // Route::get('extrashare', ['as' => 'member.extrashare', 'uses' => 'Admin\Member\MemberController@ExtraShare']);
        // Route::get('exsmem', ['as' => 'member.exsmem', 'uses' => 'Admin\Member\MemberController@ExSMem']);
        // Route::post('saveextrashare', ['as' => 'member.saveextrashare', 'uses' => 'Admin\Member\MemberController@SaveExShare']);
        Route::post('memberupdate/{member_id}', ['as' => 'member.update', 'uses' => 'Admin\Member\MemberController@update']);
        //Route::get('memberview', ['as' => 'member.view', 'uses' => 'Admin\Member\MemberController@view']);
        Route::get('addmember', ['as' => 'member.add', 'uses' => 'Admin\Member\MemberController@addmember']);
        Route::post('savemember', ['as' => 'member.save', 'uses' => 'Admin\Member\MemberController@savemember']);
        //27/dec/2021
        Route::get('View_Member_details2/{id}', ['as' => 'member.View_Member_details2', 'uses' => 'Admin\Member\MemberController@ViewDetails']);
        Route::get('getdd-data', 'Admin\Member\MemberController@ddmember')->name('getdd-data');
        Route::get('close_open', 'Admin\Member\MemberController@CloseOpen')->name('close_open');
        Route::post('close_open_submit', 'Admin\Member\MemberController@CloseOpenSubmit')->name('close_open_submit');
        Route::get('getmember-data', 'Admin\Member\MemberController@getmember')->name('getmember-data');
        Route::get('getmember-data-serial-no', 'Admin\Member\MemberController@getMemberBySerialNo')->name('getmember-data-serial-no');
        Route::get('geteo-data', 'Admin\Member\MemberController@geteo')->name('geteo-data');
        Route::group(['prefix' => 'account', "as"  => "account."], function () {
            Route::get('createaccount', ['as'    =>  'create', 'uses' => 'Admin\Account\AccountController@create']);
        });
        #14/12/2021 getgroup
        Route::get('LoWise', ['as' => 'member.LoWise', 'uses' => 'Admin\Member\MemberController@LoWiseMember']);
        Route::get('get_member', ['as' => 'member.get_member', 'uses' => 'Admin\Member\MemberController@LoWiseMemberGet']);
        //Route::get('exportLoPDF', ['as' => 'exportLoPDF', 'uses' => 'Admin\Member\MemberController@exportLoPDF']);


        #withdrawal Routes
        Route::get('withdraw', ['as' => 'account.withdraw', 'uses'    =>  'Admin\Account\AccountController@withdraw']);
        Route::get('popup_book', ['as' => 'popup_book', 'uses'    =>  'Admin\Account\AccountController@popup_pass']);
        Route::post('withdrawal', ['as' => 'account.withdrwal', 'uses'    =>  'Admin\Account\AccountController@withdrawal']);

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
        // Route::get('pdfview', array('as' => 'pdfview', 'uses' => 'Admin\Account\AccountController@pdfview'));
        Route::get('pdfview/{download}/{Id}', array('as' => 'pdfview', 'uses' => 'Admin\Account\AccountController@pdfview'));
        Route::post('editminbal', ['as'    =>  'editminbal', 'uses' => 'Admin\Account\AccountController@EditMinbal']);
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



//Collection 02-11-2021

Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('/collection',['as'    =>  'collection.index','uses' => 'Admin\Collection\CollectionController@index']);
        Route::post('/collection/store',['as'    =>  'collection.store','uses' => 'Admin\Collection\CollectionController@store']);
        Route::get("coll_del/{id}","Admin\Collection\CollectionController@destroy");
        Route::get("coll_edt/{id}","Admin\Collection\CollectionController@edit");
        Route::post("coll_upd/{id}","Admin\Collection\CollectionController@update");

    });
});

//Collection

//new user
Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('new_user',['as'    =>  'new_user','uses' => 'Admin\NewUser\NewUserController@index']);
        Route::post('uploadNew',['as'    =>  'uploadNew','uses' => 'Admin\NewUser\NewUserController@validateform']);
        //Route::post("uploadNew","Admin\NewUser\NewUserController@validateform");
        Route::get('Data_del/{id}',['as'    =>  'Data_del','uses' => 'Admin\NewUser\NewUserController@delete']);
        //Route::get('/new_user','Admin\Member\MemberController@new_user')->name('new_user');


    });

});
//loan calculator
Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('loan_calculator',['as'    =>  'loan_calculator','uses' => 'Admin\Loan\loancontroller@index']);
        Route::get('get_loan_type',['as'    =>  'loan_type','uses' => 'Admin\Loan\loancontroller@getLoanType']);
        Route::get('loan_calculate',['as'    =>  'loan_calculate','uses' => 'Admin\Loan\loancontroller@loanCalculate']);

        //Route::post("uploadNew","Admin\NewUser\NewUserController@validateform");
        //Route::get('/new_user','Admin\Member\MemberController@new_user')->name('new_user');


    });

});
//accountholderList

Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('AccountholderList',['as'    =>  'AccountholderList','uses' => 'Admin\Loan\accountholderloa@index']);
        Route::get('applyforloan/{id}/{name}/{AcNo}/{MemId}',['as'    =>  'applyforloan','uses' => 'Admin\Loan\accountholderloa@apply']);
        Route::get('get_MName',['as'    =>  'get_MName','uses' => 'Admin\Loan\accountholderloa@mname']);
        Route::get('get_center',['as'    =>  'get_center','uses' => 'Admin\Loan\accountholderloa@center']);

        Route::get('guarantor_details',['as'    =>  'guarantor_details','uses' => 'Admin\Loan\accountholderloa@GuarantorDetails']);
        Route::get('getgroup',['as'    =>  'getgroup','uses' => 'Admin\Loan\accountholderloa@group']);
        Route::post('subapplyloan/{id}',['as'    =>  'subapplyloan','uses' => 'Admin\Loan\accountholderloa@submit']);
        Route::get('ApplicantList',['as'    =>  'ApplicantList','uses' => 'Admin\Loan\Applicantcontroller@index']);
        Route::get('disbursement/{id}',['as'    =>  'disbursement','uses' => 'Admin\Loan\Disbursement@index']);
        Route::post('approveapply',['as'    =>  'approveapply','uses' => 'Admin\Loan\Disbursement@updateapprove']);
        Route::post('disbursapply',['as'    =>  'disbursapply','uses' => 'Admin\Loan\Disbursement@updatedisburs']);
        Route::get('Approve/{id}',['as'    =>  'Approve','uses' => 'Admin\Loan\Disbursement@approve']);
        Route::get('checkbalance',['as'    =>  'checkbalance','uses' => 'Admin\Loan\Disbursement@availbalance']);
        // Route for applicant filter
        Route::post('applistfilter',['as'    =>  'applistfilter','uses' => 'Admin\Loan\Applicantcontroller@index2']);
        Route::post('accountfilter',['as'    =>  'accountfilter','uses' => 'Admin\Loan\accountholderloa@filter']);

        Route::get('Activeloans',['as'    =>  'Activeloans','uses' => 'Admin\Loan\Disbursement@DisbursedList']);

        Route::get('CollectEmi/{id}',['as'    =>  'CollectEmi','uses' => 'Admin\Loan\Disbursement@LoanEmi']);
        Route::post('loan_coll_emi',['as'    =>  'loan_coll_emi','uses' => 'Admin\Loan\Disbursement@SaveEmiDtl']);

        Route::post('CollectEmiAll',['as'    =>  'CollectEmiAll','uses' => 'Admin\Loan\Disbursement@CollectEmiAll']);
        Route::post('changeacno',['as'    =>  'changeacno','uses' => 'Admin\Loan\Disbursement@ChangeACno']);
        //Route::post("uploadNew","Admin\NewUser\NewUserController@validateform");
        //Route::get('/new_user','Admin\Member\MemberController@new_user')->name('new_user');
    });

});

//Reports
Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('Shares',['as'    =>  'Shares','uses' => 'Admin\Shares\Reportscontroller@index']);
        Route::get('exportPDF',['as'    =>  'exportPDF','uses' => 'Admin\Shares\Reportscontroller@createPDF']);
        Route::get('Details',['as'    =>  'Details','uses' => 'Admin\Shares\Reportscontroller@MemberDetails']);
        Route::get('View_Member_details/{id}',['as'    =>  'member.View_Member_details','uses' => 'Admin\Shares\Reportscontroller@ViewDetails']);
        Route::get('ShareCertificate/{id}',['as'    =>  'ShareCertificate','uses' => 'Admin\Shares\Reportscontroller@ShareCer']);
        Route::get('loanreports',['as'    =>  'loanreports','uses' => 'Admin\Shares\Reportscontroller@LoanReports']);
        Route::get('partyledger/{id}',['as'    =>  'partyledger','uses' => 'Admin\Shares\Reportscontroller@PartyLedger']);
        Route::get('loan_details',['as'    =>  'loan_details','uses' => 'Admin\Shares\Reportscontroller@LoanDetails']);
        Route::get('lowiseloan',['as'    =>  'lowiseloan','uses' => 'Admin\Shares\Reportscontroller@LoWise']);
        Route::get('lowisedeposit',['as'    =>  'lowisedeposit','uses' => 'Admin\Shares\Reportscontroller@LoWiseDeposit']);
        Route::get('viewperlo/{id}',['as'    =>  'viewperlo','uses' => 'Admin\Shares\Reportscontroller@PerLo']);


        Route::get('ylyintreport',['as'    =>  'ylyintreport','uses' => 'Admin\Shares\Reportscontroller@YlyIntReport']);
    });
});

//payroll
Route::get("test-route", function(){
    return redirect()->to(route("admin.SalaryProcessF", ["Year" => 2021]));
});
Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('Payroll',['as'    =>  'Payroll','uses' => 'Admin\Payroll\PayrollController@index']);
        Route::post('EmpAdd',['as'    =>  'EmpAdd','uses' => 'Admin\Payroll\PayrollController@save']);
        Route::get('employeelist',['as'    =>  'employeelist','uses' => 'Admin\Payroll\PayrollController@employeelist']);
        Route::post('Empedit',['as'    =>  'Empedit','uses' => 'Admin\Payroll\PayrollController@Edit']);
        Route::get('View_details/{id}',['as'    =>  'Payroll.View_details','uses' => 'Admin\Payroll\PayrollController@EditFaFA']);
        Route::get('Show_O/{id}',['as'    =>  'Payroll.Show_O','uses' => 'Admin\Payroll\PayrollController@eyeFaFA']);
        Route::get('salaryhead',['as'    =>  'salaryhead','uses' => 'Admin\Payroll\PayrollController@SalaryHead']);
        Route::get('AddHead',['as'    =>  'AddHead','uses' => 'Admin\Payroll\PayrollController@AddHead']);
        Route::get('EditHead/{id}',['as'    =>  'Payroll.EditHead','uses' => 'Admin\Payroll\PayrollController@EditHead']);
        Route::get('DeleteHead/{id}',['as'    =>  'Payroll.DeleteHead','uses' => 'Admin\Payroll\PayrollController@DeleteHead']);
        Route::get('Psalary',['as'    =>  'Psalary','uses' => 'Admin\Payroll\PayrollController@Psalary']);
        Route::post('submitSHead',['as'    =>  'submitSHead','uses' => 'Admin\Payroll\PayrollController@submitSH']);
        Route::get('viewsalary/{id}',['as'    =>  'viewsalary','uses' => 'Admin\Payroll\PayrollController@viewsalary']);
        Route::get('SalaryProcess',['as'    =>  'SalaryProcess','uses' => 'Admin\Payroll\PayrollController@SalaryProcess']);
        Route::get('SalaryProcessF',['as'    =>  'SalaryProcessF','uses' => 'Admin\Payroll\PayrollController@SalaryProcessF']);
        Route::get('ProcessSalary/{id}',['as'    =>  'ProcessSalary','uses' => 'Admin\Payroll\PayrollController@ProcessSalary']);
        Route::get('Attendence',['as'    =>  'Attendence','uses' => 'Admin\Payroll\PayrollController@Attendence']);
        Route::get('AttendenceProcess/{month},{year}',['as'    =>  'AttendenceProcess','uses' => 'Admin\Payroll\PayrollController@ProcessAttendence']);
        // Route::post('editattendence/{id},{month},{year}',['as'    =>  'editattendence','uses' => 'Admin\Payroll\PayrollController@editattendence']);
        Route::post('editattendence/{month},{year}',['as'    =>  'editattendence','uses' => 'Admin\Payroll\PayrollController@editattendence']);
        Route::get('ClaimSalary',['as'    =>  'ClaimSalary','uses' => 'Admin\Payroll\PayrollController@SalaryClaimed']);
        Route::post('ClaimedEdit',['as'    =>  'ClaimedEdit','uses' => 'Admin\Payroll\PayrollController@EditClaimed']);
        Route::post('SaveFromTemp',['as'    =>  'SaveFromTemp','uses' => 'Admin\Payroll\PayrollController@SaveTempVal']);
        Route::get('PaySlip',['as'    =>  'PaySlip','uses' => 'Admin\Payroll\PayrollController@PaySlipGen']);
        Route::get('view_edit',['as'    =>  'view_edit','uses' => 'Admin\Payroll\PayrollController@edit_view']);
        Route::get('ClaimedSalary/{id}',['as'    =>  'ClaimedSalary','uses' => 'Admin\Payroll\PayrollController@SalaryClaimed']);
        Route::post('changeattendence',['as'    =>  'changeattendence','uses' => 'Admin\Payroll\PayrollController@changeattendence']);
        Route::post('generatesalall',['as'    =>  'generatesalall','uses' => 'Admin\Payroll\PayrollController@GenerateSalAll']);
        Route::get('printpayslip/{id1},{id2}',['as'    =>  'printpayslip','uses' => 'Admin\Payroll\PayrollController@printpayslip']);
    });

});

//share
Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('Shares_Extra',['as'    =>  'share.extrashare','uses' => 'Admin\Shares\ShareController@ExtraShare']);
        Route::get('exsmem', ['as' => 'share.exsmem', 'uses' => 'Admin\Shares\ShareController@ExSMem']);
        Route::post('saveextrashare', ['as' => 'share.saveextrashare', 'uses' => 'Admin\Shares\ShareController@SaveExShare']);
        Route::get('share-transfer', ['as' => 'share.sharetrans', 'uses' => 'Admin\Shares\ShareController@ShareTransfer']);

        Route::get('sharetransfer', ['as' => 'share.sharetransfer', 'uses' => 'Admin\Shares\ShareController@ShareHolderDtl']);
        Route::get('sharepopup', ['as' => 'share.sharepopup', 'uses' => 'Admin\Shares\ShareController@SharePopUp']);
        Route::post('sharewithdrow', ['as' => 'share.sharewithdrow', 'uses' => 'Admin\Shares\ShareController@ShareWithDrow']);
    });
});

//accountings  'admin.accounts.cashbookperdate'
Route::group(['middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'admin',"as"  => "admin."], function () {
        Route::get('daily_cashbook_summary',['as'    =>  'accounts.dailycashbooksummary','uses' => 'Admin\Accounting\AccountsController@DailyCashbookSummery']);
        Route::get('cashbook_per_date',['as'    =>  'accounts.cashbookperdate','uses' => 'Admin\Accounting\AccountsController@CashbookPerDate']);
        Route::get('balance-sheet-dtl',['as'    =>  'accounts.balancesheetdtl','uses' => 'Admin\Accounting\AccountsController@BalanceSheetDtl']);
        Route::get('cask_voucher',['as'    =>  'accounts.cash_voucher','uses' => 'Admin\Accounting\AccountsController@CashVoucher']);
        Route::get('bank_voucher',['as'    =>  'accounts.bank_voucher','uses' => 'Admin\Accounting\AccountsController@BankVoucher']);
        Route::get('journal_entry',['as'    =>  'accounts.journal_entry','uses' => 'Admin\Accounting\AccountsController@JournalEntry']);
        Route::get('contra_entry',['as'    =>  'accounts.contra_entry','uses' => 'Admin\Accounting\AccountsController@ContraEntry']);
        Route::get('ledger-master',['as'    =>  'accounts.ledger_master','uses' => 'Admin\Accounting\AccountsController@LedgerMaster']);
        Route::get('bank-book',['as'    =>  'accounts.bankbook','uses' => 'Admin\Accounting\AccountsController@BankBook']);
        Route::get('profit-loss',['as'    =>  'accounts.profitnloss','uses' => 'Admin\Accounting\AccountsController@ProfitLoss']);
        Route::get('bankbook_dtl',['as'    =>  'accounts.bankbook_dtl','uses' => 'Admin\Accounting\AccountsController@BankBookDtl']);
        Route::post('vouchersave',['as'    =>  'accounts.vouchersave','uses' => 'Admin\Accounting\AccountsController@VoucherSave']);

        Route::get('general-ledger',['as'    =>  'accounts.generalledger','uses' => 'Admin\Accounting\AccountsController@GeneralLedger']);
        Route::get('ledger-summery',['as'    =>  'accounts.ledgersummery','uses' => 'Admin\Accounting\AccountsController@LedgerSummery']);
        Route::get('member-savings',['as'    =>  'accounts.membersavings','uses' => 'Admin\Accounting\AccountsController@MemberSavings']);
    });
});
