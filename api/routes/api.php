<?php
use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AuthController::class)->group(function ()
{
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

Route::group([
    'controller' => \App\Http\Controllers\PasteController::class,
    'prefix' => 'pastes'
], function()
{
    Route::post('', 'create');
    Route::put('{paste}', 'update')->middleware('auth:sanctum');
    Route::delete('{paste}', 'destroy')->middleware('auth:sanctum');
});