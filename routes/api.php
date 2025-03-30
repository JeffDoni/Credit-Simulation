<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\SimulacaoController;

Route::get('/instituicoes', [InstituicaoController::class, 'index']);
Route::get('/convenios', [ConvenioController::class, 'index']);
Route::post('/simulacao', [SimulacaoController::class, 'simular']);
