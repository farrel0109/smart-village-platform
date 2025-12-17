<?php

namespace App\Helpers;

use App\Models\LetterRequest;
use App\Models\Village;

class LetterNumberGenerator
{
    /**
     * Generate official letter number according to Indonesian regulation.
     * Format: [Nomor Urut] / [Kode Klasifikasi] / [Kode Desa] / [Bulan Romawi] / [Tahun]
     * Example: 015/470/DS-SJM/XII/2025
     *
     * @param string $classificationCode Kode klasifikasi dari Permendagri (470, 500, dll)
     * @param int|null $villageId Village ID for getting village code
     * @return string
     */
    public static function generate(string $classificationCode, ?int $villageId = null): string
    {
        // Get current year and month
        $year = date('Y');
        $month = date('n');
        
        // Get village code
        $villageCode = 'DS-XXX';
        if ($villageId) {
            $village = Village::find($villageId);
            if ($village && $village->village_code) {
                $villageCode = $village->village_code;
            }
        }
        
        // Get next sequence number for this year
        $lastNumber = LetterRequest::whereYear('created_at', $year)
            ->whereNotNull('letter_number')
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastNumber && $lastNumber->letter_number) {
            // Extract sequence from existing number (first part before /)
            $parts = explode('/', $lastNumber->letter_number);
            $sequence = ((int) $parts[0]) + 1;
        } else {
            $sequence = 1;
        }
        
        // Convert month to Roman numeral
        $romanMonth = self::monthToRoman($month);
        
        // Format: 015/470/DS-SJM/XII/2025
        return sprintf(
            '%03d/%s/%s/%s/%s',
            $sequence,
            $classificationCode,
            $villageCode,
            $romanMonth,
            $year
        );
    }
    
    /**
     * Convert month number to Roman numeral.
     */
    private static function monthToRoman(int $month): string
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        
        return $romans[$month] ?? 'I';
    }
}
