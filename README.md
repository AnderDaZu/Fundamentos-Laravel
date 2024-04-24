# Fundamentos-Laravel
Reforzando los fundamentos de Laravel

[TOCM]

[TOC]

# Comandos
`php artisan r:l` -> para listar las rutas

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
