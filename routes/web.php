<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\TransactionsC;
use App\Http\Controllers\UsersC;
use App\Http\Controllers\loginC;
use App\Http\Controllers\LogC;
use App\Http\Controllers\transactionsPDF;

Route::get('products/pdf', [ProductsC::class, 'pdf'])->middleware('UserAkses:Admin,Kasir,Owner');
Route::resource('products', ProductsC::class)->middleware('UserAkses:Admin,Kasir,Owner');
Route::get('users/pdf', [UsersC::class, 'pdf'])->middleware('UserAkses:Admin');
Route::resource('users', UsersC::class)->middleware('UserAkses:Owner,Admin');
Route::get('users/create', [UsersC::class, 'create'])->name('users.create')->middleware('UserAkses:Owner,Admin');

Route::get('transactions/pdf2/{id}', [TransactionsC::class, 'pdf2'])->middleware('UserAkses:Kasir')->name('transactions.pdf2');
Route::get('transactions/pdf', [TransactionsC::class, 'pdf'])->middleware('UserAkses:Owner,Admin');
Route::get('pertanggal/{start_date}/{end_date}', [TransactionsC::class, 'pertanggal'])->name('transactions.pertanggal')->middleware('UserAkses:Owner,Admin');
Route::get('transactions', [TransactionsC::class, 'index'])->name('transactions.index')->middleware('UserAkses:Kasir,Admin,Owner');
Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create')->middleware('UserAkses:Kasir,Admin');
Route::post('transactions/store', [TransactionsC::class, 'store'])->name('transactions.store')->middleware('UserAkses:Kasir,Admin');
Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit')->middleware('UserAkses:Admin');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update')->middleware('UserAkses:Admin');
Route::delete('transactions/delete/{id}', [TransactionsC::class, 'delete'])->name('transactions.delete')->middleware('UserAkses:Admin');

Route::get('users/changepassword/{id}', [UsersC::class, 'changepassword'])->name('users.changepassword')->middleware('UserAkses:Admin');
Route::put('users/change/{id}', [UsersC::class, 'change'])->name('users.change')->middleware('UserAkses:Admin');

Route::get('/', function () {
    $subtitle = "Home Page";
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('dashboard', function () {
    $subtitle = "Home Page";
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('login', [loginC::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [loginC::class, 'login_action'])->name('login.action')->middleware('guest');
Route::get('logout', [loginC::class, 'logout'])->name('logout')->middleware('auth');

Route::get('log', [LogC::class, 'index'])->name('log.index')->middleware('auth');
