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
        $event = null;
        if (!is_null($id)) {
            $event = $this->eventRepository->getById($id);
        }

        return view('eventManage', ['event' => $event, 'eventTypes' => $this->eventTypeRepository->getListWithoutAll()]);
    }

    public function store(Request $request)
    {
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        $time = time();
        $imagePath = "/uploads/events";
        $currentDatetime = date('Y-m-d H:i:s');
        if (is_null($request->input('id'))) {// add flow
            $path = $request->file('file')->storeAs($imagePath, $request->input('filename'), 'public');
            $id = $this->eventRepository->createEvent($request->input('amTitleInput'), $request->input('organizerInfoTextarea'), $request->input('amTypeSelect'), 
            $request->input('startDate'), $request->input('endDate'), $request->input('registrationDate'), $request->input('amLocationInput'), $request->input('organiserEmailInput'), 
            $request->input('joinNumberInput'), $request->input('amGoalPlanTextarea'), $request->input('detail'), $request->input('delta_json'), $user->id, $request->input('amNoticeTextarea'), $request->input('isPost'), $path, $currentDatetime);
        } else {
            $path = "$imagePath/$request->input('filename')";
            if (!Storage::disk('public')->exists($path)) { // 刪除舊檔
                $path = $request->file('file')->storeAs($imagePath, $request->input('filename'), 'public');
            }
            $this->eventRepository->updateEvent($request->input('id'), $request->input('amTitleInput'), $request->input('organizerInfoTextarea'), $request->input('amTypeSelect'), 
            $request->input('startDate'), $request->input('endDate'), $request->input('registrationDate'), $request->input('amLocationInput'), $request->input('organiserEmailInput'), 
            $request->input('joinNumberInput'), $request->input('amGoalPlanTextarea'), $request->input('detail'), $request->input('delta_json'), $user->id, $request->input('amNoticeTextarea'), $request->input('isPost'), $path, $currentDatetime);
        }
        return true;
    }
}
