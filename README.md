# Fundamentos-Laravel
Reforzando los fundamentos de Laravel

[TOCM]

[TOC]

# Comandos
`php artisan r:l` -> para listar las rutas

`php artisan r:l --path=cursos` -> para listar rutas que inicien con 'cursos'

`php artisan r:l --except-vendor` -> para listar rutas que hayan sido definidas por nosotros, excluyendo a las que se crearon por algún paquete

`php artisan r:l --only-vendor` -> para listar rutas que hayn sido definidas por terceros o por algún paquete

`php artisan r:l --except-vendor -v` -> para listar y ver el middleware de las rutas que hayan sido definidas por nosotros

# Rutas
En Laravel, las rutas son definiciones que relacionan una URL específica con una acción del controlador o una función de cierre (closure). En otras palabras, las rutas permiten al framework dirigir las solicitudes HTTP entrantes a las clases y métodos adecuados para manejarlas.

Las rutas se definen principalmente en el archivo routes/web.php para rutas web y en routes/api.php para rutas de API. Las rutas pueden definirse de varias maneras, pero las más comunes son:

## Rutas básicas
Se definen utilizando los métodos get, post, put, delete, patch, options o any proporcionados por el enrutador de Laravel. Por ejemplo:
```php
Route::get('/ruta', function () {
    return 'Hola Mundo';
});
```

## Rutas con metodo match
El método `match` permite definir rutas que coincidan con varios verbos HTTP. Por ejemplo, para definir una ruta que funcione tanto para GET como para POST
```php
Route::match(['get', 'post'], '/contacto2', function () {
    return 'Hola desde la página de contacto con match usando método GET y POST';
});
```

## Rutas con parámetros
En Laravel, puedes definir rutas con parámetros que pueden ser nulos utilizando una interrogación (?) después del nombre del parámetro en la definición de la ruta. Esto indica que el parámetro es opcional y puede no estar presente en la URL. Aquí te muestro un ejemplo:
```php
Route::get('/usuario/{id?}', function ($id = null) {
    if ($id === null) {
        return 'No se proporcionó ningún ID de usuario.';
    } else {
        return 'Usuario con ID: ' . $id;
    }
});
```
En este ejemplo, la ruta /usuario/{id?} indica que la parte de la URL que sigue después de /usuario/ puede ser opcional, y se espera que sea un ID de usuario. Dentro de la función de cierre, se define el parámetro $id como null por defecto. Si no se proporciona ningún ID de usuario en la URL, se mostrará un mensaje indicando que no se proporcionó ningún ID. Si se proporciona un ID de usuario, se mostrará el mensaje junto con el ID.

Puedes usar esta técnica para manejar rutas donde algunos parámetros pueden estar presentes o ausentes en la URL. Esto proporciona flexibilidad en el manejo de las solicitudes y te permite diseñar rutas que se adapten a diferentes casos de uso en tu aplicación.

### Validador de parámetros en rutar
Laravel ofrece varias opciones para validar los parámetros de las rutas, ya sea directamente en la definición de la ruta, en los métodos de controlador o utilizando clases dedicadas para la validación de formularios. Esto te permite garantizar que los datos proporcionados cumplan con ciertos criterios antes de ser procesados por tu aplicación. Laravel ofrece varias formas de hacerlo:

1. Validación en la ruta: Puedes usar el método where al definir tus rutas para aplicar restricciones de validación a los parámetros. Por ejemplo, si quieres que un parámetro id sea un número entero, puedes hacer lo siguiente:
```php
Route::get('/usuario/{id}', function ($id) {
    // Acción de la ruta...
})->where('id', '[0-9]+');
```
En este caso, [0-9]+ es una expresión regular que especifica que el parámetro id debe consistir en uno o más dígitos numéricos.

2. Validación en el controlador: Puedes realizar la validación en los métodos de tus controladores utilizando las clases Request o FormRequest proporcionadas por Laravel. Por ejemplo:
```php
use Illuminate\Http\Request;
public function show(Request $request, $id) {
    $request->validate([
        'id' => 'required|numeric',
    ]);
    // Resto del código...
}
```
En este ejemplo, se está utilizando la clase Request para acceder a los datos de la solicitud y el método validate para definir las reglas de validación. Esto asegura que el parámetro id sea requerido y numérico.

3. Validación global en RouteServiceProvider: En Laravel, al agregar la línea de código Route::pattern('id', '[0-9]+'); en el archivo RouteServiceProvider, estás definiendo un patrón de expresión regular que se aplicará automáticamente a cualquier parámetro de ruta llamado 'id'
