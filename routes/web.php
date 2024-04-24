<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Usando get para la pagina de contacto y post para enviar el formulario
Route::get('/contacto', function () {
    return 'Hola desde la página de contacto con método GET';
});
Route::post('/contacto', function () {
    return 'Hola desde la página de contacto con método POST';
});

// Usando match para que se puedan utilizar los dos metodos GET y POST 
Route::match(['get', 'post'], '/contacto2', function () {
    return 'Hola desde la página de contacto con match usando método GET y POST';
});