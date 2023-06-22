<?php

use App\Http\Controllers\DiagramController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MisDiagramas;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/misdiagramas',[DiagramController::class,'diagramas'] )->name('diagrama.misdiagramas');
    Route::get('/miscolaboraciones',[DiagramController::class,'misColaboraciones'] )->name('diagrama.miscolaboraciones');
    Route::get('/colaboradores/editar/{diagram}',[DiagramController::class,'editColaboradores'] )->name('diagrama.editar.colaboradores');
    Route::get('/diagrama/editar/{id}', [DiagramController::class,'editDiagrama'])->name('diagrama.edit');
    
    Route::get('/diagrama/edit', function () {
        return view('diagrama.prueba'); 
    })->name('diagrama.prueba');
    
});
