<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $tag1 = '<p>Esto es un parrafo</p>';
        // $tag2 = '<p>Esto es otro parrafo</p>';

        $posts = [
            [
                'title' => 'Post 1',
                'content' => 'Contenido del post 1',
                'tags' => ['tag1', 'tag2', 'tag3']
            ],
            [
                'title' => 'Post 2',
                'content' => 'Contenido del post 2',
                'tags' => ['tag4', 'tag5', 'tag6']
            ],
            [
                'title' => 'Post 3',
                'content' => 'Contenido del post 3',
                'tags' => ['tag7', 'tag8', 'tag9']
            ]
        ];
        // $dia = 10;
        $count = 10;

        return view('posts.index', compact('posts', 'count'));
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
