<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LetterTemplate extends Model
{
    protected $fillable = [
        'letter_type_id',
        'name',
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the letter type for this template.
     */
    public function letterType(): BelongsTo
    {
        return $this->belongsTo(LetterType::class);
    }

    /**
     * Get active template for a letter type.
     */
    public static function getActiveForType(int $letterTypeId): ?static
    {
        return static::where('letter_type_id', $letterTypeId)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Parse template content with data.
     */
    public function parseContent(array $data): string
    {
        $content = $this->content;

        // Replace placeholders like {{name}}, {{nik}}, etc.
        foreach ($data as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value ?? '', $content);
        }

        return $content;
    }

    /**
     * Get available placeholders.
     */
    public static function getAvailablePlaceholders(): array
    {
        return [
            '{{nama}}' => 'Nama pemohon',
            '{{nik}}' => 'NIK pemohon',
            '{{tempat_lahir}}' => 'Tempat lahir',
            '{{tanggal_lahir}}' => 'Tanggal lahir',
            '{{jenis_kelamin}}' => 'Jenis kelamin',
            '{{agama}}' => 'Agama',
            '{{pekerjaan}}' => 'Pekerjaan',
            '{{alamat}}' => 'Alamat',
            '{{keperluan}}' => 'Keperluan',
            '{{nomor_surat}}' => 'Nomor surat',
            '{{tanggal_sekarang}}' => 'Tanggal sekarang',
            '{{nama_desa}}' => 'Nama desa',
            '{{kepala_desa}}' => 'Nama kepala desa',
        ];
    }
}
