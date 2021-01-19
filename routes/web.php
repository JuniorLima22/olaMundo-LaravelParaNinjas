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
    return view('welcome');
});

// Route::get('/contato', function(){
// 	return view('contato');
// });

Route::resource('/contato', 'ContatoController');

Route::resource('/produtos', 'ProdutosController');

Route::post('produtos/buscar', 'ProdutosController@buscar');

// Adicionando rotas em português
// Route::get('adicionar-produto', 'ProdutosController@create');

// Route::get('produtos/{id}/editar', 'ProdutosController@edit');
