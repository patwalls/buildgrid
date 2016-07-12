<?php

namespace BuildGrid\Events;

use BuildGrid\Bom;
use BuildGrid\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewBom extends Event
{
    use SerializesModels;

    public $bom;

    /**
     * Create a new event instance.
     *
     * @param Bom $bom
     */
    public function __construct(Bom $bom)
    {
        $this->bom = $bom;
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
