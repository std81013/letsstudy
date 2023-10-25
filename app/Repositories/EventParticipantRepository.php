<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\EventParticipant;

class EventParticipantRepository
{
    public function create(string $eventId, string $participant, string $participantId, string $email, string $mobileNumber, string $createdDatetime)
    {
        $eventParticipant = new EventParticipant;
        $eventParticipant->event_id = $eventId;
        $eventParticipant->participant = $participant;
        $eventParticipant->participant_id = $participantId;
        $eventParticipant->email = $email;
        $eventParticipant->mobile_number = $mobileNumber;
        $eventParticipant->created_at = $createdDatetime;
        $eventParticipant->save();
        return $eventParticipant->id;
    }

    public function getByIds(array $ids)
    {
        return EventParticipant::whereIn('id', $ids)->get();
    }
}
