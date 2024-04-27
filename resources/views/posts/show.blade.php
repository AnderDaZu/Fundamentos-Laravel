{{-- Herencia de plantillas, forma que se solía realizar hasta laravel 7 --}}
@extends('layouts.app2')
@section('title', 'Post')
@section('content')
    <h1>Aquí se mostrará el detalle del post {{ $post }}</h1>

    <h2>{{ $pais }}</h2>    
@endsection