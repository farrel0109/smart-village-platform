<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Village extends Model
{
    protected $fillable = [
        'name',
        'code',
        'province',
        'regency',
        'district',
        'address',
        'phone',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all users of this village.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all residents of this village.
     */
    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }

    /**
     * Get the admin user of this village.
     */
    public function admin()
    {
        return $this->users()->whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->first();
    }

    /**
     * Get full location string.
     */
    public function getFullLocationAttribute(): string
    {
        return "{$this->name}, Kec. {$this->district}, {$this->regency}, {$this->province}";
    }
}
