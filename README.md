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

`php artisan make:provider ViewServiceProvider` -> para crear un provider

`php artisan make:component NameComponent` -> para crear un componente

`php artisan migrate` -> para ejecutar las migraciones de la base de datos

`php artisan migrate:roolback` -> para revertir la última migración que se haya ejecutado en la base de datos

`php artisan make:migration nameMigration` -> para crear una migración

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

## Grupo de Rutas
Un grupo de rutas te permite agrupar un conjunto de rutas relacionadas para aplicarles middleware, prefijos de URI comunes, nombres de ruta o cualquier otra configuración que desees aplicar de manera global a ese conjunto de rutas.
**Uso:**  Se usa cuando deseas aplicar ciertas configuraciones a un grupo de rutas, como middleware, prefijos de URI o nombres de ruta compartidos.
**Ejemplo:**
```php
Route::group(['middleware' => 'auth'], function () {
    Route::get('/perfil', 'PerfilController@show')->name('perfil');
    Route::get('/ajustes', 'AjustesController@index')->name('ajustes');
});
``` 
### Grupo de Rutas vs Route Resource
Un grupo de rutas se utiliza para aplicar configuraciones comunes a un conjunto de rutas, mientras que Route::resource se utiliza para definir rápidamente rutas para un controlador que sigue el patrón RESTful. Puedes usarlos juntos en tu aplicación dependiendo de tus necesidades específicas. Por ejemplo, podrías envolver un Route::resource dentro de un grupo de rutas para aplicar middleware a todas las rutas generadas por Route::resource.

# Vistas
## Pasar parámetros a vistas
Para pasar parámetros a las vistas desde el controlador en Laravel, puedes utilizar el método with() o compact() en la respuesta de la vista. Estos métodos te permiten enviar datos a la vista para que puedan ser accesibles desde el archivo de plantilla de Blade.
### Método with()
Aquí tienes un ejemplo de cómo pasar parámetros a una vista desde el controlador utilizando el método with():
```php
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index')->with('usuarios', $usuarios);
    }
}
```
En este ejemplo, $usuarios es una colección de objetos User que queremos pasar a la vista usuarios.index. Usamos el método with() para pasar esta colección a la vista con el nombre 'usuarios'.
También puedes pasar múltiples parámetros a la vista separándolos por coma dentro del método with():
```php
return view('usuarios.index')->with('usuarios', $usuarios)->with('titulo', 'Lista de usuarios');
```
### Método compact()
Otra forma de pasar parámetros a las vistas es utilizando el método compact(), que toma una lista de nombres de variables y crea un array asociativo donde las claves son los nombres de las variables y los valores son los valores de esas variables:
```php
return view('usuarios.index', compact('usuarios', 'titulo'));
```
En este ejemplo, compact('usuarios', 'titulo') es equivalente a ['usuarios' => $usuarios, 'titulo' => $titulo].
Una vez que has pasado los parámetros a la vista desde el controlador, puedes acceder a ellos en el archivo de plantilla de Blade correspondiente utilizando la sintaxis de doble corchete ({{ $nombre_variable }}). Por ejemplo:
```php
@foreach($usuarios as $usuario)
    {{ $usuario->nombre }}
@endforeach
```
### Método View::share(key, value): para pasar parámetros a todas las vistas
Se utiliza para compartir datos con todas las vistas de tu aplicación. Esto significa que puedes definir ciertos datos una vez y hacer que estén disponibles para todas las vistas sin tener que pasar explícitamente esos datos a cada vista desde el controlador.
Por ejemplo, si tienes datos que necesitas mostrar en el encabezado o pie de página de todas las páginas de tu sitio web, puedes compartir esos datos utilizando View::share() en un servicio de proveedor de Laravel, como AppServiceProvider. Esto evita que tengas que pasar esos datos desde cada controlador a cada vista, lo que puede ser tedioso y repetitivo.
**Ejemplo práctico:**
```php
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::share('nombre_sitio', 'Mi Sitio Web');
    }
}
```
En este ejemplo, estamos compartiendo la variable $nombre_sitio con todas las vistas de la aplicación, lo que significa que ahora puedes acceder a esta variable en cualquier vista sin tener que pasarla explícitamente desde el controlador.

> Esto es útil para datos globales que necesitas en muchas partes de tu aplicación y simplifica la gestión de esos datos al compartirlos automáticamente con todas las vistas. Sin embargo, debes tener cuidado al usar View::share() para no sobrecargar las vistas con demasiados datos innecesarios, ya que esto podría afectar negativamente al rendimiento de tu aplicación.

