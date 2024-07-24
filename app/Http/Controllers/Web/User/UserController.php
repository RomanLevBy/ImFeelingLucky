<?php

namespace App\Http\Controllers\Web\User;

use App\DataTransferObjects\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRequest;
use App\Services\Link\LinkService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * UserController construct
     *
     * @param UserService $userService
     * @param LinkService $linkService
     */
    public function __construct(
        private UserService $userService,
        private LinkService $linkService
    )
    {
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        try {
            $userDto = UserDto::fromWebRequest($request);
            $user = $this->userService->store($userDto);
            $link = $this->linkService->getLinkInstance();
            $user->links()->save($link);
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong.');
        }

        return redirect()->route('link.preview', ['hash' => $link->hash]);
    }
}
