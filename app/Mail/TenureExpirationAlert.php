<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TenureExpirationAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $anggota;

    public function __construct($anggota)
    {
        $this->anggota = $anggota;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Peringatan: Masa Jabatan Anggota Akan Berakhir',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.tenure-expiration-alert',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
