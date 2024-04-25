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

`php artisan route:cache` -> para almacenar las rutas en caché en Laravel

`php artisan route:clear` -> para borrar la caché de rutas

`php artisan make:controller PostController` -> para crear un controlador

`php artisan make:controller PostController -r` -> para crear un controlador con los diferentes métodos  (index, create, store, etc)

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

### Validador de parámetros en rutas
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

## Nombrar Rutas
Nombrar las rutas es una buena práctica que facilita su referencia desde otras partes de tu aplicación, como las vistas, los controladores o incluso otras rutas. Los nombres de las rutas deben ser descriptivos y significativos para que sea fácil entender su propósito. Aquí tienes algunas pautas para nombrar tus rutas en Laravel:

en ser descriptivos y significativos para que sea fácil entender su propósito. Aquí tienes algunas pautas para nombrar tus rutas en Laravel:

1. Sé descriptivo: El nombre de la ruta debe reflejar claramente su propósito y lo que hace. Por ejemplo, si la ruta muestra el perfil de un usuario, podrías nombrarla 'perfil'.

2. Usa convenciones: Laravel proporciona algunas convenciones para nombrar rutas. Por ejemplo, si estás trabajando en un CRUD (Crear, Leer, Actualizar, Eliminar), puedes nombrar las rutas relacionadas de la siguiente manera: 'entidad.index', 'entidad.create', 'entidad.show', 'entidad.edit', etc.

3. Prefijos contextuales: Si tus rutas pertenecen a una sección específica de tu aplicación, como la administración, puedes prefijarlas con un nombre descriptivo para ese contexto. Por ejemplo, si tienes rutas para la administración de usuarios, podrías nombrarlas como 'admin.usuario.index', 'admin.usuario.edit', etc.

4. Evita nombres genéricos: Intenta evitar nombres de ruta genéricos como 'home' o 'pagina', ya que pueden ser confusos y difíciles de entender en un contexto más amplio.

5. Sé consistente: Mantén una convención de nomenclatura coherente en toda tu aplicación para facilitar la comprensión y el mantenimiento del código.

## Almacenar Rutas en Caché
Almacenar las rutas en caché en Laravel ofrece varias ventajas:

1. Mejor rendimiento: Cuando las rutas están en caché, Laravel no necesita analizar y compilar el archivo de rutas (routes/web.php y routes/api.php) en cada solicitud entrante. Esto puede mejorar significativamente el rendimiento de tu aplicación, especialmente en entornos de producción con un alto volumen de tráfico.

2. Menos carga en el servidor: Al reducir la necesidad de analizar y compilar las rutas en cada solicitud, se reduce la carga en el servidor, lo que puede permitir manejar más solicitudes concurrentes con los mismos recursos.

3. Estabilidad: Al almacenar las rutas en caché, se reduce la posibilidad de que cambios accidentales o maliciosos en los archivos de rutas afecten el funcionamiento de la aplicación en producción. Esto proporciona una capa adicional de estabilidad y seguridad.

4. Compatibilidad con entornos sin acceso de escritura: En entornos donde el servidor web no tiene permisos de escritura en el sistema de archivos, como en algunos servicios de hosting compartido, almacenar las rutas en caché permite utilizar Laravel sin necesidad de conceder permisos adicionales.
Para almacenar las rutas en caché en Laravel, puedes utilizar el comando artisan route:cache. Este comando generará un archivo optimizado que contiene todas las rutas definidas en tu aplicación, y Laravel utilizará este archivo en lugar de analizar el archivo de rutas en cada solicitud.

Es importante tener en cuenta que, después de hacer cambios en las rutas de tu aplicación, debes ejecutar **php artisan route:clear** para borrar la caché de rutas y luego ejecutar nuevamente **php artisan route:cache** para que las nuevas rutas se reflejen en la caché.

# Controladores
Los controladores en Laravel son una parte fundamental del patrón MVC (Modelo-Vista-Controlador) que Laravel sigue. Ayudan a mantener tu código limpio, organizado y fácil de mantener, al tiempo que proporcionan una capa intermedia entre la lógica de presentación y la lógica de negocio de tu aplicación.

1. Separación de preocupaciones: Los controladores permiten separar la lógica de presentación de la lógica de negocio. Esto ayuda a mantener tu código organizado y más fácil de mantener.

2. Manejo de solicitudes: Los controladores manejan las solicitudes HTTP entrantes y coordinan la respuesta adecuada. Esto incluye procesar datos de entrada, interactuar con el modelo de datos y devolver una respuesta al usuario.

3. Reutilización de código: Los controladores permiten reutilizar la lógica de negocio en diferentes partes de tu aplicación. Por ejemplo, puedes tener un controlador de usuarios que maneje todas las operaciones relacionadas con los usuarios, como registro, inicio de sesión, actualización de perfil, etc.

4. Enrutamiento claro y legible: Al usar controladores, puedes definir rutas que apunten a métodos específicos en esos controladores. Esto proporciona un enrutamiento claro y legible en tu aplicación.

5. Facilita las pruebas unitarias: Al separar la lógica de negocio en controladores, es más fácil escribir pruebas unitarias para validar el comportamiento de tu aplicación. Puedes probar cada método del controlador de forma aislada para asegurarte de que funciona correctamente.