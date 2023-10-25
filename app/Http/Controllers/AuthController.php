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
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $userRepository;
    private $eventRepository;
    private $eventTypeRepository;
    private $urlKey = 'letstudy';
    public function __construct(UserRepository $userRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository)
    {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->eventTypeRepository = $eventTypeRepository;
    }

    public function login(Request $request): View
    {
        $token = null;
        $isExist = $this->userRepository->validateUser($request->input('email'), $request->input('password'));
        if ($isExist) {
            $token = Str::uuid();
            $request->session()->put('token', $token);
            $this->userRepository->updateUserToken($request->input('email'), $request->input('password'), $token);
        }
        return view('dashboard', ['token' => $token, 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function logout(Request $request): View
    {
        $request->session()->forget('token');
        return view('dashboard', ['token' => null, 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
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
        Mail::to($request->input('email'))->send(new OrderShipped(url("/register/successfully/$token")));
        return view('dashboard', ['auth' => false, 'showMessage' => 'store_successful', 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
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
        $email = $request->input('email');
        if (!is_null($this->userRepository->getByEmail($email))) {
            $uri = encrypt(['email' => $email]);
            Mail::to($email)->send(new OrderShipped(url("/user/resetPassword?email={$uri}")));
        }
        return true;
    }

    public function resetPassword(Request $request): View
    {
        return view('resetPassword', ['email' => $request->input('email')]);
    }

    public function updatePassword(Request $request): bool
    {
        $is_updated = false;
        $result = decrypt($request->input('email'));
        if (!is_null($this->userRepository->getByEmail($result['email']))) {
            $is_updated = $this->userRepository->updatePassword($result['email'], $request->input('password'));
        }
        return $is_updated;
    }
}
