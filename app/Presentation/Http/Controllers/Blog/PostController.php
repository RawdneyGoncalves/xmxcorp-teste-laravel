<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Domain\Blog\UseCases\GetPostDetailUseCase;
use App\Domain\Blog\UseCases\LikePostUseCase;
use App\Domain\Blog\UseCases\DislikePostUseCase;
use App\Presentation\Http\Controllers\BaseController;
use App\Domain\Blog\Shared\Exceptions\EntityNotFoundException;

class PostController extends BaseController
{
    public function __construct(
        private GetPostDetailUseCase $getPostDetailUseCase,
        private LikePostUseCase $likePostUseCase,
        private DislikePostUseCase $dislikePostUseCase,
    ) {}

    public function show(int $external_id)
    {
        try {
            $output = $this->getPostDetailUseCase->execute($external_id);
            return view('pages.post.show', $output->toArray());
        } catch (EntityNotFoundException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Erro ao carregar post');
        }
    }

    public function like(int $external_id)
    {
        try {
            $success = $this->likePostUseCase->execute($external_id);
            return response()->json(['success' => $success]);
        } catch (EntityNotFoundException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro'], 500);
        }
    }

    public function dislike(int $external_id)
    {
        try {
            $success = $this->dislikePostUseCase->execute($external_id);
            return response()->json(['success' => $success]);
        } catch (EntityNotFoundException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro'], 500);
        }
    }
}
