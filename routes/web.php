<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::group(['middleware' => ['auth']], function () {
        Route::get('/', [MainController::class, 'index'])->name('index');
        Route::get('/dialog/{id}', [MainController::class, 'dialog'])->name('dialog');
        Route::get('/new', [MainController::class, 'newDialog'])->name('new');
        Route::post('/dialog/{id}', [MainController::class, 'sendMessage'])->name('dialog.send');
        Route::post('/new', [MainController::class, 'createDialog'])->name('new.create');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
