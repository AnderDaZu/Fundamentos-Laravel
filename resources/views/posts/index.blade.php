<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>
<body>
    <h1>Aquí se mostrarán los posts</h1>

    {{-- Directiva @switch --}}
    @switch($dia)
        @case(1)
            <p>Lunes</p>
            @break
        @case(2)
            <p>Martes</p>
            @break
        @case(3)
            <p>Miercoles</p>
            @break
        @case(4)
            <p>Jueves</p>
            @break
        @case(5)
            <p>Viernes</p>
            @break
        @case(6)
            <p>Sabado</p>
            @break
        @case(7)
            <p>Domingo</p>
            @break
        @default
            <p>No es un diá de la semana</p>
    @endswitch

    {{-- Directivas @env @production --}}
    {{-- @env('local')
        <p>Estamos en local</p>
    @endenv

    @env('production')
        <p>Estamos en producción 1.0</p>
    @endenv
    @production
        <p>Estamos en producción 2.0</p>
    @endproduction --}}

    {{-- Directivas Condicionales --}}
    {{-- @if (true)
        <p>Este mensaje se mostrará si el valor de la condicional es verdadero.</p>
    @else
        <p>Este mensaje se mostrará si el valor de la condicional es falso.</p>
    @endif

    @unless (false)
        <p>Le has pasado el valor de false a la directiva unless.</p>
    @endunless

    @isset($marca)
        <p>La variable existe y tiene un valor asignado</p>
    @else
        <p>La variable no existe o no tiene un valor asignado.</p>
    @endisset

    @empty($post45)
        <p>La variable no existe o no tiene un valor asignado.</p>
    @endempty --}}

    {{-- <script>
        let posts_1 = {!! json_encode($posts) !!};
        let posts_2 = @json($posts); // forma recomendada para interactuar con blade y js
        console.log(posts_2);
    </script> --}}

    {{-- forma de mostrar variables en blade -> Escapado automático --}}
    {{-- {{ $tag1 }} --}}
    {{-- <p>---------</p> --}}
    {{-- forma de mostrar variables en blade -> Sin escapado --}}
    {{-- {!! $tag2 !!} --}}

    {{-- forma para evitar el conflicto y asegurarte si estás trabajando con un framework de JavaScript 
        que también utiliza la sintaxis de blade, dicho código de js no se vea afectado --}}
    {{-- <script>
        var appData = {
            name: "@{{ $name }}",
            age: {{ $age }},
            // Otros datos
        };
    </script> --}}
</body>
</html>