<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Infrastructure\Persistence\Models\PostModel;
use App\Presentation\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        try {
            $query = PostModel::with(['user', 'comments']);

            if ($request->has('search') && $request->get('search')) {
                $search = $request->get('search');
                $query->where('title', 'like', "%{$search}%");
            }

            if ($request->has('min_likes') && $request->get('min_likes')) {
                $minLikes = (int) $request->get('min_likes');
                $query->where('likes', '>=', $minLikes);
            }

            $posts = $query->orderBy('created_at', 'desc')->get();

            $postsArray = $posts->map(function ($post) {
                return [
                    'external_id' => $post->external_id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'tags' => $post->tags ?? [],
                    'likes' => $post->likes,
                    'dislikes' => $post->dislikes,
                    'views' => $post->views,
                    'comments_count' => $post->comments->count(),
                    'created_at' => $post->created_at->format('d/m/Y H:i'),
                    'user' => [
                        'external_id' => $post->user->external_id,
                        'first_name' => $post->user->first_name,
                        'last_name' => $post->user->last_name,
                    ]
                ];
            })->toArray();

            return view('pages.home', [
                'posts' => $postsArray,
                'total' => count($postsArray),
            ]);
        } catch (\Exception $e) {
            return view('pages.home', [
                'posts' => [],
                'total' => 0,
                'error' => 'Erro ao carregar posts: ' . $e->getMessage()
            ]);
        }
    }
}
