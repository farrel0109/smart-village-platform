<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LetterType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'classification_code',
        'description',
        'requirements',
        'template_view',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'requirements' => 'array', // JSON to array
    ];

    /**
     * Get all letter requests of this type.
     */
    public function letterRequests(): HasMany
    {
        return $this->hasMany(LetterRequest::class);
    }
}
