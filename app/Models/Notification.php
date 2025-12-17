<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'link',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(): void
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Check if notification is read.
     */
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /**
     * Get unread notifications for a user.
     */
    public static function unreadForUser(int $userId)
    {
        return static::where('user_id', $userId)
            ->whereNull('read_at')
            ->latest()
            ->get();
    }

    /**
     * Get unread count for a user.
     */
    public static function unreadCountForUser(int $userId): int
    {
        return static::where('user_id', $userId)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Create a letter status notification.
     */
    public static function notifyLetterStatus(int $userId, string $letterNumber, string $status, ?string $link = null): static
    {
        $statusLabels = [
            'processing' => 'sedang diproses',
            'completed' => 'telah selesai',
            'rejected' => 'ditolak',
        ];

        return static::create([
            'user_id' => $userId,
            'type' => 'letter_status',
            'title' => 'Status Surat Diperbarui',
            'message' => "Pengajuan surat {$letterNumber} " . ($statusLabels[$status] ?? $status) . ".",
            'data' => ['status' => $status],
            'link' => $link,
        ]);
    }

    /**
     * Create a user approval notification.
     */
    public static function notifyUserApproval(int $userId, string $status): static
    {
        $messages = [
            'approved' => 'Selamat! Akun Anda telah disetujui.',
            'rejected' => 'Maaf, akun Anda ditolak oleh admin.',
        ];

        return static::create([
            'user_id' => $userId,
            'type' => 'user_approval',
            'title' => 'Status Akun',
            'message' => $messages[$status] ?? 'Status akun Anda telah diperbarui.',
            'data' => ['status' => $status],
        ]);
    }
}
