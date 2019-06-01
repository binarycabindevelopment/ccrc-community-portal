<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $contactSubmission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactSubmission)
    {
        $this->contactSubmission = $contactSubmission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $community = $this->contactSubmission->getCommunity();
        $this->subject('Community Contact - '.$community->name);
        $this->to($community->getContactRecipientEmail());
        return $this->view('mail.contact-submission',['contactSubmission'=>$this->contactSubmission,'community'=>$community]);
    }
}
