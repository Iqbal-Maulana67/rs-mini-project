<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;
use App\Models\Voucher;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pages/login');
})->name('login')->middleware('auth.check');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('pages/marketing/dashboard');
})->name('marketing.dashboard');

Route::get('/vouchers', [VoucherController::class, 'index'])->name('voucher.index')->middleware(['auth', 'auth.marketing']);
Route::get('/vouchers/add', [VoucherController::class, 'create'])->name('voucher.create')->middleware(['auth', 'auth.marketing']);
Route::post('/vouchers', [VoucherController::class, 'store'])->name('voucher.store')->middleware(['auth', 'auth.marketing']);
Route::get('/vouchers/{voucher}/edit', [VoucherController::class, 'edit'])->name('voucher.edit')->middleware(['auth', 'auth.marketing']);
Route::put('/vouchers/{voucher}/update', [VoucherController::class, 'update'])->name('voucher.update')->middleware(['auth', 'auth.marketing']);
Route::delete('/vouchers/{voucher}/destroy', [VoucherController::class, 'destroy'])->name('voucher.destroy')->middleware(['auth', 'auth.marketing']);

Route::get('/kasir', [CashierController::class, 'index'])->name('kasir')->middleware(['auth', 'auth.kasir']);
Route::post('/kasir', [TransactionController::class, 'store'])->name('kasir.store')->middleware(['auth', 'auth.kasir']);

Route::get('/transactions/{transaction}/invoice', [TransactionController::class, 'invoice'])->name('transactions.invoice');
