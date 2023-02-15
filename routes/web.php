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

Route::get('/', function () {
    return view('livewire.catalogo.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/administrar/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::resource('usuarios', App\Http\Controllers\UserController::class)
->middleware('auth:sanctum');
Route::get('/administrar/categorias', App\Http\Livewire\Admcategorias\Admcategorias::class)->middleware('auth');
//Route::resource('/administrador/categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth:sanctum');
//Route::get('administrador/getcategorias', [App\Http\Controllers\CategoriaController::class, 'getCategorias'])->middleware('auth:sanctum');
/*Productos */

Route::resource('/administrar/productos', App\Http\Controllers\ProductosController::class)->middleware('auth:sanctum');
Route::post('administrar/productos/store', [App\Http\Controllers\ProductosController::class, 'store'])->middleware('auth:sanctum');
Route::post('administrar/gallery/SaveProducts', [App\Http\Controllers\GalleryController::class, 'SaveProducts'])->middleware('auth:sanctum');
Route::post('administrar/gallery/SaveProduct', [App\Http\Controllers\GalleryController::class, 'SaveProduct'])->middleware('auth:sanctum');
Route::post('administrar/gallery/UpdateImagesGallery', [App\Http\Controllers\GalleryController::class, 'UpdateImagesGallery'])->middleware('auth:sanctum');

/*Fin productos */

//Route::get('/productos', App\Http\Livewire\Productostable::class)->name('productos')->middleware('auth:sanctum');

