<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Middleware\CheckUsernameSession;
use App\Http\Middleware\CheckAdminRoleSession;
use App\Http\Middleware\CheckUserRoleSession;

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

// Viewer
Route::get('viewer', function () {
    return view('viewer');
})->name('viewer');

// Index
Route::get('index', function () {
    return redirect('/');
})->name('/');

// Index
Route::get('/', function (Request $request) {
    return view('index', ['sign_in_failed' => '']);
})->middleware('session.login.check');

Route::middleware([CheckUsernameSession::class])->group(function () {

    // Admin
    Route::middleware([CheckAdminRoleSession::class])->group(function () {

        Route::get('admin/dashboard', function (Request $request) {
            return view('dashboard_admin');
        })->name('admin/dashboard');

        Route::get('admin/accounts', function (Request $request) {
            return view('accounts');
        })->name('admin/accounts');

    });

    // User
    Route::middleware([CheckUserRoleSession::class])->group(function () {

        Route::get('user/pagination', function (Request $request) {
            return view('pagination');
        })->name('user/pagination');

        Route::get('user/load_more', function (Request $request) {
            return view('load_more');
        })->name('user/load_more');

        Route::get('user/table_switching', function (Request $request) {
            return view('table_switching');
        })->name('user/table_switching');

        Route::get('user/ts_lm', function (Request $request) {
            return view('ts_lm');
        })->name('user/ts_lm');

        Route::get('user/keyup_search', function (Request $request) {
            return view('keyup_search');
        })->name('user/keyup_search');

    });

});

// Login
Route::post('login/sign-in','LoginController@signIn')->name('login/sign-in');
Route::get('login/sign-out','LoginController@signOut')->name('login/sign-out');
Route::get('login/sign-in-failed', function (Request $request) {
    return view('index', ['sign_in_failed' => 'failed']);
})->middleware('session.login.check');

// Account
Route::get('accounts/load','UserAccountsController@load')->name('accounts/load');
Route::get('accounts/search','UserAccountsController@search')->name('accounts/search');
Route::post('accounts/insert','UserAccountsController@insert')->name('accounts/insert');
Route::post('accounts/update','UserAccountsController@update')->name('accounts/update');
Route::post('accounts/delete','UserAccountsController@delete')->name('accounts/delete');
Route::get('accounts/export/{employee_no?}/{full_name?}','UserAccountsController@export')->name('accounts/export');
Route::get('accounts/export3/{employee_no?}/{full_name?}','UserAccountsController@export3')->name('accounts/export3');
Route::post('accounts/import','UserAccountsController@import')->name('accounts/import');
Route::post('accounts/import2','UserAccountsController@import2')->name('accounts/import2');
Route::get('accounts/count/{employee_no?}/{full_name?}/{user_type?}','UserAccountsController@count')->name('accounts/count');
Route::get('accounts/searchpagep','UserAccountsController@searchPageP')->name('accounts/searchpagep');
Route::get('accounts/searchpagel','UserAccountsController@searchPageL')->name('accounts/searchpagel');
Route::get('accounts/searchpagek','UserAccountsController@searchPageK')->name('accounts/searchpagek');
Route::get('accounts/searchpaginationpagep','UserAccountsController@searchPaginationPageP')->name('accounts/searchpaginationpagep');
Route::get('accounts/searchlastpagel','UserAccountsController@searchLastPageL')->name('accounts/searchlastpagel');
Route::get('accounts/searchlastpagek','UserAccountsController@searchLastPageK')->name('accounts/searchlastpagek');

// Table Switching
Route::get('tts/loadtt1','TTSController@loadTT1')->name('tts/loadtt1');
Route::get('tts/loadtt2','TTSController@loadTT2')->name('tts/loadtt2');

// Table Switching + Load More
Route::get('ttslm/counttt1data','TTSLMController@countTT1Data')->name('ttslm/counttt1data');
Route::get('ttslm/counttt2data/{c1?}','TTSLMController@countTT2Data')->name('ttslm/counttt2data');
Route::get('ttslm/loadtt1data','TTSLMController@loadTT1Data')->name('ttslm/loadtt1data');
Route::get('ttslm/loadtt2data','TTSLMController@loadTT2Data')->name('ttslm/loadtt2data');
Route::get('ttslm/lastpagett1data','TTSLMController@lastPageTT1Data')->name('ttslm/lastpagett1data');
Route::get('ttslm/lastpagett2data','TTSLMController@lastPageTT2Data')->name('ttslm/lastpagett2data');

// Export
Route::get('export/export_data2/{employee_no?}/{full_name?}','ExportController@export_data2')->name('export/export_data2');

// Import
Route::post('import/import_data2','ImportController@import_data2')->name('import/import_data2');

Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');
