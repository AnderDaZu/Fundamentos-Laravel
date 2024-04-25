<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
// ruta con nombre
Route::get('/cursos/{id}', function ($id) {
    return 'Bienvenido al curso ' . $id;
})->name('cursos.show');
*/

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

// Rutas necesarias para crear un crud
// Ruta para mostrar el listado de posts
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
// Ruta para crear un nuevo post
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
// Ruta para guardar un nuevo post
Route::post('posts', [PostController::class, 'store'])->name( 'posts.store' );
// Ruta para mostrar detalle del post
Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
// Ruta para editar un post
Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
// Ruta para actualizar un post
Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
// Ruta para eliminar un post
Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
