<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(string $email, string $password, string $nickname, string $registerDatetime, string $token)
    {
        $this->user->email = $email;
        $this->user->password = $password;
        $this->user->nickname = $nickname;
        $this->user->register_datetime = $registerDatetime;
        $this->user->token = $token;
        $this->user->save();
        return $this->user->id;
    }

    public function validateUser(string $email, string $password)
    {
        return $this->user->where('email', $email)->where('password', $password)->exists();
    }

    public function updateToken(string $email, string $password, string $token)
    {
        return $this->user->where('email', $email)->where('password', $password)->update(['token' => $token]);
    }

    public function validateToken(string $token)
    {
        return $this->user->where('token', $token)->exists();
    }

    public function registration(string $id)
    {
        $nickname = null;
        if ($this->user->where('id', $id)->update(['is_verify' => 1])) {
            $nickname = $this->user->find($id)->nickname;
        }
        return $nickname;
    }

    public function getById(string $id) 
    {
        return $this->user->where('id', $id)->get()->first();
    }

    public function getByEmail(string $email) 
    {
        return $this->user->where('email', $email)->get()->first();
    }

    public function updatePassword(string $email, string $password)
    {
        return $this->user->where('email', $email)->update(['password' => $password]);
    }

    public function getByToken(string $token) 
    {
        return $this->user->where('token', $token)->get()->first();
    }

    public function update(string $userId, string $nickname, string $introduction = null, string $phone, string $gender, string $birthday, bool $displayEmail = false, bool $displayJoinedEvent = false, bool $displayHostEvent = false)
    {
        $settings = json_encode(["display_email" => $displayEmail, "display_joined_event" => $displayJoinedEvent, "display_host_event" => $displayHostEvent]);
        return $this->user->where('id', $userId)->update(['nickname' => $nickname, 'introduction' => $introduction, 'phone' => $phone, 'gender' => $gender, 'birthday' => $birthday, 'settings' => $settings]);
    }
}
