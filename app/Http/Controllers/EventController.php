<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    private $eventRepository;
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
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
}
