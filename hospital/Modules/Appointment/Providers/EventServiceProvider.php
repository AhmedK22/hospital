<?php

namespace Modules\Appointment\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\Appointment\Events\AppointmentNotify;
use Modules\Appointment\Listeners\AppointmentNotifyListener;

class EventServiceProvider extends ServiceProvider
{
  
    protected $listen = [
        AppointmentNotify::class => [
            AppointmentNotifyListener::class,

        ],

    ];

  

}
