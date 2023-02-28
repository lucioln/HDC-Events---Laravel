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
use \App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
Route::get('/event/create', [EventController::class, 'create']);


Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dinamico', function () {
    $nome = 'Lucio Noleto';
    $array = [1,2,3,4,5,6];

    return view('dinamico',
    ['nome' => $nome,
    'array' => $array]);
});

Route::get('produto/{id}', function ($id) {
    return view('product', ['id' => $id]);
});

Route::get('parametro_opcional/{id?}', function ($id = null){ //É necessário passar um valor default em parametros opcionais
    return view('product', ['id' => $id]);
});