## Provider exclusivo para vistas
Los proveedores de servicios en Laravel son clases responsables de inicializar y configurar varios componentes de la aplicación durante el proceso de arranque. Proporcionan una forma conveniente de registrar enlaces de servicios, enlaces de interfaz y configuración de cualquier componente de la aplicación.

>Aquí hay algunas de las principales funciones que los proveedores de servicios realizan en Laravel:
1. Registro de servicios: Los proveedores de servicios son responsables de registrar los servicios de la aplicación en el contenedor de servicios de Laravel. Esto incluye la configuración de enlaces de servicios, que permite a la aplicación acceder a clases o instancias específicas a través de la inyección de dependencias o el contenedor de servicios.
2. Configuración de alias de clase: Los proveedores de servicios pueden configurar alias de clase, que son atajos que permiten acceder a clases específicas mediante un nombre corto. Esto simplifica el código al permitir que los desarrolladores utilicen nombres más cortos y legibles para acceder a clases complejas.
3. Inicialización de configuraciones: Los proveedores de servicios pueden inicializar la configuración de la aplicación, cargar archivos de configuración y proporcionar valores predeterminados para diversas opciones de configuración.
4. Registro de eventos y listeners: Algunos proveedores de servicios pueden registrarse en eventos y listeners de eventos en la aplicación. Esto permite que la aplicación responda a eventos específicos y realice acciones correspondientes.
5. Integración de paquetes y bibliotecas externas: Los proveedores de servicios también se utilizan para integrar paquetes y bibliotecas externas en la aplicación Laravel. Esto puede incluir la configuración de proveedores de servicios de terceros para que funcionen de manera adecuada en el contexto de la aplicación.
> Los proveedores de servicios son una parte fundamental de la arquitectura de Laravel y juegan un papel importante en la configuración y puesta en marcha de la aplicación. Proporcionan un punto centralizado para registrar y configurar diversos componentes de la aplicación, lo que facilita la gestión y la organización del código.

Para crear un nuevo provider desde terminar, se ejecuta el comando: `$ php artisan make:provider NameServiceProvider`
Luego para que Laravel reconozca esa clase como provider, éste se debe registrar en el archivo config/app.php en la parte del arreglo donde se agregan los providers
```php
return [
    
    'providers' => ServiceProvider::defaultProviders()->merge([
        // ...others providers
        App\Providers\NameServiceProvider::class,
    ])->toArray(),
]
```

## View Composer
En Laravel, los View Composers son una forma de compartir datos con varias vistas de manera eficiente y reutilizable. Permiten ejecutar lógica específica antes de que una vista sea renderizada, lo que te permite pasar datos dinámicos a tus vistas de forma automática sin tener que hacerlo manualmente en cada método del controlador.

Aquí tienes un resumen de para qué sirve y cómo se utiliza un View Composer en Laravel:
1. Compartir datos con vistas específicas: Los View Composers te permiten compartir datos con una o más vistas específicas. Esto es útil cuando necesitas que ciertos datos estén disponibles en múltiples vistas de tu aplicación.
2. Ejecutar lógica antes de renderizar la vista: Puedes ejecutar cualquier lógica necesaria para obtener los datos que deseas compartir con la vista dentro de un View Composer. Esto podría incluir consultas a la base de datos u operaciones de procesamiento de datos.
3. Organización del código: Los View Composers te permiten mantener tu código limpio y organizado al separar la lógica de presentación de la lógica de negocio. Esto hace que tus controladores sean más delgados y tus vistas más simples y fáciles de entender.
4. Reutilización de código: Puedes reutilizar View Composers en diferentes partes de tu aplicación para compartir los mismos datos con múltiples vistas. Esto evita la duplicación de código y facilita la gestión de datos compartidos.
5. Flexibilidad: Los View Composers te ofrecen flexibilidad en cuanto a cuándo y dónde se comparten los datos con las vistas. Puedes definir View Composers en cualquier lugar, como en archivos de proveedores de servicios, archivos de rutas o incluso directamente en tus archivos de rutas web.
Aquí tienes un ejemplo básico de cómo se utiliza un View Composer en Laravel:
```php
use Illuminate\Support\Facades\View;
View::composer('mi.vista', function ($view) {
    $view->with('nombre', 'John Doe');
});
```
En caso de crearse un archivo en **app/View/Composers/ArchivoComposer.php**, se debe especificar en AppServiceProvider o algún otro archivo similar (ViewServiceProvider) que dicho composer creado se aplique a ciertas rutas, **por ejemplo:**
```php
View::composer('posts.*', ArchivoComposer::class);
```

