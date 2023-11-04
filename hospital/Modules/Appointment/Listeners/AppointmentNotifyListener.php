<?php

namespace Modules\Appointment\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Appointment\Emails\GuestMail;
use Modules\Appointment\Events\AppointmentNotify;
use Exception;

class AppointmentNotifyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
       
          
        return Mail::to($event->appointment->email)->send(new GuestMail($event->appointment->appointment));
      
       
     

    }
}
