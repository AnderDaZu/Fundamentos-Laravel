<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $tag1 = '<p>Esto es un parrafo</p>';
        $tag2 = '<p>Esto es otro parrafo</p>';
        return view('posts.index', compact('tag1', 'tag2'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        return "Guardar el nuevo post";
    }

    public function show($post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit($post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $post)
    {
        return "Actualizar el post {$post}";
    }

    public function destroy($post)
    {
        return "Eliminar el post {$post}";
    }
}
