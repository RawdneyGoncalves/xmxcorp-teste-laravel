<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Domain\Blog\UseCases\GetPostDetailUseCase;
use App\Domain\Blog\UseCases\LikePostUseCase;
use App\Domain\Blog\UseCases\DislikePostUseCase;
use App\Presentation\Http\Controllers\BaseController;
use App\Domain\Shared\Exceptions\EntityNotFoundException;

class PostController extends BaseController
{
    public function __construct(
        private GetPostDetailUseCase $getPostDetailUseCase,
        private LikePostUseCase $likePostUseCase,
        private DislikePostUseCase $dislikePostUseCase,
    ) {}

    public function show(int $id)
    {
        try {
            $output = $this->getPostDetailUseCase->execute($id);
            return view('pages.post.show', $output->toArray());
        } catch (EntityNotFoundException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }

    public function like(int $id)
    {
        try {
            $success = $this->likePostUseCase->execute($id);
            return response()->json(['success' => $success]);
        } catch (EntityNotFoundException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function dislike(int $id)
    {
        try {
            $success = $this->dislikePostUseCase->execute($id);
            return response()->json(['success' => $success]);
        } catch (EntityNotFoundException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }
}
