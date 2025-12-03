<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Application\Blog\DTO\ListPostsInputDTO;
use App\Application\Blog\UseCases\ListPostsUseCase;
use App\Presentation\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function __construct(private ListPostsUseCase $listPostsUseCase) {}

    public function index(Request $request)
    {
        $input = ListPostsInputDTO::fromArray($request->all());

        try {
            $output = $this->listPostsUseCase->execute($input);
            return view('pages.home', $output->toArray());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar posts');
        }
    }
}
