<?php

namespace Database\Seeders;

use App\Models\LetterType;
use Illuminate\Database\Seeder;

class LetterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Surat Keterangan Domisili',
                'code' => 'SKD',
                'description' => 'Surat yang menerangkan bahwa seseorang benar-benar berdomisili di suatu wilayah.',
                'requirements' => 'KTP, Kartu Keluarga',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'code' => 'SKTM',
                'description' => 'Surat yang menerangkan bahwa seseorang berasal dari keluarga tidak mampu.',
                'requirements' => 'KTP, Kartu Keluarga, Foto rumah',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Pengantar SKCK',
                'code' => 'SKCK',
                'description' => 'Surat pengantar untuk pembuatan Surat Keterangan Catatan Kepolisian.',
                'requirements' => 'KTP, Kartu Keluarga, Pas foto 4x6',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Keterangan Usaha',
                'code' => 'SKU',
                'description' => 'Surat yang menerangkan bahwa seseorang memiliki usaha di wilayah desa.',
                'requirements' => 'KTP, Kartu Keluarga, Bukti kepemilikan usaha',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Keterangan Belum Menikah',
                'code' => 'SKBM',
                'description' => 'Surat yang menerangkan bahwa seseorang belum pernah menikah.',
                'requirements' => 'KTP, Kartu Keluarga',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Keterangan Kelahiran',
                'code' => 'SKL',
                'description' => 'Surat keterangan untuk proses pembuatan akta kelahiran.',
                'requirements' => 'KTP orang tua, Kartu Keluarga, Surat keterangan dari bidan/RS',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Keterangan Kematian',
                'code' => 'SKM',
                'description' => 'Surat keterangan untuk proses pembuatan akta kematian.',
                'requirements' => 'KTP almarhum, Kartu Keluarga, Surat keterangan dokter',
                'is_active' => true,
            ],
            [
                'name' => 'Surat Pengantar Pindah',
                'code' => 'SPP',
                'description' => 'Surat pengantar untuk proses pindah domisili ke wilayah lain.',
                'requirements' => 'KTP, Kartu Keluarga, Alasan pindah',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            LetterType::updateOrCreate(
                ['code' => $type['code']],
                $type
            );
        }
    }
}
