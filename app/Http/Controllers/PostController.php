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
