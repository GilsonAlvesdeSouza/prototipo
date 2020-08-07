<?php

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
    return redirect()->action('propriedadeController@index');
});

Route::get('/imoveis', 'propriedadeController@index');

Route::get('/imoveis/novo', 'propriedadeController@create');
Route::post('/imoveis/salvar', 'propriedadeController@salvar');

Route::get('/imoveis/{uri}', 'propriedadeController@listar');

Route::get('/imoveis/editar/{uri}', 'propriedadeController@editar');
Route::put('/imoveis/alterar/{uri}','propriedadeController@alterar');

Route::get('/imoveis/excluir/{uri}','propriedadeController@excluir');
