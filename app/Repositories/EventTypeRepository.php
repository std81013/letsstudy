<?php

namespace App\Repositories;

use App\Models\EventType;

class EventTypeRepository
{
    private $eventType;
    public function __construct(EventType $eventType)
    {
        $this->eventType = $eventType;
    }

    public function getList()
    {
        return $this->eventType->all();
    }

    public function getListWithoutAll()
    {
        return $this->eventType->whereNotNull('type_name')->get();
    }
}
