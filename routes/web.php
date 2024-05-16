<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // paquete que permite realizar consultas a db

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

// Ruta la cual el controlador emplea el método __invoke
Route::get('/', HomeController::class)->name('home');

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
/*
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
*/
// Route::resource('posts2', PostController::class)
//     ->only(['index', 'create', 'store', 'show', 'edit']) // rutas a tener en cuenta
//     ->except(['update', 'destroy']) // rutas a omitir
//     ->parameters(['posts2' => 'post'])
//     ->names('posts');

// Si se necesitan rutas para una api, se emplea Route::apiResource()
// Route::apiResource('posts', PostController::class);

// Grupo de Rutas
Route::prefix('posts')->name('posts.')->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{post}', 'show')->name('show');
    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::put('/{post}', 'update')->name('update');
    Route::delete('/{post}', 'destroy')->name('destroy');
});

Route::get('/prueba', function () {
    $categories = DB::table('categories')
                ->select('id', 'name')
                ->where('id', 1)
                ->get(); // cuando se usa get, este retorna un array con objetos (resultados)
    /*
        [
            {
                ...resultado 1
            },
            {
                ...resultado 2
            } ...
        ]
    */

    $category = DB::table('categories')
                ->select('id', 'name')
                ->where('id', 1)
                ->first(); // cuando se usa first, este retorna un objeto (resultado) y es el primero del array
    /* 
        {
            ...resultado 1
        }
    */

    $category = DB::table('categories')
                ->select('id', 'name')
                ->find(4); // trae el registro cuyo id es igual a 4
    
    /*
        {
            ...resultado 4
        }
    */

    $categories = DB::table('categories')
                    ->pluck('name', 'id'); // devuelve un array asociativo donde los valores de id son las llaves y los valores de name son los valores
   
    /*
        [
            '1' => 'category 1',
            '2' => 'category 2',
        ]
    */
});
Route::get('/prueba2', function () {
    // Resultados de fragmentación
    DB::table('users')
        ->orderBy('id')
        ->chunk(100, function ($users) {
        // ->chunkById(100, function ($users) { // se usa cuando se requiere realizar actualizaciones
            // $users es un array de objetos
            foreach ($users as $user) {
                // echo $user->id . " - " . $user->name . "<br>";
            }
    });

    DB::table('users')
        ->orderBy('id')
        ->lazy()->each(function ($user) {
        // ->lazyById()->each(function($user){ // se usa cuando se requieran actualizar los datos
            echo $user->id . " - " . $user->name . "<br>";
    });

    $usuarios = User::query()->lazy();
    foreach ($usuarios as $user) { // Iterar sobre los resultados
        // Procesar cada usuario
        // if (intval($user->id) % 2 !== 0) continue;
        // echo $user->id . " - " . $user->name . "<br>";
    }
});

Route::get('/prueba3', function () {
    // return "Cantidad total de registros - " . DB::table('users')->count() . "<br>";
    // return "Numero menor de id - " . DB::table('users')->min('id') . "<br>";
    // return "Numero mayor de id - " . DB::table('users')->max('id') . "<br>";
    // return "Promedio de id - " . DB::table('users')->avg('id') . "<br>";
    // return ( DB::table('users')->where('id', 10000)->exists() ) ? 'Usuario existe' : 'Usuario no existe';
    return ( DB::table('users')->where('id', 1050)->doesntExist() ) ? 'Usuario no existe' : 'Usuario existe';
});

Route::get('/prueba4', function () {
    // return DB::table('users')->select('id', 'name', 'email')->get();
    DB::table('users')->select('id', 'name as title', 'email')->orderBy('id')->lazy(100)->each(function ($user) {
        echo $user->id . " - " . $user->title . "<br>";
    });
});

Route::get('/prueba5', function () {
    return DB::table('users')
        ->select('id', 'name', DB::raw("CONCAT(name, ' ', email) as 'name-email'"))
        ->selectRaw("CONCAT(id, name) as 'id-name'")
        ->whereRaw('id >= 5')
        ->where('id', '<=', 20)
        ->limit(100)
        ->get();
});

Route::get('/prueba6', function () {
    return DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->join('categories', 'posts.category_id', 'categories.id')
        ->select('posts.*', 'users.name as user_name', 'categories.name as category_name')
        ->get();
});

Route::get('/prueba7', function () {
    return DB::table('posts')
        // ->where('id', '>=', 5)
        // ->where('main_title', 'like', '%and%')
        ->where([
            ['id', '>=', 8],
            ['id', '<', 15]
        ])
        ->get();
});
