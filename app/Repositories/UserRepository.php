<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserRepository
{
    public function createUser(string $email, string $password, string $nickname)
    {
        $user = new User;
        $user->email = $email;
        $user->password = $password;
        $user->nickname = $nickname;
        $user->register_date = date('Y-m-d H:i:s');
        $user->session_key = md5($user->register_date);
        $user->save();
    }

    public function validateUser(string $email, string $password)
    {
        return User::where('email', $email)->where('password', $password)->exists();
    }
}
