<?php

namespace App\Repositories;

use App\Models\EventParticipant;

class EventParticipantRepository
{
    private $eventParticipant;
    public function __construct(EventParticipant $eventParticipant)
    {
        $this->eventParticipant = $eventParticipant;
    }

    public function create(string $eventId, string $participant, string $participantId, string $email, string $mobileNumber, string $createdDatetime)
    {
        $this->eventParticipant->event_id = $eventId;
        $this->eventParticipant->participant = $participant;
        $this->eventParticipant->participant_id = $participantId;
        $this->eventParticipant->email = $email;
        $this->eventParticipant->mobile_number = $mobileNumber;
        $this->eventParticipant->created_at = $createdDatetime;
        $id = $this->eventParticipant->save();
        return $id;
    }

    public function getByIds(array $ids)
    {
        return $this->eventParticipant->whereIn('id', $ids)->get();
    }
}
