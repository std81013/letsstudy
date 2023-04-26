<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request): View
    {
        $auth = $this->userRepository->validateUser($request->input('email'), $request->input('password'));
        return view('dashboard', ['auth' => $auth]);
    }

    public function logout(Request $request): View
    {
        return view('dashboard', ['auth' => false]);
    }

    public function register(Request $request): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->userRepository->createUser($request->input('email'), $request->input('password'), $request->input('nickname'));
        return redirect('/');
    }
}
