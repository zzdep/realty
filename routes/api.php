<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\MyApiAuth;
use \App\Http\Controllers\OfferController;
use \App\Http\Controllers\OfferItemController;


Route::group(['prefix' => 'v1'], function () {

    Route::post( '/offer',            [OfferController::class, 'create']);
    Route::patch('/offer/{id}',       [OfferController::class, 'update'])->where('id', '[a-f0-9-]+');
    Route::post( '/offer_item',       [OfferItemController::class, 'create']);
    Route::delete('/offer_item/{id}', [OfferItemController::class, 'destroy'])->where('id', '[0-9]+');

})->middleware(MyApiAuth::class);

