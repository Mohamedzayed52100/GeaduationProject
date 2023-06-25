<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestDiseaseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $disease;
    protected $date;
    protected $MRN;
    protected $Name;
    protected $Email;

    public function __construct($disease , $date , $MRN , $Name , $Email)
    {
        $this->disease=$disease;
        $this->date=$date;
        $this->MRN=$MRN;
        $this->Name=$Name;
        $this->Email=$Email;


    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Disease Request Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.DiseaseMail',
            with: [
                'date'=> $this->date,
                'disease'=> $this->disease,
                'MRN'=> $this->MRN,
                'Email'=> $this->Email,
                'Name'=> $this->Name,
                ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
