<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChangePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserController extends AppBaseController
{
    /**
     * @var UserRepository
     */
    public $userRepo;

    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function editProfile(): \Illuminate\View\View
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    public function updateProfile(UpdateUserProfileRequest $request): RedirectResponse
    {
        $this->userRepo->updateProfile($request->all());
        Flash::success(__('messages.placeholder.User_profile_updated_successfully'));

        return redirect(route('profile.setting'));
    }

    public function changePassword(UpdateChangePasswordRequest $request): JsonResponse
    {
        $input = $request->all();

        try {
            /** @var User $user */
            $user = Auth::user();
            if (! Hash::check($input['current_password'], $user->password)) {
                return $this->sendError(__('messages.placeholder.current_password_in_invalid'));
            }
            $input['password'] = Hash::make($input['new_password']);
            $user->update($input);

            return $this->sendSuccess(__('messages.placeholder.password_updated_successfully'));
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function setLanguage($id)
    {
        getLogInUser()->update([
            'language' => $id,
        ]);

        return $this->sendSuccess(__('messages.placeholder.language_changed_successfully'));
    }

    public function updateDarkMode(): JsonResponse
    {
        $user = Auth::user();

        $darkEnabled = $user->dark_mode == true;
        $user->update([
            'dark_mode' => ! $darkEnabled,
        ]);

        return $this->sendSuccess(__('messages.placeholder.theme_changed_successfully'));
    }
}
