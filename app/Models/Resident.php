<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    protected $table = 'residents';

    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'religion',
        'marital_status',
        'occupation',
        'phone',
        'photo',
        'status',
        'village_id',
        'family_id',
        'family_role',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the village of the resident.
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * Get the family of the resident.
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * Get formatted birth date.
     */
    public function getFormattedBirthDateAttribute(): string
    {
        return $this->birth_date?->format('d/m/Y') ?? '-';
    }

    /**
     * Get tempat tanggal lahir.
     */
    public function getTtlAttribute(): string
    {
        return "{$this->birth_place}, {$this->formatted_birth_date}";
    }

    /**
     * Get family role label.
     */
    public function getFamilyRoleLabelAttribute(): string
    {
        return match($this->family_role) {
            'head' => 'Kepala Keluarga',
            'wife' => 'Istri',
            'child' => 'Anak',
            'parent' => 'Orang Tua',
            'other' => 'Lainnya',
            default => '-',
        };
    }
}
