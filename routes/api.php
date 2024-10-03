<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\CuentaController; //llamando al controlador
use App\http\Controllers\HistorialTransaccioneController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/cuentas', 'CuentaController@listar_cuentas'); //listar usuario
Route::get('/detalle_cuenta/{id}', 'HistorialTransaccioneController@ver_detalle_cuenta'); //Detalle de la cuenta
Route::resource('/retiro','HistorialTransaccioneController');  //Retiro
Route::resource('/transferencia','CuentaController');  //Transferencia





/* Este es MICROSERVICIO, ya son pequeñas funciones que se aplica en una arquitectura de Software  
como un proyecto: 

backend : microservicios 
      
Front end : Es donde consume los servicios pequeños, para que la WEB sea dinámica como un Software

API: Son integraciones de un Sistema a otro Sistema, en este caso no se aplica ya que no se trata de 
una inrtegracion ajena al servidor:

Ejemplo:

La integración de Sunat

*/ 