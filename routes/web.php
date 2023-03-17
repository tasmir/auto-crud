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


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix(trans("lang.backend.url_prefix"))->name(trans("lang.backend.name_prefix"))->group(function () {

//    Route::prefix('/venue')->group(
//        function () {
//            Route::resource('amenity', App\Http\Controllers\Backend\AmenityController::class);
//            Route::post('amenity-data-rearange', [App\Http\Controllers\Backend\AmenityController::class, 'rearangStore'])->name('amenity.rearang.store');
//            Route::post('amenity-data-status', [App\Http\Controllers\Backend\AmenityController::class, 'statusChange'])->name('amenity.status.change');
//            // Route::get('{id}/edit', [App\Http\Controllers\Backend\VenueController::class, 'edit'])->name('venue.edit');
//        }
//    );
//    Route::get('types/{type:}/edit', [App\Http\Controllers\Backend\TypesController::class, 'edit'])->name('types.edit');
    Route::resource('types', App\Http\Controllers\Backend\TypesController::class);

    Route::prefix('{field:slug}')->name("field.")->group(
        function () {
            Route::get('/', [App\Http\Controllers\Backend\DataStoreController::class, 'index'])->name('index');
            Route::Post('/', [App\Http\Controllers\Backend\DataStoreController::class, 'store'])->name('store');
            Route::get('/create', [App\Http\Controllers\Backend\DataStoreController::class, 'create'])->name('create');
            Route::get('{dataStore}/edit', [App\Http\Controllers\Backend\DataStoreController::class, 'edit'])->name('edit');
            Route::PUT('{dataStore}', [App\Http\Controllers\Backend\DataStoreController::class, 'update'])->name('update');
        }
    );

//    Route::resource('category', App\Http\Controllers\Backend\EventCategoryController::class)->except(['create', 'show']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/type-slug-checker', [App\Http\Controllers\Backend\TypesController::class, 'slugChecking']);

