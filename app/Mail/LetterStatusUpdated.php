<?php

namespace App\Mail;

use App\Models\LetterRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LetterStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public LetterRequest $letter;
    public string $statusLabel;

    /**
     * Create a new message instance.
     */
    public function __construct(LetterRequest $letter)
    {
        $this->letter = $letter;
        $this->statusLabel = $this->getStatusLabel($letter->status);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status Pengajuan Surat Diperbarui - ' . $this->letter->request_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.letter-status',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Get status label in Indonesian.
     */
    private function getStatusLabel(string $status): string
    {
        return match($status) {
            'pending' => 'Menunggu',
            'processing' => 'Sedang Diproses',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak',
            default => $status,
        };
    }
}
