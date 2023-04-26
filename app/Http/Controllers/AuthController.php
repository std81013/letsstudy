<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request): View
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $auth = false;
        if ($email && $password) $auth = true;
        return view('dashboard', ['auth' => $auth]);
    }

    public function logout(Request $request): View
    {
        $auth = false;
        return view('dashboard', ['auth' => $auth]);
    }

    public function register(Request $request): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = new User;
 
        $user->email = $request->email;
        $user->password = $request->password;
        $user->nickname = $request->nickname;
        $user->register_date = date('Y-m-d H:i:s');
        $user->session_key = md5($user->register_date);
 
        $user->save();
        $auth = true;
        return redirect('/');
    }
}
