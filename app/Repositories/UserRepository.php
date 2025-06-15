<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param array $input
     * @return User|null
     * @throws Exception
     */
    public function updatePassword(array $input): ?User
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($input['id']);
            $user->password = Hash::make($input['new_password']);
            $user->must_change_password = false;
            $user->save();

            DB::commit();
            return $user;
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

}
