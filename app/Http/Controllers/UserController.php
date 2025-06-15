<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $redirect = $this->userService->login($request->validated());

            if ($redirect) {
                return redirect()->route($redirect);
            }

            return redirect()->route('listSpeciesFront');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        try {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('loginFront');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @return Factory|Application|View|RedirectResponse
     */
    public function showChangePasswordForm(): Factory|Application|View|RedirectResponse
    {
        if (!session()->has('user_pending_password_change') && !Auth::check()) {
            return redirect()->route('loginFront');
        }

        return view('auth.change-password');
    }


    /**
     * @param PasswordUpdateRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        try {
            $this->userService->updatePassword($request->validated());

            return redirect()->route('login')->with('message', 'Contrasinal cambiado correctamente. Inicia sesión de novo');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
