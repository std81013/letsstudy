<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserRepository
{
    public function createUser(string $email, string $password, string $nickname, string $registerDatetime, string $token)
    {
        $user = new User;
        $user->email = $email;
        $user->password = $password;
        $user->nickname = $nickname;
        $user->register_datetime = $registerDatetime;
        $user->token = $token;
        $user->save();
        return $user->id;
    }

    public function validateUser(string $email, string $password)
    {
        return User::where('email', $email)->where('password', $password)->exists();
    }

    public function updateUserToken(string $email, string $password, string $token)
    {
        return User::where('email', $email)->where('password', $password)->update(['token' => $token]);
    }

    public function validateToken(string $token)
    {
        return User::where('token', $token)->exists();
    }

    public function updateIsVerify(string $id, int $isVerify)
    {
        return User::where('id', $id)->update(['is_verify' => $isVerify]);
    }

    public function getById(string $id) 
    {
        return User::where('id', $id)->get()->first();
    }

    public function getByEmail(string $email) 
    {
        return User::where('email', $email)->get()->first();
    }

    public function updatePassword(string $email, string $password)
    {
        return User::where('email', $email)->update(['password' => $password]);
    }
}
