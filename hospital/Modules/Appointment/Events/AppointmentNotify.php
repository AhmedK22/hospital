<?php

namespace Modules\Appointment\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Appointment\Entities\Appointment;


class AppointmentNotify
{
    use SerializesModels;
 public $appointment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
    
        $this->appointment = $appointment;
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
