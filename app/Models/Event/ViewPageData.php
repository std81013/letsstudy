<?php

namespace App\Models\Event;

use App\Models\Event;
use App\Models\User;

class ViewPageData
{
    /**
     * The Event model
     *
     * @var Event
     */
    public $event;

    /**
     * The EventParticipant model list
     *
     * @var array
     */
    public $participants;

    /**
     * The User model
     * 
     * @var User
     */
    public $user;
}
