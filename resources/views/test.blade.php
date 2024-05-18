<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>

    {{-- Tailwindcss --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Bootstrap --}}
    {{-- si se usa estilos de bootstrap para paginación se debe indicar en el archivo app\Providers\AppServiceProvider.php --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> --}}
</head>
<body>
    <h1>Users</h1>

    <ul class="mx-8">
        @foreach ($users as $user)
            <li>
                <h4>{{ $user->id }} - {{ $user->name }}</h4>
            </li>
        @endforeach
    </ul>

    {{-- MODIFICAR ESTILOS DE LA VISTA DE PAGINACIÓN --}}
    {{-- Para lograrlo se debe primero publicar las vistas --}}
    {{-- php artisan vendor:publish --tag:laravel-pagination --}}

    {{ $users->links() }}

    {{-- {{ $users->links('acá se puede poner la vista que tenga estilos personalizados para la paginación') }} --}}
    {{-- 
        Si se requiere poner una vista por defecto para los estilos de la paginación se debe ir a AppServiceProvider.php e indicar
        cual es la vista que contiene los estilos para la paginación
    --}}
</body>
</html>