# Blade

Blade es el motor de plantillas predeterminado de Laravel, diseñado para hacer que escribir vistas en Laravel sea simple y expresivo. Blade proporciona una sintaxis concisa y poderosa para definir las vistas de tu aplicación. Algunas de las características principales de Blade incluyen:
1. Sintaxis sencilla: Blade utiliza una sintaxis sencilla y familiar, que se asemeja al código HTML, para definir las vistas. Esto hace que sea fácil para los desarrolladores leer y escribir código de plantilla.
2. Herencia de plantillas: Blade permite la creación de plantillas maestras y la extensión de estas plantillas en otras vistas. Esto facilita la creación de diseños consistentes en toda la aplicación.
3. Directivas de control: Blade proporciona directivas de control simples y expresivas, como @if, @foreach, @forelse, @while, etc., que te permiten incluir lógica de programación en tus vistas de manera clara y legible.
4. Inyección de contenido: Blade ofrece directivas para inyectar contenido dinámico en las vistas, como {{ $variable }} para imprimir el contenido de una variable, @yield para definir secciones que pueden ser reemplazadas en vistas secundarias, y @include para incluir otras vistas parciales en una vista principal.
5. Compilación de plantillas: Blade compila las plantillas en código PHP puro, lo que significa que las vistas Blade se convierten en archivos PHP en tiempo de compilación. Esto mejora el rendimiento de tu aplicación al reducir la sobrecarga de procesamiento en tiempo de ejecución.

## Formas para mostrar contenido en las vistas
### {{ }} (Escapado automático):
- Esta es la forma más común de mostrar contenido dinámico en las vistas de Blade.
- Todo el contenido mostrado dentro de {{ }} será escapado automáticamente para prevenir ataques XSS (cross-site scripting). Esto significa que cualquier carácter HTML especial será convertido en su equivalente HTML seguro.
- Es recomendable utilizar {{ }} siempre que estés mostrando contenido del usuario o de una fuente externa para garantizar la seguridad de tu aplicación.
### {!! !!} (Sin escapado):
- Esta forma permite mostrar contenido HTML sin escapar en las vistas de Blade.
- A diferencia de {{ }}, el contenido dentro de {!! !!} no será escapado, lo que significa que se mostrará tal cual.
- Debes tener cuidado al usar {!! !!} para evitar ataques XSS. Asegúrate de que el contenido que estás mostrando es seguro y proviene de una fuente confiable.

> En resumen, {{ }} se utiliza para mostrar contenido de forma segura, escapando automáticamente cualquier carácter HTML especial, mientras que {!! !!} se utiliza para mostrar contenido HTML sin escapar, lo que puede ser útil cuando necesitas mostrar HTML generado dinámicamente en tus vistas. Es importante entender la diferencia entre estas dos formas y utilizar la más adecuada según las necesidades de tu aplicación y la seguridad del contenido que estás mostrando.

## Evitar conflicto con sintaxis de frameworks de js
La sintaxis @{{ $variable }} en Laravel Blade se utiliza para imprimir literalmente las llaves dobles {{ }} en la salida HTML de la vista, sin procesar el contenido dentro de ellas como una variable de Blade.
Por defecto, en las vistas de Blade, si escribes {{ $variable }}, Laravel procesará y evaluará la variable $variable y luego imprimirá su valor en la salida HTML. Sin embargo, en algunos casos, puede que necesites imprimir las llaves dobles literalmente sin que Laravel las procese.
Por ejemplo, si estás trabajando con un framework de JavaScript que también utiliza la sintaxis {{ }} para sus plantillas, puedes encontrarte con un conflicto en las vistas de Blade. En este caso, puedes usar @{{ }} para evitar el conflicto y asegurarte de que las llaves dobles se impriman literalmente en la salida HTML.
**Ejemplo:**
```js
var appData = {
    name: "@{{ $name }}",
    age: {{ $age }},
    // Otros datos
};
```

