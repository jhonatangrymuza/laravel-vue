<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('imovel', 'api\ImovelController');

Route::apiResource('contrato', 'api\ContratoController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
