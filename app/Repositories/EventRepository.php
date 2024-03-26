<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventRepository
{
    private $event;
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function getById(int $id)
    {
        return $this->event->select('events.*', 'event_types.name', 'users.nickname as organizer')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->join('users', 'events.created_by', '=', 'users.id')->where('events.id', $id)->get()->first();
    }

    public function getByParticipant(int $userId)
    {
        return $this->event->select('events.*', 'event_types.name', 'event_types.type_name')
            ->join('event_types', 'events.event_type_id', '=', 'event_types.id')
            ->join('event_participants', function ($join) use ($userId) {
                $join->on('event_participants.participant_id', '=', $userId)
                     ->whereRaw('INSTR(participants, event_participants.id) > 0');
            })
            ->where('events.is_post', 1)
            ->whereNotNull('event_participants.id')
            ->get();
    }

    public function getByCreatedBy(int $userId)
    {
        return $this->event->select('events.*', 'event_types.name', 'event_types.type_name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->where('created_by', $userId)->get();
    }

    public function getList()
    {
        return $this->event->select('events.*', 'event_types.name', 'event_types.type_name')->join('event_types', 'events.event_type_id', '=', 'event_types.id')->where('events.is_post', 1)->get();
    }

    public function createEvent(string $title, string $introduction, string $eventTypeId, string $startDate, ?string $endDate, string $registrationDate, string $location, string $contactMethod, string $participantsAmount, string $plan, string $detail, string $deltaJson, string $userId, string $note, string $isPost, string $imagePath, string $datetime)
    {
        $this->event->title = $title;
        $this->event->introduction = $introduction;
        $this->event->description = '';
        $this->event->event_type_id = $eventTypeId;
        $this->event->start_date = $startDate;
        $this->event->end_date = $endDate;
        $this->event->registration_date = $registrationDate;
        $this->event->location = $location;
        $this->event->contact_method = $contactMethod;
        $this->event->participants_amount = $participantsAmount;
        $this->event->participants = [];
        $this->event->plan = $plan;
        $this->event->detail = $detail;
        $this->event->delta_json = $deltaJson;
        $this->event->created_by = $userId;
        $this->event->created_at = $datetime;
        $this->event->updated_by = $userId;
        $this->event->updated_at = $datetime;
        $this->event->note = $note;
        $this->event->is_post = $isPost;
        $this->event->image_path = $imagePath;
        $this->event->save();
        return $this->event->id;
    }

    public function updateEvent(string $id, string $title, string $introduction, string $eventTypeId, string $startDate, ?string $endDate, string $registrationDate, string $location, string $contactMethod, string $participantsAmount, string $plan, string $detail, string $deltaJson, string $userId, string $note, string $isPost, string $imagePath, string $datetime, string $description = '')
    {
        return $this->event->where('id', $id)
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

    public function updateParticipant(string $id, string $participantId)
    {
        $participants = $this->event->find($id)->participants;
        array_push($participants, $participantId);
        Log::error($participants);
        $this->event->where('id', $id)
            ->update(['participants' => $participants]);
    }

    public function deleteEvent(string $id)
    {
        return $this->event->where('id', $id)
            ->update(['is_post' => 9]);
    }
}
