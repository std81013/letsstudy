<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTypeRepository;

class UserController extends Controller
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

    public function introduction(string $id): View
    {
        return view('userIntroduction', ['user' => $this->userRepository->getById($id), 'joinedEvents' => $this->eventRepository->getByParticipant($id), 'postedEvents' => $this->eventRepository->getByCreatedBy($id)]);
    }
}
