<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;

class UserController extends Controller
{
    private $userRepository;
    private $eventRepository;
    public function __construct(UserRepository $userRepository, EventRepository $eventRepository)
    {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
    }

    public function introduction(string $id): View
    {
        return view('userIntroduction', ['user' => $this->userRepository->getById($id), 'joinedEvents' => $this->eventRepository->getByParticipant($id), 'postedEvents' => $this->eventRepository->getByCreatedBy($id)]);
    }
}
