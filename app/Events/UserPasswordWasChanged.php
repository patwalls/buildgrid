<?php

namespace BuildGrid\Events;

use BuildGrid\Events\Event;
use BuildGrid\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserPasswordWasChanged extends Event
{
    use SerializesModels;
    
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
