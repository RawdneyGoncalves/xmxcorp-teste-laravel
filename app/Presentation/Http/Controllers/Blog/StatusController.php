<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Presentation\Http\Controllers\BaseController;
use App\Infrastructure\Persistence\Models\UserModel;
use App\Infrastructure\Persistence\Models\PostModel;
use App\Infrastructure\Persistence\Models\CommentModel;
use Illuminate\Support\Facades\Http;

class StatusController extends BaseController
{
    public function check()
    {
        $api = $this->checkApi();
        $database = $this->checkDatabase();
        $samples = $this->getSamples();

        return view('status', [
            'api' => $api,
            'database' => $database,
            'samples' => $samples
        ]);
    }

    private function checkApi()
    {
        try {
            $response = Http::timeout(5)->get('https://dummyjson.com/users');

            if ($response->successful()) {
                return [
                    'status' => 'online',
                    'users_api' => true,
                    'posts_api' => true,
                    'comments_api' => true
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'offline',
                'message' => $e->getMessage()
            ];
        }

        return [
            'status' => 'offline',
            'message' => 'API retornou erro'
        ];
    }

    private function checkDatabase()
    {
        return [
            'users' => UserModel::count(),
            'posts' => PostModel::count(),
            'comments' => CommentModel::count()
        ];
    }

    private function getSamples()
    {
        return [
            'user' => UserModel::orderBy('created_at', 'desc')->first()?->toArray(),
            'post' => PostModel::orderBy('created_at', 'desc')->first()?->toArray(),
            'comment' => CommentModel::orderBy('created_at', 'desc')->first()?->toArray()
        ];
    }
}
