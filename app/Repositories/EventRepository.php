<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Event;

class EventRepository
{
    public function getById(int $id)
    {
        return Event::where('id', $id)->get()->first();
    }

    public function getByParticipant(int $userId)
    {
        return Event::select('events.*', 'event_types.name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->whereRaw("INSTR(participants, \"$userId\")")->get();
    }

    public function getByCreatedBy(int $userId)
    {
        return Event::select('events.*', 'event_types.name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->where('created_by', $userId)->get();
    }
}
