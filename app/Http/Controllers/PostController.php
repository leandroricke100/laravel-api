<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::with('comments')->get();
        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters(['title', 'body'])
            ->defaultSort('title')
            ->allowedSorts(['title'])
            ->allowedIncludes(['comments'])
            ->paginate();

        return PostResource::collection($posts);
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

        $post->load('comments');
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
