<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        return "Guardar el nuevo post";
    }

    public function show($id)
    {
        return view('posts.show', compact('id'));
    }

    public function edit($id)
    {
        return view('posts.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        return "Actualizar el post {$id}";
    }

    public function destroy($id)
    {
        return "Eliminar el post {$id}";
    }
}
