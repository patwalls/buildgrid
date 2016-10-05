<?php
/**
 * Created by PhpStorm.
 * User: gerardo
 * Date: 5/10/16
 * Time: 05:26 PM
 */

namespace BuildGrid\Events;

use BuildGrid\BomResponse;
use BuildGrid\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SupplierRespondedBom extends Event
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
