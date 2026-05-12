<?php

namespace App\Mail;

use App\Models\Layanan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LayananNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Layanan $layanan)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[SIMTIK] Permintaan Layanan Baru: ' . $this->layanan->jenis_layanan,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.layanan-notification',
        );
    }
}
