<?php

use App\Http\Controllers\CommerController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PaymentController;
use Faker\Provider\ar_EG\Payment;
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
Route::middleware(['islogin', 'checkRole:admin'])->group(function(){
    Route::get('/dashboard/pembayaran', [CommerController::class, 'pembayaran'])->name('pembayaran');
    Route::get('/dashboard/admin', [CommerController::class, 'dashboardAdmin'])->name('dashboard.admin');

    Route::post('/dashboard/admin/input', [commerController::class, 'store'])->name('barang.input');
    Route::get('/dashboard/bukti/{id}', [PaymentController::class, 'bukti'])->name('bukti');
    Route::patch('/completed/{id}', [PaymentController::class, 'updateComplated'])->name('updateCompleted');
    Route::patch('/tolak/{id}', [PaymentController::class, 'updateRefuse'])->name('updateRefuse');
});

Route::middleware(['islogin'])->group(function(){
    Route::get('/dashboard/chart//{id}', [CommerController::class, 'chart'])->name('chart.preference.product');
    Route::get('/landing', [CommerController::class, 'index'])->name('landing');
    Route::delete('/delete/{id}', [CommerController::class, 'destroy'])->name('delete');
    Route::get('/dashboard/screen/{id}', [CommerController::class, 'screen'])->name('screen.product');
    Route::post('/chart/input/', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/review/input', [FeedController::class, 'store'])->name('review.input');
    Route::get('/dashboard/detail/{id}', [PaymentController::class, 'detail'])->name('detail');

});

Route::get('/logout', [CommerController::class, 'logout'])->name('logout');
Route::get('/error', [PaymentController::class, 'error'])->name('error');

Route::middleware(['isguest'])->group(function(){
    Route::get('/errorlogin', [commerController::class, 'errorlogin'])->name('errorlogin');
    Route::get('/', [CommerController::class, 'index'])->name('landing');
    Route::get('/login', [CommerController::class, 'login'])->name('login'); 
    Route::get('/login/register', [CommerController::class, 'register'])->name('register');
   Route::post('/login/register/input', [CommerController::class, 'accountRegister'])->name('register.input');
Route::post('/login/auth', [CommerController::class, 'Auth'])->name('login.auth');

});