## Directiva @json()
La directiva Blade @json en Laravel se utiliza para convertir automáticamente una variable de PHP en una representación JSON válida. Esta directiva es útil cuando necesitas pasar datos de PHP a JavaScript en tus vistas de Blade de una manera segura y conveniente.
Cuando utilizas @json en tu vista de Blade, Laravel convierte automáticamente la variable proporcionada en su representación JSON y la imprime en la salida HTML.
Por ejemplo, supongamos que tienes una variable de PHP llamada $datos que contiene un array asociativo que deseas pasar a JavaScript. Puedes utilizar la directiva @json para convertir este array en JSON y hacerlo accesible en tu código JavaScript.
**Ejemplo:**
```js
let datos = @json($datos);
console.log(datos);
```
En este ejemplo, $datos se convierte automáticamente en su representación JSON y se asigna a la variable datos en JavaScript. Luego, puedes usar console.log() para imprimir los datos en la consola del navegador.
Esta es una forma conveniente y segura de pasar datos de PHP a JavaScript en tus vistas de Blade, ya que Laravel se encarga de garantizar que los datos se conviertan en JSON de manera adecuada y segura. Además, esto te ayuda a evitar problemas de seguridad, como la inyección de código malicioso, al garantizar que los datos se escapen correctamente antes de ser impresos en la salida HTML.

## Directivas Condicionales
### Directiva @if()
Esta directiva permite ejecutar un bloque de código si una expresión dada evalúa como verdadera.
**Ejemplo:**
```blade
@if($usuario->activo)
    El usuario está activo.
@else
    El usuario está inactivo.
@endif
```
### Directiva @unless()
Similar a @if, pero ejecuta un bloque de código si una expresión dada evalúa como falsa.
**Ejemplo:**
```blade
@unless($usuario->premium)
    No eres usuario premium.
@endunless
```
### Directiva @isset() 
Verifica si una variable está definida y no es nula.
**Ejemplo:**
```blade
@isset($usuario->nombre)
    El nombre del usuario es {{ $usuario->nombre }}.
@endisset
```
### Directiva @empty() 
Verifica si una variable está vacía. Esto incluye valores nulos, cadenas vacías, matrices vacías, objetos vacíos y variables no definidas.
**Ejemplo:**
```blade
@empty($usuarios)
    No hay usuarios disponibles.
@else
    Lista de usuarios:
    @foreach($usuarios as $usuario)
        {{ $usuario->nombre }},
    @endforeach
@endempty
```

> Estas directivas Blade proporcionan una forma conveniente y legible de realizar operaciones condicionales y verificar la existencia y el estado de las variables en las plantillas Blade de Laravel. Son muy útiles para personalizar la salida de las vistas en función de datos dinámicos y condiciones específicas.

## Directiva @env
La directiva Blade @env en Laravel te permite condicionar el contenido de tus vistas basado en el entorno de tu aplicación. Puedes usar esta directiva para mostrar u ocultar ciertas partes de tu vista dependiendo del entorno en el que se esté ejecutando tu aplicación.
La sintaxis general de @env es la siguiente:
```blade
@env('entorno')
    // Contenido a mostrar si la aplicación está en el entorno especificado
@endenv

@env(['entorno1', 'entorno2'])
    // Contenido a mostrar si la aplicación está en cualquiera de los entornos especificados
@endenv
```
> Esta directiva Blade es útil para condicionar el contenido de tus vistas en función del entorno de tu aplicación, lo que te permite personalizar la salida según sea necesario para el desarrollo, pruebas o producción.

## Directiva @switch
La directiva Blade @switch en Laravel proporciona una forma conveniente de escribir estructuras de control switch en tus vistas Blade. Esta directiva te permite comparar una expresión con varios casos y ejecutar un bloque de código correspondiente al caso coincidente.
La estructura de la directiva @switch es similar a la estructura de control switch de PHP. 
Aquí tienes un ejemplo básico de cómo usar @switch en una vista Blade:
```blade
@switch($opcion)
    @case(1)
        Opción 1 seleccionada
        @break

    @case(2)
        Opción 2 seleccionada
        @break

    @default
        Opción no válida
@endswitch
```
El uso de la directiva Blade @switch puede hacer que tu código sea más legible y conciso cuando necesitas realizar una comparación de múltiples casos en tus vistas Blade. Es una forma conveniente de escribir estructuras de control switch directamente en tus plantillas sin tener que escribir código PHP dentro de ellas.

