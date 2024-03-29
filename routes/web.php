<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('make', function () {
    return view('make');
});
Route::get('spa', function () {
    return view('single');
});


Route::prefix(trans("lang.backend.url_prefix"))->name(trans("lang.backend.name_prefix"))->group(function () {
    Route::post('/type/slug-checker', [App\Http\Controllers\Backend\TypesController::class, 'slugChecking'])->name('types.slug.check');
    Route::post('/type/list', [App\Http\Controllers\Backend\TypesController::class, 'list'])->name('types.list');
    Route::resource('types', App\Http\Controllers\Backend\TypesController::class);

    Route::prefix('{field:slug}')->name("field.")->group(
        function () {
            Route::GET('/', [App\Http\Controllers\Backend\DataStoreController::class, 'index'])->name('index');
            Route::POST('/', [App\Http\Controllers\Backend\DataStoreController::class, 'store'])->name('store');
            Route::GET('/create', [App\Http\Controllers\Backend\DataStoreController::class, 'create'])->name('create');
            Route::GET('{dataStore}/edit', [App\Http\Controllers\Backend\DataStoreController::class, 'edit'])->name('edit');
            Route::PUT('{dataStore}', [App\Http\Controllers\Backend\DataStoreController::class, 'update'])->name('update');
            Route::DELETE('{dataStore}', [App\Http\Controllers\Backend\DataStoreController::class, 'destroy'])->name('destroy');
        }
    );

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('{field:slug}')->name("field.")->group(function () {
    Route::get('/', [App\Http\Controllers\Backend\DataStoreController::class, 'index'])->name('index');
});
