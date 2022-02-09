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

Route::get('/', [\App\Http\Controllers\ContactController::class, 'index'])->name('index');
Route::get('show/{contact}', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
Route::get('contact/create',   [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('contact/{contact}/delete', [\App\Http\Controllers\ContactController::class, 'delete'])->name('contact.delete');
Route::get('contact/{contact}/edit', [\App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');
Route::post('contact/{contact}', [\App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');

Route::get('phonenumber/create/{contactId}',  [\App\Http\Controllers\PhoneNumberController::class, 'create'])->name('phonenumber.create');
Route::post('phonenumber/store/{contactId}',  [\App\Http\Controllers\PhoneNumberController::class, 'store'])->name('phonenumber.store');
Route::get('phonenumber/{phonenumber}/edit', [\App\Http\Controllers\PhoneNumberController::class, 'edit'])->name('phonenumber.edit');
Route::post('phonenumber/{phonenumber}', [\App\Http\Controllers\PhoneNumberController::class, 'update'])->name('phonenumber.update');
Route::get('phonenumber/{phonenumber}/delete', [\App\Http\Controllers\PhoneNumberController::class, 'delete'])->name('phonenumber.delete');
