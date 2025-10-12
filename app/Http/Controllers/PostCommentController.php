<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsStoreRequest;
use App\Http\Requests\CommentUpdateRquest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index(Post $post)
    {
        return CommentResource::collection($post->comments);
    }

    public function store(Post $post, CommentsStoreRequest $request)
    {
        $inputs = $request->validated();
        $comment = $post->comments()->create($inputs);

        return new CommentResource($comment);
    }

    public function show(Post $post, Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(Post $post, Comment $comment, CommentUpdateRquest $request)
    {
        $inputs = $request->validated();
        $comment->update($inputs);

        return new CommentResource($comment);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}
