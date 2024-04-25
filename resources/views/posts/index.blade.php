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

    {{-- forma de mostrar variables en blade -> Escapado automático --}}
    {{ $tag1 }}
    <p>---------</p>
    {{-- forma de mostrar variables en blade -> Sin escapado --}}
    {!! $tag2 !!}
</body>
</html>