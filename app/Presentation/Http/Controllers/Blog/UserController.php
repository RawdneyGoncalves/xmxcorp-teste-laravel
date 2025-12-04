<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Infrastructure\Persistence\Models\UserModel;
use App\Infrastructure\Persistence\Models\PostModel;
use App\Presentation\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function profile(int $external_id)
    {
        try {
            $user = UserModel::where('external_id', $external_id)->firstOrFail();

            $userData = [
                'external_id' => $user->external_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'birth_date' => $user->birth_date,
                'image' => $user->image,
                'address' => $user->address ? json_decode($user->address, true) : null,
                'posts_count' => $user->posts->count(),
            ];

            return view('pages.user.profile', ['user' => $userData]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Usuário não encontrado');
        }
    }

    public function posts(int $external_id, Request $request)
    {
        try {
            $user = UserModel::where('external_id', $external_id)->firstOrFail();

            $query = PostModel::where('user_id', $user->id)->with('comments');

            if ($request->has('search') && $request->get('search')) {
                $search = $request->get('search');
                $query->where('title', 'like', "%{$search}%");
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
                ];
            })->toArray();

            $userData = [
                'external_id' => $user->external_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ];

            return view('pages.user.posts', [
                'user' => $userData,
                'posts' => $postsArray,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Usuário não encontrado');
        }
    }
}
