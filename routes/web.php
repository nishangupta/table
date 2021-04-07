<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TableTypeController;
use App\Http\Controllers\Admin\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>[],'prefix'=>'admin'],function(){
    Route::redirect('/admin','/')->name('admin.index');
    Route::redirect('/account','/')->name('account.index');
    Route::redirect('/account/logout','/')->name('account.logout');
    
    Route::resource('/tableType',TableTypeController::class);
    Route::resource('/table',TableController::class);

    Route::get('/reservation/filter',[ReservationController::class,'filter'])->name('reservation.filter');
    Route::resource('/reservation',ReservationController::class);

    Route::get('/order',[OrderController::class,'index'])->name('order.index');
    Route::get('/order/create/{reservation}',[OrderController::class,'create'])->name('order.create');
    Route::post('/order',[OrderController::class,'store'])->name('order.store');
    Route::get('/order/{order}',[OrderController::class,'show'])->name('order.show');
    Route::get('/order/{order}/edit',[OrderController::class,'edit'])->name('order.edit');
    Route::put('/order/{order}',[OrderController::class,'update'])->name('order.update');
    Route::delete('/order/{order}',[OrderController::class,'destroy'])->name('order.destroy');
    Route::get('/order/printInvoice/{id}',[OrderController::class,'printInvoice'])->name('order.printInvoice');
  
    
    Route::get('/billing/create/{reservation}',[BillingController::class,'create'])->name('billing.create');
    Route::post('/billing',[BillingController::class,'store'])->name('billing.store');
    Route::put('/billing/{reservation}',[BillingController::class,'update'])->name('billing.update');

    
    Route::resource('/menu',MenuController::class);

    Route::get('/food/search',[FoodController::class,'search'])->name('food.search');
    Route::resource('/food',FoodController::class);


});
