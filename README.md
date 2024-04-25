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

## Route Resource
Es una función en Laravel que te permite definir rápidamente todas las rutas necesarias para un controlador de recursos RESTful en tu aplicación. Un controlador de recursos es un controlador que implementa las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en tu aplicación.

Cuando defines las rutas de un recurso utilizando Route::resource, Laravel automáticamente genera una serie de rutas predefinidas que corresponden a las acciones CRUD típicas. Estas rutas siguen las convenciones RESTful y están diseñadas para trabajar con métodos HTTP estándar.

Las rutas generadas por Route::resource incluyen:
- GET /recurso para mostrar una lista de recursos.
- GET /recurso/create para mostrar el formulario de creación de un nuevo recurso.
- POST /recurso para almacenar un nuevo recurso.
- GET /recurso/{id} para mostrar un recurso específico.
- GET /recurso/{id}/edit para mostrar el formulario de edición de un recurso existente.
- PUT /recurso/{id} o PATCH /recurso/{id} para actualizar un recurso existente.
- DELETE /recurso/{id} para eliminar un recurso existente.

> Route::resource es una forma conveniente y rápida de definir rutas para un controlador de recursos en Laravel, lo que te permite mantener tu código limpio y organizado siguiendo las convenciones RESTful.

### Métodos para Route Resource
#### only()
Este método te permite especificar qué métodos de tu controlador de recursos deben tener rutas generadas. Por ejemplo, si solo necesitas las rutas para mostrar y almacenar recursos, puedes hacer lo siguiente:
```php
Route::resource('articulos', 'ArticuloController')
    ->only(['index', 'store']);
```
#### except(): 
Al contrario de only(), este método te permite excluir ciertos métodos de tu controlador de recursos de tener rutas generadas. Por ejemplo, si deseas excluir la ruta de eliminación de recursos, puedes hacer lo siguiente:
```php
Route::resource('articulos', 'ArticuloController')
    ->except(['destroy']);
```
#### parameters(): 
Este método te permite personalizar los nombres de los parámetros utilizados en las rutas generadas. Por ejemplo, si deseas que el parámetro para el identificador de tus recursos sea diferente de "id", puedes hacer lo siguiente:
```php
Route::resource('articulos', 'ArticuloController')
    ->parameters(['articulos' => 'articulo']);
```
#### names(): 
Este método te permite especificar nombres personalizados para las rutas generadas. Por ejemplo, si deseas que las rutas tengan nombres específicos en lugar de los nombres predeterminados generados por Laravel, puedes hacer lo siguiente:
```php
Route::resource('articulos', 'ArticuloController')
    ->names(
        [
            'index' => 'articulos.listado',
            'show' => 'articulos.ver',
            // Otros nombres personalizados...
        ]
    );
```
#### middleware(): 
Puedes usar este método para aplicar middleware específicos a las rutas generadas. Por ejemplo, si deseas aplicar un middleware de autenticación a todas las rutas del recurso articulos, puedes hacer lo siguiente:
```php
Route::resource('articulos', 'ArticuloController')
    ->middleware('auth');
```
#### namespace(): 
Si tu controlador está dentro de un namespace diferente al predeterminado, puedes usar este método para especificar el namespace del controlador. Por ejemplo, si tu controlador está dentro del namespace Admin, puedes hacer lo siguiente:
```php
Route::resource('articulos', 'Admin\ArticuloController')
    ->namespace('Admin');
```
#### prefix(): 
Si deseas agregar un prefijo a todas las rutas generadas para un recurso, puedes usar este método. Por ejemplo, si deseas que todas las rutas del recurso articulos tengan el prefijo admin, puedes hacer lo siguiente:
```php
Route::resource('articulos', 'ArticuloController')
    ->prefix('admin');
```
#### shallow(): 
Este método permite que Laravel evite generar rutas anidadas cuando el recurso tiene solo un nivel de profundidad. Por ejemplo, si tienes un recurso "comentarios" anidado bajo "articulos", usar shallow() evitará la generación de rutas anidadas y simplificará las rutas generadas.
```php
Route::resource('articulos.comentarios', 'ComentarioController')
    ->shallow();
```
#### scoped(): 
Este método te permite definir ámbitos personalizados para las rutas de tu controlador de recursos. Puedes usarlo para aplicar restricciones adicionales a las rutas generadas. Por ejemplo, en este ejemplo, se personaliza el parámetro de ruta de usuario a 'username' en lugar del 'id' predeterminado. También se excluye la ruta 'show', que normalmente muestra un usuario individual.:
```php
Route::resource('usuarios', 'UsuarioController')
    ->scoped(['usuario' => 'username'])
    ->except(['show']);
```
#### api(): 
Si deseas generar rutas de recursos para una API RESTful, puedes usar el método api() en lugar de resource(). Esto aplicará algunos comportamientos específicos de API, como la respuesta en formato JSON. Por ejemplo, este método genera rutas para un controlador de recursos, pero configura algunas opciones específicas de API de forma predeterminada.:
```php
Route::apiResource('productos', 'ProductoController');
```
#### singularResourceParameters(): 
Si deseas utilizar nombres de parámetros en singular en lugar de plural para las rutas generadas, puedes usar este método. Por ejemplo: esto hará que las rutas generadas utilicen 'equipo' en lugar de 'equipos' como nombre de parámetro en las rutas.
```php
Route::resource('equipos', 'EquipoController')->singularResourceParameters();
```
## Método __invoke()
Cuando un controlador tiene un método __invoke(), Laravel lo tratará como un controlador invocable, lo que significa que puedes usar el controlador como si fuera una función. Esto proporciona una sintaxis concisa y clara para definir controladores que solo realizan una acción específica.
El método __invoke() es útil cuando tienes un controlador que solo necesita manejar una acción específica, lo que hace que tu código sea más conciso y fácil de entender.