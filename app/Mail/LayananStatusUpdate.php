<?php

namespace App\Mail;

use App\Models\Layanan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LayananStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Layanan $layanan, public string $oldStatus)
    {
    }

    public function envelope(): Envelope
    {
        $statusLabel = $this->layanan->status == 'In Progress' ? 'Sedang Diproses' : 'Selesai';
        return new Envelope(
            subject: '[SIMTIK] Layanan Anda ' . $statusLabel . ' — Tiket #' . $this->layanan->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.layanan-status-update',
        );
    }
}
