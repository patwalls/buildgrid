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
        'Illuminate\Auth\Events\Login' => [
            'BuildGrid\Listeners\LogSuccessfulLogin',
        ],
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
