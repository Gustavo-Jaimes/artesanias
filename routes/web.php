<?php

use Illuminate\Support\Facades\Route;




Auth::routes();

Route::group(['prefix'=>'admin','middleware' => 'auth'], function(){
    // ruta de administracion
    
    Route::resource('/configuracion', App\Http\Controllers\Admin\ConfiguracionController::class);  

    Route::resource('/categoria', App\Http\Controllers\Admin\CategoriaController::class); 
    Route::resource('/producto', App\Http\Controllers\Admin\ProductoController::class);   
    Route::resource('/post', App\Http\Controllers\Admin\PostController::class);

    
    Route::resource('/carrusel', App\Http\Controllers\Admin\CarruselController::class);
    /*  
    Route::resource('/empresa', App\Http\Controllers\Admin\EmpresaController::class);   
    Route::resource('/suscriptores', App\Http\Controllers\Admin\SuscriptoresController::class); 
*/
});


// rutas publicas
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('home');

Route::get('/empresa', [App\Http\Controllers\FrontController::class, 'empresa']);
Route::get('/artesanias', [App\Http\Controllers\FrontController::class, 'artesanias']);
Route::get('/artesanias/{categoria}', [App\Http\Controllers\FrontController::class, 'categoria']);
Route::get('/artesanias/{categoria}/{producto}', [App\Http\Controllers\FrontController::class, 'producto']);
Route::get('/blog', [App\Http\Controllers\FrontController::class, 'blog']);
Route::get('/blog/{post}', [App\Http\Controllers\FrontController::class, 'post']);

Route::get('/contacto', [App\Http\Controllers\FrontController::class, 'contacto']);