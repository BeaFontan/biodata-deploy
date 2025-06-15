<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $input): ?string
    {
        $user = $this->userRepository->findByEmail($input['email']);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'O usuario non existe.',
            ]);
        }

        if ($user->must_change_password) {
            session(['user_pending_password_change' => $user->id]);
            return 'changePasswordFront';
        }

        if (!Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais non son correctas.',
            ]);
        }

        session()->regenerate();

        return null;
    }

    /**
     * @throws Exception
     */
    public function updatePassword(array $input): ?User
    {
        $userId = session('user_pending_password_change') ?? Auth::id();

        if (!$userId) {
            session()->flash('message', 'Sesión expirada. Inicia sesión de novo.');
            return null;
        }

        $input['id'] = $userId;

        $user = $this->userRepository->updatePassword($input);

        Auth::login($user);
        session()->forget('user_pending_password_change');

        return $user;
    }
}
