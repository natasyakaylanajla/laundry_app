<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\UserController;
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

Route::get('/', [ReportController::class, 'viewReport'])->middleware('auth')->name('viewReport');

Route::prefix('/report')->middleware('auth')->middleware('can:role,"admin","kasir","owner"')->group(function() {
    Route::get('/member', [ReportController::class, 'handlePrintMember'])->name('handlePrintMember');
    Route::get('/transaction', [ReportController::class, 'handlePrintTransaction'])->name('handlePrintTransaction');
});

Route::get('/login', [UserController::class, 'viewLogin'])->middleware('guest')->name('viewLogin');

Route::prefix('/register')->middleware('guest')->group(function() {
    Route::get('/', [OutletController::class, 'viewRegister'])->name('viewRegister');
    Route::post('/', [OutletController::class, 'handleRegister'])->name('handleRegister');
});

Route::prefix('/user')->group(function() {
    Route::post('/login', [UserController::class, 'handleLogin'])->middleware('guest')->name('handleLogin');
    Route::post('/logout', [UserController::class, 'handleLogout'])->middleware('auth')->name('handleLogout');
});

Route::prefix('/outlet')->middleware('auth')->middleware('can:role,"admin"')->group(function() {
    Route::get('/', [OutletController::class, 'viewOutlet'])->name('viewOutlet');
    Route::post('/update', [OutletController::class, 'handleUpdate'])->name('handleUpdateOutlet');
});

Route::prefix('/package')->middleware('auth')->middleware('can:role,"admin"')->group(function() {
    Route::post('/create', [PackageController::class, 'handleCreate'])->name('handleCreatePackage');
    Route::post('/update/{package}', [PackageController::class, 'handleUpdate'])->name('handleUpdatePackage');
    Route::post('/delete/{package}', [PackageController::class, 'handleDelete'])->name('handleDeletePackage');
});

Route::prefix('/user')->middleware('auth')->middleware('can:role,"admin"')->group(function() {
    Route::post('/create', [UserController::class, 'handleCreate'])->name('handleCreateUser');
    Route::post('/update/{user}', [UserController::class, 'handleUpdate'])->name('handleUpdateUser');
    Route::post('/delete/{user}', [UserController::class, 'handleDelete'])->name('handleDeleteUser');
});

Route::prefix('/member')->middleware('auth')->middleware('can:role,"admin","kasir"')->group(function() {
    Route::post('/create', [MemberController::class, 'handleCreate'])->name('handleCreateMember');
});

Route::prefix('/transaction')->middleware('auth')->middleware('can:role,"admin","kasir"')->group(function() {
    Route::get('/', [TransactionController::class, 'viewTransaction'])->name('viewTransaction');
    Route::post('/create/{member}', [TransactionController::class, 'handleCreate'])->name('handleCreateTransaction');
    Route::post('/update/{transaction}', [TransactionController::class, 'handleUpdate'])->name('handleUpdateTransaction');
    Route::post('/delete/{transaction}', [TransactionController::class, 'handleDelete'])->name('handleDeleteTransaction');
    Route::post('/pay/{transaction}', [TransactionController::class, 'handlePayment'])->name('handlePaymentTransaction');
    Route::post('/process/{transaction}', [TransactionController::class, 'handleProcess'])->name('handleProcessTransaction');
    
    Route::get('/detail/{invoiceCode}', [TransactionDetailController::class, 'viewTransactionDetail'])->name('viewTransactionDetail');
    Route::post('/create-detail/{transaction}', [TransactionDetailController::class, 'handleCreate'])->name('handleCreateTransactionDetail');
    Route::post('/update-detail/{transactionDetail}', [TransactionDetailController::class, 'handleUpdate'])->name('handleUpdateTransactionDetail');
    Route::post('/delete-detail/{transactionDetail}', [TransactionDetailController::class, 'handleDelete'])->name('handleDeleteTransactionDetail');
});
