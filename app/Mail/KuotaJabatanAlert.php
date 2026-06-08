<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KuotaJabatanAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $alertData;

    public function __construct($alertData)
    {
        $this->alertData = $alertData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Peringatan: Kekurangan Anggota pada Jabatan',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.kuota-jabatan-alert',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
