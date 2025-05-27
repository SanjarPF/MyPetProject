<?php

declare(strict_types=1);

namespace App\Ship\Listeners;

use App\Ship\Events\UserRegisteredEvent;
use App\Ship\Jobs\SendWelcomeEmailJob;

class SendWelcomeEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        SendWelcomeEmailJob::dispatch($event->user);
    }
}
