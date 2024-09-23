<?php


use App\Http\Controllers\ahorcadoController;
use App\Http\Controllers\crudController;
use App\Http\Controllers\trabajounoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('actividad/{numero}/{segundo?}/{fibonacci?}', [trabajounoController::class, 'index'])
->where('numero','[0-9]+')
->where('segundo','[0-9]+')
->where('fibonacci','fibonacci');

Route::post('peticionForm', [trabajounoController::class, 'peticionForm']);

//route::post('insertarEnBase/{nombre}/{apellido_paterno}/{apellido_materno?}', [trabajounoController::class, 'insertarEnBase']);
route::post('insertarEnBase', [trabajounoController::class, 'insertarEnBase']);


//Links para la Actividad Crud de personas
route::get('leerPersona/{id}',[crudController::class,'index']);
route::post('crearPersona', [crudController::class, 'store']);
route::post('modificarPersona/{id}', [crudController::class, 'update']);
route::delete('borrarPersona/{id}', [crudController::class, 'destroy']);

//Ahorcado
route::post('reiniciarVariables', [ahorcadoController::class, 'reiniciarVariables']);
route::post('start', [ahorcadoController::class, 'start']);

route::post('game/{dificultad}/{palabra?}', [ahorcadoController::class, 'game'])
->where('palabra', '[a-z]');

//Nuevo ahorcado
route::post('juego/{dificultad}/{palabra?}', [ahorcadoController::class, 'game']);
//    ->where('palabra', '[a-z]');



