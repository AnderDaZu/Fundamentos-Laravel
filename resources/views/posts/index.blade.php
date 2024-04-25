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

    <script>
        let posts_1 = {!! json_encode($posts) !!};
        let posts_2 = @json($posts); // forma recomendada para interactuar con blade y js
        console.log(posts_2);
    </script>

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