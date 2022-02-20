<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use phpDocumentor\Reflection\PseudoTypes\False_;

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
    return view('welcome');
});

//Forma automatica de utilizar todas las clases dentro de el controlador.
Route::resource('empleado', EmpleadoController::class);


/*Route::get('/empleado', function () {

    return view('empleado.index');
});

//Agregando la ruta al controlador.
Route::get('/empleado/create',[EmpleadoController::class,'create']);  

//Agregadas las vistas de forma simple.

Route::get('/empleado/edit', function () {

    return view('empleado.edit');

});

Route::get('/empleado/form', function () {

    return view('empleado.form');

});*/
//
Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

//
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

//
Route::group(['prefix'=>'admin'], function(){

    Route::get('/', [EmpleadosController::class, 'index'])->name('home');

});