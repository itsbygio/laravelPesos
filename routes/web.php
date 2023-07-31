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
    return view('auth.login');
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


Route::get('/producto/{titulo}', [App\Http\Controllers\productid::class,'index']);
Route::get('/producto', function () {
    return redirect('/');
});
Route::get('/productos', function () {
    return redirect('/');
});
Route::get('/register', function () {
    return redirect('/');
});
Route::get('/{categoria}', [App\Http\Controllers\CategoriaController::class,'ListProducts']);
Route::get('/administrar/categorias', App\Http\Livewire\Admcategorias\Admcategorias::class)->middleware('auth');
Route::get('/administrar/usuarios', App\Http\Livewire\Admusuarios\Admusuarios::class)->middleware('auth');
Route::get('/administrar/productos', App\Http\Livewire\Admproductos\Admproductos::class)->middleware('auth');
Route::get('/administrar/ventas', App\Http\Livewire\Admventas\Admventas::class)->middleware('auth');
Route::get('/add/ventas', App\Http\Livewire\Addventas\Addventas::class)->middleware('auth');
Route::get('/factura',[App\Http\Controllers\VentasController::class, 'generateBill'])->middleware('auth');



Route::post('administrar/gallery/SaveProducts', [App\Http\Controllers\GalleryController::class, 'SaveProducts'])->middleware('auth:sanctum');
Route::post('administrar/gallery/SaveProduct', [App\Http\Controllers\GalleryController::class, 'SaveProduct'])->middleware('auth:sanctum');
Route::post('administrar/gallery/UpdateImagesGallery', [App\Http\Controllers\GalleryController::class, 'UpdateImagesGallery'])->middleware('auth:sanctum');


