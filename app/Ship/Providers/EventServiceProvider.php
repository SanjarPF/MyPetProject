<?php
declare(strict_types=1);

namespace App\Ship\Providers;

use App\Ship\Events\UserRegisteredEvent;
use App\Ship\Listeners\SendWelcomeEmailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegisteredEvent::class => [
            SendWelcomeEmailListener::class,
        ],
    ];
}