## Directiva @foreach
En Laravel Blade, la directiva @foreach es una herramienta poderosa que te permite iterar sobre una colección de elementos y ejecutar un bloque de código para cada elemento de la colección. Es una forma conveniente de generar contenido dinámico en tus vistas Blade, especialmente cuando trabajas con conjuntos de datos que pueden variar en tamaño.
La sintaxis básica de la directiva @foreach es la siguiente:
```blade
@foreach($coleccion as $elemento)
    <!-- Código HTML o Blade que se repetirá para cada elemento -->
    {{ $elemento }}
@endforeach
```
> La directiva @foreach es útil cuando necesitas mostrar una lista de elementos, como resultados de consultas de base de datos, elementos de un arreglo o cualquier otra colección de datos en tus vistas Blade. Te permite generar dinámicamente contenido HTML basado en los datos disponibles en tu aplicación.

## Directiva @forelse
La directiva @forelse en Laravel Blade es una variante de la directiva @foreach, diseñada específicamente para trabajar con estructuras de datos que pueden estar vacías. Proporciona una forma conveniente de iterar sobre una colección de elementos y manejar el caso en que la colección esté vacía.
La sintaxis de @forelse es similar a la de @foreach, pero incluye una sección adicional para manejar el caso en que la colección esté vacía.
Aquí tienes un ejemplo de cómo se utiliza @forelse en una vista Blade:
```blade
<ul>
    @forelse ($usuarios as $usuario)
        <li>{{ $usuario->nombre }}</li>
    @empty
        <li>No hay usuarios</li>
    @endforelse
</ul>
```
> La principal diferencia entre @forelse y @foreach es que @forelse maneja automáticamente el caso en que la colección esté vacía, lo que elimina la necesidad de realizar una comprobación adicional antes de iterar sobre la colección. Esto hace que el código sea más conciso y fácil de leer cuando trabajas con colecciones que pueden estar vacías.
 ## Directivas @for y @while
En Laravel Blade, las directivas @for y @while son estructuras de control que te permiten realizar bucles for y while directamente en tus vistas Blade. Estas directivas proporcionan una forma conveniente de generar contenido dinámico en tus plantillas sin necesidad de escribir código PHP directamente en ellas.
### Directiva @for:
La directiva @for te permite ejecutar un bucle for en tus vistas Blade. Te permite iterar sobre un rango de valores específico y ejecutar un bloque de código repetidamente.
```blade
@for ($i = 0; $i < 5; $i++)
    <p>{{ $i }}</p>
@endfor
```
### Directiva @while:
La directiva @while te permite ejecutar un bucle while en tus vistas Blade. Te permite ejecutar un bloque de código repetidamente mientras se cumpla una condición específica.
```blade
@php
    $i = 0;
@endphp
@while ($i < 5)
    <p>{{ $i }}</p>
    @php
        $i++;
    @endphp
@endwhile
```
> Estas directivas son útiles cuando necesitas generar contenido dinámico basado en datos o realizar operaciones repetitivas en tus vistas Blade. Sin embargo, debes tener cuidado de no sobrecargar tus vistas con lógica de presentación compleja. Si necesitas realizar operaciones más complejas, es recomendable mover la lógica a los controladores o servicios de Laravel y pasar los datos necesarios a tus vistas Blade de manera más limpia y organizada.

## Directivas @continue y @break
En Laravel Blade, las directivas @continue y @break son utilizadas para controlar el flujo de ejecución dentro de bucles @foreach, @for y @while en tus vistas Blade.
### La directiva @continue 
Se utiliza para omitir la iteración actual en un bucle y continuar con la siguiente iteración. Esto significa que si se encuentra una directiva @continue dentro de un bucle, el código restante dentro de esa iteración será ignorado y el bucle pasará a la siguiente iteración.
**Ejemplo de uso de @continue:**
```blade
@foreach($usuarios as $usuario)
    @if ($usuario->estado == 'inactivo')
        @continue
    @endif
    {{ $usuario->nombre }}
@endforeach
```
En este ejemplo, si el estado del usuario es "inactivo", se omitirá la impresión del nombre del usuario y se pasará a la siguiente iteración del bucle.
### La directiva @break 
Se utiliza para salir completamente del bucle en el que se encuentra y continuar con la ejecución del código fuera del bucle. Esto significa que cuando se encuentra una directiva @break dentro de un bucle, el bucle se terminará inmediatamente y el código continuará ejecutándose después del bucle.
**Ejemplo de uso de @break:**
```blade
@foreach($usuarios as $usuario)
    @if ($usuario->id == $idBuscado)
        {{ $usuario->nombre }}
        @break
    @endif
@endforeach
```
En este ejemplo, una vez que se encuentra el usuario con el ID buscado, se imprime su nombre y luego se sale del bucle utilizando @break. Esto evita que el bucle siga iterando innecesariamente una vez que se ha encontrado el usuario buscado.

