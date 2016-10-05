<?php

namespace BuildGrid\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'BuildGrid\Events\UserWasCreated' => [
            'BuildGrid\Listeners\EmailUserCreated',
        ],
        'BuildGrid\Events\UserPasswordWasChanged' => [
            'BuildGrid\Listeners\EmailUserPasswordChanged',
        ],
        'BuildGrid\Events\NewProjectCreated' => [
            'BuildGrid\Listeners\EmailNewProjectCreated',
        ],
        'BuildGrid\Events\NewBom' => [
            'BuildGrid\Listeners\EmailNewBom',
        ],
        'BuildGrid\Events\ResponseAccepted' => [
            'BuildGrid\Listeners\EmailResponseAccepted',
        ],
        'BuildGrid\Events\BomFileStored' => [
            'BuildGrid\Listeners\RequestBomFilePreview',
        ],
        'Illuminate\Auth\Events\Login' => [
            'BuildGrid\Listeners\LogSuccessfulLogin',
        ],
        'filepreviews.success' => [
            'BuildGrid\Listeners\FilePreviewsSuccess'
        ],
        'BuildGrid\Events\SupplierRespondedBom' => [
            'BuildGrid\Listeners\EmailSupplierResponseBom',
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
