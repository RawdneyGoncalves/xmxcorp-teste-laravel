<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Domain\Blog\DTO\ListPostsInputDTO;
use App\Domain\Blog\UseCases\ListPostsUseCase;
use App\Presentation\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function __construct(private ListPostsUseCase $listPostsUseCase) {}

    public function index(Request $request)
    {
        try {
            $input = ListPostsInputDTO::fromArray($request->all());
            $output = $this->listPostsUseCase->execute($input);

            return view('pages.home', $output->toArray());
        } catch (\Exception $e) {
            return view('pages.home', [
                'posts' => [],
                'total_posts' => 0,
                'error' => 'Erro ao carregar posts: ' . $e->getMessage()
            ]);
        }
    }
}
