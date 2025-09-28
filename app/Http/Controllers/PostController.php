<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function store()
    {
        $inputs = request()->all();
        $post = Post::create($inputs);

        return response()->json([
            'data' => $post
        ], 201);
    }

    public function show(Post $post)
    {
        return response()->json([
            'data' => $post
        ], 200);
    }

    public function update(Post $post)
    {
        $inputs = request()->all();
        $post->update($inputs);

        return response()->json([
            'data' => $post
        ], 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
