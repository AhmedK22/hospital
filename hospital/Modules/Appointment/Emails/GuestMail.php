<?php

namespace Modules\Appointment\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Modules\Appointment\Entities\Appointment;

class GuestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment)
    {
        $this->data = $appointment;
    }




    public function content()
    {
 

        return new Content(
            view: 'appointment::emails.guest',
            with: [
                'appointment' => $this->data,

            ],
        );
    }
}
