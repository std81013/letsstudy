<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTypeRepository;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    private $userRepository;
    private $eventRepository;
    private $eventTypeRepository;
    public function __construct(UserRepository $userRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository)
    {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->eventTypeRepository = $eventTypeRepository;
    }

    public function login(Request $request): View
    {
        $auth = $this->userRepository->validateUser($request->input('email'), $request->input('password'));
        return view('dashboard', ['auth' => $auth, 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function logout(Request $request): View
    {
        return view('dashboard', ['auth' => false]);
    }

    public function register(Request $request): View
    {
        return view('register');
    }

    public function store(Request $request): View
    {
        //validate exist

        //store
        $registerDatetime = date('Y-m-d H:i:s');
        $token = md5($registerDatetime);
        $id = $this->userRepository->createUser($request->input('email'), $request->input('password'), $request->input('nickname'), $registerDatetime, $token);

        //mail
        $token = encrypt(['id' => $id]);
        Mail::to('s0952785388@gmail.com')->send(new OrderShipped(url("/register/successfully/$token")));
        return view('dashboard', ['auth' => false, 'showMessage' => 'store_successful']);
    }

    public function registerSuccess(string $token): View
    {
        $isVerify = false;
        $nickname = '';
        $user = null;

        $userInfo = decrypt($token);
        if (isset($userInfo['id'])) {
            $user = $this->userRepository->getById($userInfo['id']);
            if (!is_null($user)) {
                $nickname = $user->nickname;
                $this->userRepository->updateIsVerify($userInfo['id'], 1);
                $isVerify = true;
            }
        }
        return view('signUpSuccess', ['isVerify' => $isVerify, 'nickname' => $nickname, 'user' => $user]);
    }

    public function sendForgetMail(Request $request): bool
    {
        if (!is_null($this->userRepository->getByEmail($request->input('email')))) {
            Mail::to('s0952785388@gmail.com')->send(new OrderShipped(url('/resetPassword')));//replace to $request->input('email')
        }
        return true;
    }
}
