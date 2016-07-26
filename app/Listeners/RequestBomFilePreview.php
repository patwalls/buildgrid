<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\BomFileStored;
use BuildGrid\Repositories\BomRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestBomFilePreview
{
    /**
     * Create the event listener.
     */
    public function __construct(BomRepository $bomRepository)
    {
        $this->bomRepository = $bomRepository;
    }

    /**
     * Handle the event.
     *
     * @param  BomFileStored  $event
     * @return void
     */
    public function handle(BomFileStored $event)
    {

        $this->bomRepository->requestPreview($event->bom);

    }
}
