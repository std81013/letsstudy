<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class Authenticate
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->session()->get('token');
        if (!is_null($token) && $this->userRepository->validateToken($token)) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
