<?php

namespace BuildGrid\Events;

use BuildGrid\BomResponse;
use BuildGrid\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResponseAccepted extends Event
{
    use SerializesModels;

    public $bomResponse;

    /**
     * Create a new event instance.
     *
     * @param BomResponse $bomResponse
     */
    public function __construct(BomResponse $bomResponse)
    {
        $this->bomResponse = $bomResponse;
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
