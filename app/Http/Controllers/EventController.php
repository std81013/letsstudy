<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventTypeRepository;
use App\Repositories\EventParticipantRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Event\ViewPageData;

class EventController extends Controller
{
    private $eventRepository;
    private $userRepository;
    private $eventTypeRepository;
    private $eventParticipantRepository;
    public function __construct(EventRepository $eventRepository, EventTypeRepository $eventTypeRepository, UserRepository $userRepository, EventParticipantRepository $eventParticipantRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->eventTypeRepository = $eventTypeRepository;
        $this->eventParticipantRepository = $eventParticipantRepository;
    }

    public function dashboard(): View
    {
        return view('dashboard', ['eventTypes' => $this->eventTypeRepository->getList(), 'events' => $this->eventRepository->getList()]);
    }

    public function list(Request $request): View
    {
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        return view('eventList', ['joinedEvents' => $this->eventRepository->getByParticipant($user->id), 'postedEvents' => $this->eventRepository->getByCreatedBy($user->id)]);
    }

    public function view(string $id, Request $request): View
    {
        $viewPageData = $this->getViewPageData($id);
        if (!is_null($request->session()->get('token'))) {
            $viewPageData->user = $this->userRepository->getByToken($request->session()->get('token'));
        }
        return view('eventDetail', ['viewPageData' => $viewPageData]);
    }

    public function join(string $eventId, string $userId): View
    {
        return view('join', ['event' => $this->eventRepository->getById($eventId), 'user' => $this->userRepository->getById($userId)]);
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

    public function joinEvent(Request $request): view
    {
        $currentDatetime = date('Y-m-d H:i:s');
        $id = $this->eventParticipantRepository->create($request->input('eventId'), $request->input('joinMemberInput'), $request->input('userId'), $request->input('contactEmailInput'), $request->input('contactNumberInput'), $currentDatetime);
        $this->eventRepository->updateParticipant($request->input('eventId'), $id);
        $viewPageData = $this->getViewPageData($request->input('eventId'));
        if (!is_null($request->session()->get('token'))) {
            $viewPageData->user = $this->userRepository->getByToken($request->session()->get('token'));
        }
        return view('eventDetail', ['viewPageData' => $viewPageData]);
    }

    public function deleteEvent(string $id, Request $request)
    {
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        $this->eventRepository->deleteEvent($id);
        return view('eventList', ['joinedEvents' => $this->eventRepository->getByParticipant($user->id), 'postedEvents' => $this->eventRepository->getByCreatedBy($user->id)]);
    }

    public function delete(Request $request)
    {
        $user = $this->userRepository->getByToken($request->session()->get('token'));
        return $this->eventRepository->deleteEvent($request->input('id'));
    }

    private function getViewPageData(string $eventId): ViewPageData
    {
        $viewPageData = new ViewPageData();
        $viewPageData->event = $this->eventRepository->getById($eventId);
        $viewPageData->participants = [];
        $participantIds = json_decode($viewPageData->event->participants);
        if (count($participantIds) > 0) {
            $viewPageData->participants = $this->eventParticipantRepository->getByIds($participantIds);
        }
        return $viewPageData;
    }
}
