<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();

        return PostResource::collection($posts);

        // return response()->json([
        //     'data' => $posts
        // ], 200);
    }

    public function store(PostStoreRequest $request)
    {
        // $inputs = request()->all();
        $inputs = $request->validated();
        $post = Post::create($inputs);

        return new PostResource($post);

        // return response()->json([
        //     'data' => $post
        // ], 201);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
        // return response()->json([
        //     'data' => $post
        // ], 200);
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        // $inputs = request()->all();
        $inputs = $request->validated();
        $post->update($inputs);

        return new PostResource($post);
        // return response()->json([
        //     'data' => $post
        // ], 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
