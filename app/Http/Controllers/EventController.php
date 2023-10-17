<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventTypeRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    private $eventRepository;
    private $userRepository;
    private $eventTypeRepository;
    public function __construct(EventRepository $eventRepository, EventTypeRepository $eventTypeRepository, UserRepository $userRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->eventTypeRepository = $eventTypeRepository;
    }

    public function dashboard(): View
    {
        return view('dashboard', ['eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function list(): View
    {
        $userId = 1;
        return view('eventList', ['joinedEvents' => $this->eventRepository->getByParticipant($userId), 'postedEvents' => $this->eventRepository->getByCreatedBy($userId)]);
    }

    public function view(string $id): View
    {
        return view('eventDetail', ['event' => $this->eventRepository->getById($id)]);
    }

    public function join(string $id): View
    {
        return view('join', ['event' => $this->eventRepository->getById($id)]);
    }

    public function manage(string $id = null): View
    {
        return view('eventManage');
    }

    public function store(Request $request)
    {
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        if (is_null($request->input('id'))) {// add flow
            $time = time();
            $imagePath = "/uploads/events";
            $path = $request->file('file')->store($imagePath, 'public');
            $currentDatetime = date('Y-m-d H:i:s');
            $id = $this->eventRepository->createEvent($request->input('amTitleInput'), $request->input('organizerInfoTextarea'), $request->input('amTypeSelect'), 
            $request->input('startDate'), $request->input('endDate'), $request->input('registrationDate'), $request->input('amLocationInput'), $request->input('organiserEmailInput'), 
            $request->input('joinNumberInput'), $request->input('amGoalPlanTextarea'), $request->input('detail'), $user->id, $request->input('amNoticeTextarea'), $request->input('isSaveDraft'), $path, $currentDatetime);
        } else {// edit flow
            
        }
        return true;
    }
}
