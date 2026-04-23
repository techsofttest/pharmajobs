<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $planName;
    public $paymentId;
    public $startDate;
    public $expirationDate;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $planName, $paymentId, $startDate, $expirationDate)
    {
        $this->user = $user;
        $this->planName = $planName;
        $this->paymentId = $paymentId;
        $this->startDate = $startDate;
        $this->expirationDate = $expirationDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Successful - Pharma Healthcare Jobs',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription_success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
