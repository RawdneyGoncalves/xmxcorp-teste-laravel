<?php

namespace App\Presentation\Http\Controllers\Blog;

use App\Application\Blog\DTO\ListPostsInputDTO;
use App\Application\Blog\UseCases\GetUserProfileUseCase;
use App\Application\Blog\UseCases\ListUserPostsUseCase;
use App\Presentation\Http\Controllers\BaseController;
use App\Application\Shared\Exceptions\EntityNotFoundException;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(
        private GetUserProfileUseCase $getUserProfileUseCase,
        private ListUserPostsUseCase $listUserPostsUseCase,
    ) {}

    public function profile(int $id)
    {
        try {
            $output = $this->getUserProfileUseCase->execute($id);
            return view('pages.user.profile', $output->toArray());
        } catch (EntityNotFoundException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }

    public function posts(int $id, Request $request)
    {
        try {
            $input = ListPostsInputDTO::fromArray(array_merge($request->all(), ['page' => $request->get('page', 1)]));
            $output = $this->listUserPostsUseCase->execute($id, $input);

            return view('pages.user.posts', $output->toArray());
        } catch (EntityNotFoundException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}
