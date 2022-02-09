<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/signup', [\App\Http\Controllers\SignupController::class, 'signup'])->name('api.signup');

Route::group(['middleware' => [], 'prefix' => ''], function () {

    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('api.login');
    Route::post('/buy', [\App\Http\Controllers\Api\CreditController::class, 'buy'])->name('api.credit.buy');
    Route::post('/password', [PasswordController::class, 'update'])->name('api.password.update');

    Route::prefix('property')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Api\PropertiesController::class, 'add'])->name('api.property.add');

        Route::post('/action/change/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'action'])->name('api.property.action.change');

        Route::post('/update/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'update'])->name('api.property.update');

        Route::post('/image/upload/{id}/{role}', [\App\Http\Controllers\Api\PropertiesController::class, 'image'])->name('api.property.image.upload');
    });

    Route::prefix('material')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Api\MaterialsController::class, 'add'])->name('api.material.add');

        Route::post('/update/{id}', [\App\Http\Controllers\Api\MaterialsController::class, 'update'])->name('api.material.update');

        Route::post('/image/upload/{id}/{role}', [\App\Http\Controllers\Api\MaterialsController::class, 'image'])->name('api.material.image.upload');
    });

    Route::post('/password/email', [PasswordController::class, 'email'])->name('password.email')->name('api.');
    Route::post('/password/reset', [PasswordController::class, 'reset'])->name('password.reset')->name('api.');
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update')->name('api.');

    Route::post('/logout', [ApiController::class, 'logout'])->name('api.logout');

});
