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