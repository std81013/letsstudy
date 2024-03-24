<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTypeRepository;
use App\Mail\OrderShipped;

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
        $token = null;
        $isExist = $this->userRepository->validateUser($request->input('email'), $request->input('password'));
        if ($isExist) {
            $token = Str::uuid();
            $request->session()->put('token', $token);
            $this->userRepository->updateToken($request->input('email'), $request->input('password'), $token);
        }
        return view('dashboard', ['token' => $token, 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function logout(Request $request): View
    {
        $request->session()->forget('token');
        return view('dashboard', ['token' => null, 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function register(): View
    {
        return view('register');
    }

    public function store(Request $request): View
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nickname' => 'required|string'
        ], [
            'email.required' => '請輸入email',
            'email.email' => '請輸入有效的email',
            'email.unique' => '此email已被註冊',
            'password.required' => '請輸入密碼',
            'password.min' => '請輸入至少:min字元'
        ]);

        $registerDatetime = date('Y-m-d H:i:s');
        $token = md5($registerDatetime);
        $id = $this->userRepository->create($request->input('email'), $request->input('password'), $request->input('nickname'), $registerDatetime, $token);

        $uri = encrypt(['id' => $id]);
        Mail::to($request->input('email'))->send(new OrderShipped(url("/register/successfully/$uri"), 'registerVerificationLetter'));
        return view('dashboard', ['auth' => false, 'showMessage' => 'store_successful', 'eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function registerSuccess(string $token): View
    {
        $isVerify = false;
        $nickname = '';
        $user = null;

        $userInfo = decrypt($token);
        if (isset($userInfo['id'])) {
            $nickname = $this->userRepository->registration($userInfo['id']);
            if (!is_null($nickname)) {
                $isVerify = true;
            }
        }
        return view('signUpSuccess', ['isVerify' => $isVerify, 'nickname' => $nickname]);
    }

    public function sendForgetMail(Request $request): bool
    {
        $request->validate([
            'email' => 'required|string|email|max:255'
        ], [
            'email.required' => '請輸入email',
            'email.email' => '請輸入有效的email'
        ]);

        $email = $request->input('email');
        if (!is_null($this->userRepository->getByEmail($email))) {
            $uri = encrypt(['email' => $email]);
            Mail::to($email)->send(new OrderShipped(url("/user/resetPassword?email={$uri}"), 'forgetPasswordLetter'));
        }
        return true;
    }

    public function resetPassword(Request $request): View
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users'
        ], [
            'email.required' => '請輸入email',
            'email.email' => '請輸入有效的email'
        ]);

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

    public function account(Request $request)
    {
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        $user->settings = json_decode($user->settings);
        return view('account', ['user' => $user, 'showUpdateSuccess' => false]);
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'userId' => 'required|string',
            'nickNameInput' => 'required|string',
            'selfInfoTextarea1' => 'required|string',
            'phoneNumInput' => 'required',
            'genderOption' => 'required',
            'birthdayInput' => 'required|string'
        ]);

        $this->userRepository->update(
            $request->input('userId'),
            $request->input('nickNameInput'),
            $request->input('selfInfoTextarea1'),
            $request->input('phoneNumInput'),
            $request->input('genderOption'),
            $request->input('birthdayInput'),
            $request->input('displayEmail', false),
            $request->input('displayJoinedEvent', false),
            $request->input('displayHostEvent', false)
        );
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        $user->settings = json_decode($user->settings);
        return view('account', ['user' => $user, 'showUpdateSuccess' => true]);
    }
}
