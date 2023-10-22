<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Event;

class EventRepository
{
    public function getById(int $id)
    {
        return Event::select('events.*', 'event_types.name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->where('events.id', $id)->get()->first();
    }

    public function getByParticipant(int $userId)
    {
        return Event::select('events.*', 'event_types.name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->whereRaw("INSTR(participants, \"$userId\")")->get();
    }

    public function getByCreatedBy(int $userId)
    {
        return Event::select('events.*', 'event_types.name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->where('created_by', $userId)->get();
    }

    public function getList()
    {
        return Event::select('events.*', 'event_types.name', 'event_types.type_name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->get();
    }

    public function createEvent(string $title, string $introduction, string $eventTypeId, string $startDate, string $endDate, string $registrationDate, string $location, string $contactMethod, string $participantsAmount, string $plan, string $detail, string $deltaJson, string $userId, string $note, string $isPost, string $imagePath, string $datetime, string $participants = '[]', string $description = '')
    {
        $event = new Event;
        $event->title = $title;
        $event->introduction = $introduction;
        $event->description = $description;
        $event->event_type_id = $eventTypeId;
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->registration_date = $registrationDate;
        $event->location = $location;
        $event->contact_method = $contactMethod;
        $event->participants_amount = $participantsAmount;
        $event->participants = $participants;
        $event->plan = $plan;
        $event->detail = $detail;
        $event->delta_json = $deltaJson;
        $event->created_by = $userId;
        $event->created_at = $datetime;
        $event->updated_by = $userId;
        $event->updated_at = $datetime;
        $event->note = $note;
        $event->is_post = $isPost;
        $event->image_path = $imagePath;
        $event->save();
        return $event->id;
    }

    public function updateEvent(string $id, string $title, string $introduction, string $eventTypeId, string $startDate, string $endDate, string $registrationDate, string $location, string $contactMethod, string $participantsAmount, string $plan, string $detail, string $deltaJson, string $userId, string $note, string $isPost, string $imagePath, string $datetime, string $description = '')
    {
        return Event::where('id', $id)
            ->update([
                'title' => $title,
                'introduction' => $introduction,
                'description' => $description,
                'event_type_id' => $eventTypeId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'registration_date' => $registrationDate,
                'location' => $location,
                'contact_method' => $contactMethod,
                'participants_amount' => $participantsAmount,
                'plan' => $plan,
                'detail' => $detail,
                'delta_json' => $deltaJson,
                'updated_by' => $userId,
                'updated_at' => $datetime,
                'note' => $note,
                'is_post' => $isPost,
                'image_path' => $imagePath,
            ]);
    }
}
