<?php

use Illuminate\Http\Request;

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

/**
 * Pessoa
 */
Route::get('/pessoa','PessoaController@index');
Route::get('/pessoa/{id}','PessoaController@show');
Route::get('/pessoa/{id}/endereco','PessoaController@enderecoByIdPessoa');
Route::post('/pessoa', 'PessoaController@store');

/**
 * Endereco
 */
Route::get('/endereco','EnderecoController@index');
Route::get('/endereco/{id}','EnderecoController@show');



