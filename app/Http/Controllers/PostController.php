<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return "Listado de posts";
    }

    public function create()
    {
        return "Formulario para crear un nuevo post";
    }

    public function store(Request $request)
    {
        return "Guardar el nuevo post";
    }

    public function show(string $id)
    {
        return "Detalle de post {$id}";
    }

    public function edit(string $id)
    {
        return "Editar el post {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "Actualizar el post {$id}";
    }

    public function destroy(string $id)
    {
        return "Eliminar el post {$id}";
    }
}
