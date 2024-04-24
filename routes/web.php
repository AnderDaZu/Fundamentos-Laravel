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
    // return view('welcome');
    return route('cursos.show', 1);
});

// ruta con nombre
Route::get('/cursos/{id}', function ($id) {
    return 'Bienvenido al curso ' . $id;
})->name('cursos.show');

/*
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
*/

/*
// rutas con parámetros -> cuando hay dos o más rutas con el mismo parámetro, podemos poner la ruta con parámetro fijo antes de la ruta con parámetro dinamico
Route::get('cursos/informatica', function () {
    return 'Bienvenido al curso de informatica, es un gran lenguaje de programación';
});
// los parámetros pueden ser nulos o no existir, por lo tanto se utiliza el simbolo de interrogación ? para indicar que el parámetro puede ser nulo o no existir
Route::get('cursos/{curso}/{profesor?}', function ($curso, $profesor = null) {
    if($profesor){
        return "Estás aprendiendo {$curso} con el profe: {$profesor}";
    }else{
        return "Estás aprendiendo: {$curso}";
    }
})
// ->where('curso', '[A-Za-z]+'); // where('curso','[A-Za-z]+' Se utiliza para validar que solo entre caracteres alfabeticos en el parametro curso
//->whereAlpha('curso'); // whereAlpha('curso') Se utiliza para validar que solo entre caracteres alfabeticos en el parametro curso
->whereAlphaNumeric('curso'); // whereAlphaNumeric('curso') Se utiliza para validar que solo entre caracteres alfanumericos en el parametro curso
*/