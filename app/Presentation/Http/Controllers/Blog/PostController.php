<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Infrastructure\Persistence\Models\PostModel;
use App\Presentation\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function show(int $external_id)
    {
        try {
            $post = PostModel::where('external_id', $external_id)->with(['user', 'comments.user'])->firstOrFail();

            $commentsArray = $post->comments->map(function ($comment) {
                return [
                    'external_id' => $comment->external_id,
                    'body' => $comment->body,
                    'likes' => $comment->likes,
                    'created_at' => $comment->created_at->format('d/m/Y H:i'),
                    'user' => [
                        'external_id' => $comment->user->external_id,
                        'first_name' => $comment->user->first_name,
                        'last_name' => $comment->user->last_name,
                    ]
                ];
            })->toArray();

            $postData = [
                'external_id' => $post->external_id,
                'title' => $post->title,
                'body' => $post->body,
                'tags' => $post->tags ?? [],
                'likes' => $post->likes,
                'dislikes' => $post->dislikes,
                'views' => $post->views,
                'created_at' => $post->created_at->format('d/m/Y H:i'),
                'comments' => $commentsArray,
                'user' => [
                    'external_id' => $post->user->external_id,
                    'first_name' => $post->user->first_name,
                    'last_name' => $post->user->last_name,
                ]
            ];

            return view('pages.post.show', ['post' => $postData]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Post não encontrado');
        }
    }

    public function like(int $external_id)
    {
        try {
            $post = PostModel::where('external_id', $external_id)->firstOrFail();
            $post->increment('likes');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Post não encontrado'], 404);
        }
    }

    public function dislike(int $external_id)
    {
        try {
            $post = PostModel::where('external_id', $external_id)->firstOrFail();
            $post->increment('dislikes');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Post não encontrado'], 404);
        }
    }

    public function create()
    {
        return view('pages.post.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|min:5|max:255',
                'body' => 'required|string|min:10',
                'tags' => 'nullable|string',
            ]);

            $tags = $validated['tags'] ? explode(',', $validated['tags']) : [];
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);

            $maxId = PostModel::max('external_id') ?? 0;

            $post = new PostModel();
            $post->external_id = $maxId + 1;
            $post->user_id = 1;
            $post->title = $validated['title'];
            $post->body = $validated['body'];
            $post->tags = count($tags) > 0 ? $tags : null;
            $post->likes = 0;
            $post->dislikes = 0;
            $post->views = 0;
            $post->save();

            return redirect()->route('post.show', $post->external_id)->with('success', 'Publicação criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erro ao criar publicação: ' . $e->getMessage());
        }
    }
}
