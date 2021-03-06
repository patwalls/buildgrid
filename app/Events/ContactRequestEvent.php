<?php

namespace BuildGrid\Events;

use Illuminate\Queue\SerializesModels;


class ContactRequestEvent extends Event
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     */
    public function broadcastOn()
    {
        return [];
    }
}