> En resumen, @continue se utiliza para omitir la iteración actual y pasar a la siguiente iteración en un bucle, mientras que @break se utiliza para salir completamente del bucle y continuar con la ejecución del código fuera del bucle. Estas directivas son útiles para controlar el flujo de ejecución dentro de bucles en tus vistas Blade.

## Variable $loop
La variable $loop en las vistas Blade de Laravel proporciona información útil sobre el estado actual de la iteración en un bucle @foreach. Esta variable es automáticamente disponible dentro de los bucles @foreach y contiene varias propiedades que puedes utilizar para realizar acciones basadas en el estado de la iteración actual. Aquí hay algunas formas comunes en las que puedes utilizar la variable $loop en tus vistas Blade:
1. Contador de iteración: Puedes utilizar la propiedad index de la variable $loop para obtener el índice de la iteración actual. Esta propiedad comienza desde 0 y se incrementa en cada iteración. Es útil cuando necesitas saber la posición relativa del elemento dentro del bucle.
```blade
@foreach($usuarios as $usuario)
    {{ $loop->index }}: {{ $usuario->nombre }}
@endforeach
```
2. Contador de iteración empezando en 1: Si deseas que el contador de iteración comience en 1 en lugar de 0, puedes usar la propiedad iteration.
```blade
@foreach($usuarios as $usuario)
    {{ $loop->iteration }}: {{ $usuario->nombre }}
@endforeach
```
3. Última iteración: La propiedad last de la variable $loop indica si la iteración actual es la última en el conjunto de datos. Es útil para realizar acciones específicas en la última iteración.
```blade
@foreach($usuarios as $usuario)
    {{ $usuario->nombre }}
    @if ($loop->last)
        Este es el último usuario.
    @endif
@endforeach
```
4. Primer iteración: La propiedad first indica si la iteración actual es la primera en el conjunto de datos. Es útil para realizar acciones específicas en la primera iteración.
```blade
@foreach($usuarios as $usuario)
    @if ($loop->first)
        Este es el primer usuario.
    @endif
    {{ $usuario->nombre }}
@endforeach
```
5. Cantidad total de iteraciones: La propiedad count indica el número total de elementos en el conjunto de datos que estás iterando.
```blade
<p>Total de usuarios: {{ $usuarios->count() }}</p>
```
6. Parent loop: Si estás anidando bucles @foreach, puedes acceder al loop padre utilizando la propiedad parent.
```blade
@foreach($categorias as $categoria)
    <h2>{{ $categoria->nombre }}</h2>
    @foreach($categoria->productos as $producto)
        <p>{{ $producto->nombre }}</p>
        <span>Iteración en el bucle padre: {{ $loop->parent->iteration }}</span>
    @endforeach
@endforeach
```
> Estas son algunas formas comunes en las que puedes utilizar la variable $loop en tus vistas Blade para realizar acciones basadas en el estado de la iteración actual en los bucles @foreach. Es una herramienta muy útil para hacer que tus plantillas Blade sean más dinámicas y flexibles.

## Directiva @class
La directiva @class en Laravel Blade se utiliza para agregar clases CSS condicionalmente a los elementos HTML en tus plantillas Blade. Esta directiva es útil cuando necesitas aplicar clases CSS basadas en ciertas condiciones, como valores de variables o el estado de una condición.
Aquí tienes algunos casos comunes en los que la directiva @class puede ser útil:
1. Aplicar clases condicionales basadas en valores de variables: Puedes usar @class para aplicar clases CSS a un elemento HTML basadas en los valores de las variables en tus vistas Blade. 
*Por ejemplo:*
```blade
<div class="@class(['active' => $activo, 'disabled' => !$habilitado])">
    Contenido del elemento
</div>
```
En este ejemplo, la clase active se aplicará si la variable $activo es verdadera, y la clase disabled se aplicará si $habilitado es falso.
2. Aplicar clases condicionales basadas en valores de datos dinámicos: Puedes usar @class para aplicar clases CSS basadas en los valores de datos dinámicos provenientes de la base de datos o de otras fuentes. 
*Por ejemplo:*
```blade
<ul>
@foreach($items as $item)
    <li class="@class(['featured' => $item->destacado, 'new' => $item->nuevo])">
        {{ $item->nombre }}
    </li>
@endforeach
</ul>
```
En este ejemplo, la clase featured se aplicará si $item->destacado es verdadero, y la clase new se aplicará si $item->nuevo es verdadero.
3. Aplicar clases condicionales basadas en el contexto de la ruta actual: Puedes usar @class para aplicar clases CSS basadas en el nombre de la ruta actual o en el segmento de la URL. Por ejemplo:
```blade
<a href="{{ route('home') }}" class="@class(['active' => request()->routeIs('home')])">Inicio</a>
```
En este ejemplo, la clase active se aplicará si la ruta actual coincide con la ruta con nombre 'home'.

