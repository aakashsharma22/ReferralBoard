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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/referrals', [App\Http\Controllers\UserReferralController::class, 'referralInvite'])->name('referralInvite');

Route::post('/referrals', [App\Http\Controllers\UserReferralController::class, 'processInvitation'])->name('processInvitation');

Route::get('/registration/{referralToken}', [App\Http\Controllers\UserReferralController::class, 'registration'])->name('userRegistration');

Route::POST('/registration', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('acceptInvitation');

Route::get('/referral_count', [App\Http\Controllers\UserReferralController::class, 'referralCount'])->name('referralCount');

Route::get('/user/referrals', [App\Http\Controllers\UserReferralController::class, 'userReferralBoard'])->name('userReferralBoard');

Route::group(['middleware' => 'is.admin'], function () {
    Route::get('/admin/referrals', [App\Http\Controllers\UserReferralController::class, 'adminReferralBoard'])->name('adminReferralBoard');
});


