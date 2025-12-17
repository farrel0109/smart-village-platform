<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    protected $fillable = [
        'kk_number',
        'head_name',
        'head_resident_id',
        'address',
        'rt',
        'rw',
        'village_id',
        'status',
    ];

    /**
     * Get the head resident of this family.
     */
    public function headResident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'head_resident_id');
    }

    /**
     * Get all members of this family.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Resident::class);
    }

    /**
     * Get the village this family belongs to.
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * Get member count.
     */
    public function getMemberCountAttribute(): int
    {
        return $this->members()->count();
    }

    /**
     * Get full address with RT/RW.
     */
    public function getFullAddressAttribute(): string
    {
        $address = $this->address;
        if ($this->rt) {
            $address .= ', RT ' . $this->rt;
        }
        if ($this->rw) {
            $address .= '/RW ' . $this->rw;
        }
        return $address;
    }
}