> La directiva @class proporciona una forma conveniente y legible de aplicar clases CSS condicionalmente en tus plantillas Blade, lo que te permite mantener tu código limpio y modular. Puedes usarla en una variedad de casos para adaptar dinámicamente el aspecto de tus elementos HTML según las condiciones específicas de tu aplicación.

## Directivas @include, @includeIf, @includeWhen, @includeUnless, @includeFirst
Estas directivas son utilizadas en Laravel Blade para incluir otras vistas dentro de una vista principal. Esto permite la reutilización de código y la organización modular de las vistas.
### @include:
Esta directiva se utiliza para incluir una vista específica dentro de otra vista. Puedes usarla para incluir encabezados, pies de página, barras laterales u otros componentes reutilizables.
Sintaxis: @include('nombre_de_la_vista').
### @includeIf:
Similar a @include, pero solo incluirá la vista si una condición dada es verdadera o si la vista existe.
Sintaxis: @includeIf(condición, 'nombre_de_la_vista').
### @includeWhen:
Similar a @includeIf, pero permite especificar la vista a incluir como un tercer parámetro en lugar de una cadena.
Sintaxis: @includeWhen(condición, 'nombre_de_la_vista', ['parámetros']).
### @includeUnless:
Similar a @includeIf, pero incluirá la vista solo si una condición dada es falsa.
Sintaxis: @includeUnless(condición, 'nombre_de_la_vista', ['parámetros']).
### @includeFirst:
Esta directiva intenta incluir la primera vista que existe dentro de un conjunto dado de vistas. Es útil cuando deseas incluir una de varias vistas basadas en ciertas condiciones.
Sintaxis: @includeFirst(['vista1', 'vista2', 'vista3']).

Estas directivas son especialmente útiles para la modularización y la organización del código en tus vistas Blade. Te permiten dividir tus vistas en componentes más pequeños y reutilizables, lo que facilita el mantenimiento y la legibilidad del código. Además, las directivas @includeIf, @includeWhen, @includeUnless y @includeFirst proporcionan funcionalidades adicionales para la inclusión condicional de vistas, lo que aumenta la flexibilidad en la composición de tus vistas.

## Componentes de clases
Los componentes de clases en Blade son una forma de generar clases HTML de manera dinámica en tus vistas de Laravel Blade. Son útiles cuando necesitas aplicar clases condicionalmente a elementos HTML basadas en ciertas condiciones o valores.

## Directivas: @yield vs @stack
En Blade, tanto @stack como @yield son directivas que se utilizan para trabajar con secciones de contenido en las plantillas. Sin embargo, tienen diferentes propósitos y formas de funcionar:
### @yield:
La directiva @yield se utiliza para definir una sección de contenido que puede ser rellenada desde cualquier parte de la aplicación. Es similar a definir un marcador de posición para el contenido.
Se utiliza en el archivo de la plantilla base (layout) para definir áreas donde el contenido dinámico puede ser inyectado desde otras vistas.
**Ejemplo:**
```blade
<!-- layout.blade.php -->
<html>
<head>
    <title>@yield('titulo')</title>
</head>
<body>
    @yield('contenido')
</body>
</html>
```
### @stack:
La directiva @stack se utiliza para apilar contenido en una sección que ya ha sido definida utilizando @push. Es útil cuando necesitas agregar contenido a una sección desde diferentes partes de tu aplicación sin sobrescribir el contenido anterior.
Se utiliza en las vistas que desean agregar contenido a una sección previamente definida.
**Ejemplo:**
```blade
<!-- vista.blade.php -->
@push('scripts')
    <script src="mi-script.js"></script>
@endpush
```
```blade
<!-- layout.blade.php -->
<head>
    @stack('scripts')
</head>
```
En este ejemplo, el contenido dentro del @push('scripts') se apilará en la sección 'scripts', y luego se imprimirá en la plantilla base (layout) utilizando @stack('scripts').

> En resumen, @yield se utiliza para definir secciones de contenido en la plantilla base que pueden ser llenadas desde otras vistas, mientras que @stack y @push se utilizan para apilar contenido en secciones predefinidas para permitir la adición dinámica de contenido desde diferentes partes de la aplicación.

# Migraciones
## Ejecutar las migraciones
El comando php artisan migrate en Laravel se utiliza para ejecutar las migraciones de la base de datos. Las migraciones son como versiones controladas de los cambios en la estructura de la base de datos. Te permiten definir y modificar la estructura de la base de datos utilizando código PHP en lugar de SQL directamente.
Cuando ejecutas php artisan migrate, Laravel buscará en el directorio database/migrations de tu aplicación todas las migraciones que aún no se han ejecutado en la base de datos y las ejecutará en orden, aplicando los cambios necesarios para mantener la estructura de la base de datos al día con tu código.
> En resumen, php artisan migrate es un comando fundamental en Laravel que te permite administrar la estructura de la base de datos de manera controlada y automatizada utilizando migraciones, lo que simplifica el proceso de desarrollo y mantenimiento de aplicaciones web basadas en Laravel.

## Revertir última migración
El comando php artisan migrate:rollback en Laravel se utiliza para revertir la última migración que se haya ejecutado en la base de datos. Revertir una migración deshace los cambios realizados por la migración más reciente, restaurando así el estado anterior de la base de datos.
Algunos puntos importantes sobre php artisan migrate:rollback:
- Revierte una migración: Este comando deshace los cambios realizados por la migración más reciente, eliminando las tablas creadas o modificadas y restaurando cualquier cambio que se haya realizado en la estructura de la base de datos.
- Orden de reversión: Laravel mantiene un registro de todas las migraciones que se han ejecutado en la base de datos. Al ejecutar php artisan migrate:rollback, Laravel buscará la migración más reciente en este registro y revertirá los cambios realizados por esa migración.
- Migraciones en lote: Si has ejecutado varias migraciones desde la última vez que ejecutaste php artisan migrate, migrate:rollback revertirá solo la migración más reciente. Si deseas revertir múltiples migraciones, tendrás que ejecutar el comando varias veces o utilizar la opción --step para especificar cuántas migraciones quieres revertir.
- Estado de la base de datos: Es importante tener en cuenta que migrate:rollback solo revierte migraciones, no restaura los datos que hayas insertado o modificado en la base de datos desde la ejecución de la migración. Por lo tanto, si tienes datos que dependen de la estructura de la base de datos modificada por la migración, es posible que necesites realizar ajustes adicionales manualmente.
> En resumen, php artisan migrate:rollback es un comando útil para deshacer los cambios realizados por la migración más reciente en la base de datos, lo que te permite retroceder y corregir errores o realizar ajustes en la estructura de la base de datos de tu aplicación Laravel.

## Objeto $table
Cuando creas una migración en Laravel y defines una tabla, utilizas el objeto $table para definir la estructura y las características de esa tabla. El objeto $table proporciona una serie de métodos que puedes utilizar para definir columnas, claves, restricciones y otros elementos de la tabla. Aquí tienes una lista de los principales métodos disponibles en el objeto $table:
### Columnas
- increments($column): Define una columna de tipo autoincremental INTEGER con clave primaria.
- bigIncrements($column): Define una columna de tipo autoincremental BIGINT con clave primaria.
- string($column, $length = null): Define una columna de tipo VARCHAR.
- text($column): Define una columna de tipo TEXT.
- integer($column, $autoIncrement = false, $unsigned = false): Define una columna de tipo INTEGER.
- bigInteger($column, $autoIncrement = false, $unsigned = false): Define una columna de tipo BIGINT.
- float($column, $total = 8, $places = 2): Define una columna de tipo FLOAT.
- double($column, $total = 8, $places = 2): Define una columna de tipo DOUBLE.
- decimal($column, $total = 8, $places = 2): Define una columna de tipo DECIMAL.
- boolean($column): Define una columna de tipo BOOLEAN.
- date($column): Define una columna de tipo DATE.
- dateTime($column): Define una columna de tipo DATETIME.
- time($column): Define una columna de tipo TIME.
- timestamp($column): Define una columna de tipo TIMESTAMP.
- timestamps(): Agrega automáticamente las columnas created_at y updated_at.
- softDeletes(): Agrega automáticamente la columna deleted_at para realizar eliminaciones suaves (soft deletes).
