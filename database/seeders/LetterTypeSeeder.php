<?php

namespace Database\Seeders;

use App\Models\LetterType;
use Illuminate\Database\Seeder;

class LetterTypeSeeder extends Seeder
{
    /**
     * Seed the letter types according to Indonesian regulations (Permendagri No. 78/2012).
     */
    public function run(): void
    {
        $letterTypes = [
            [
                'code' => 'SKU',
                'name' => 'Surat Keterangan Usaha',
                'classification_code' => '500',
                'description' => 'Surat keterangan untuk keperluan usaha/bisnis, termasuk pengajuan pinjaman bank (KUR), perizinan usaha, dan keperluan bisnis lainnya.',
                'requirements' => json_encode([
                    'Fotokopi KTP',
                    'Fotokopi Kartu Keluarga',
                    'Pas Foto 3x4 (2 lembar)',
                    'Foto Tempat Usaha',
                    'Surat Pengantar RT/RW',
                ]),
                'template_view' => 'pdf.letters.sku',
                'is_active' => true,
            ],
            [
                'code' => 'SKD',
                'name' => 'Surat Keterangan Domisili',
                'classification_code' => '470',
                'description' => 'Surat keterangan tempat tinggal/domisili untuk keperluan administrasi seperti pindah, kerja, sekolah, atau keperluan lainnya.',
                'requirements' => json_encode([
                    'Fotokopi KTP',
                    'Fotokopi Kartu Keluarga',
                    'Surat Pengantar RT/RW',
                ]),
                'template_view' => 'pdf.letters.skd',
                'is_active' => true,
            ],
            [
                'code' => 'SKTM',
                'name' => 'Surat Keterangan Tidak Mampu',
                'classification_code' => '400',
                'description' => 'Surat keterangan keluarga tidak mampu untuk keperluan beasiswa, keringanan biaya rumah sakit, BPJS, atau bantuan sosial lainnya.',
                'requirements' => json_encode([
                    'Fotokopi KTP',
                    'Fotokopi Kartu Keluarga',
                    'Surat Pernyataan Tidak Mampu bermaterai',
                    'Surat Pengantar RT/RW',
                    'Foto Rumah (tampak depan)',
                ]),
                'template_view' => 'pdf.letters.sktm',
                'is_active' => true,
            ],
            [
                'code' => 'SKCK',
                'name' => 'Surat Pengantar SKCK',
                'classification_code' => '300',
                'description' => 'Surat pengantar untuk pembuatan Surat Keterangan Catatan Kepolisian (SKCK) di Polsek/Polres.',
                'requirements' => json_encode([
                    'Fotokopi KTP',
                    'Fotokopi Kartu Keluarga',
                    'Fotokopi Akta Kelahiran',
                    'Pas Foto 4x6 background merah (6 lembar)',
                    'Surat Pengantar RT/RW',
                ]),
                'template_view' => 'pdf.letters.skck',
                'is_active' => true,
            ],
            [
                'code' => 'SKM',
                'name' => 'Surat Keterangan Kematian',
                'classification_code' => '474.3',
                'description' => 'Surat keterangan kematian untuk pengurusan akta kematian di Disdukcapil.',
                'requirements' => json_encode([
                    'Fotokopi KTP Almarhum/ah',
                    'Fotokopi Kartu Keluarga',
                    'Surat Keterangan Dokter/Rumah Sakit',
                    'Fotokopi KTP Pelapor',
                    'Surat Pernyataan 2 Saksi',
                ]),
                'template_view' => 'pdf.letters.skm',
                'is_active' => true,
            ],
            [
                'code' => 'SKL',
                'name' => 'Surat Keterangan Kelahiran',
                'classification_code' => '474.1',
                'description' => 'Surat keterangan kelahiran untuk pengurusan akta kelahiran di Disdukcapil.',
                'requirements' => json_encode([
                    'Fotokopi KTP Kedua Orang Tua',
                    'Fotokopi Kartu Keluarga',
                    'Fotokopi Buku Nikah/Akta Nikah',
                    'Surat Keterangan Lahir dari Bidan/RS',
                    'Surat Pernyataan 2 Saksi',
                ]),
                'template_view' => 'pdf.letters.skl',
                'is_active' => true,
            ],
            [
                'code' => 'SKBM',
                'name' => 'Surat Keterangan Belum Menikah',
                'classification_code' => '474.2',
                'description' => 'Surat keterangan belum menikah untuk keperluan pernikahan di KUA atau keperluan administrasi lainnya.',
                'requirements' => json_encode([
                    'Fotokopi KTP',
                    'Fotokopi Kartu Keluarga',
                    'Pas Foto 3x4 (2 lembar)',
                    'Surat Pengantar RT/RW',
                ]),
                'template_view' => 'pdf.letters.skbm',
                'is_active' => true,
            ],
            [
                'code' => 'SKPD',
                'name' => 'Surat Keterangan Pindah Domisili',
                'classification_code' => '471',
                'description' => 'Surat keterangan pindah untuk keperluan pindah domisili ke daerah lain.',
                'requirements' => json_encode([
                    'Fotokopi KTP seluruh anggota keluarga yang pindah',
                    'Fotokopi Kartu Keluarga',
                    'Surat Pengantar RT/RW',
                    'Alamat tujuan lengkap',
                ]),
                'template_view' => 'pdf.letters.skpd',
                'is_active' => true,
            ],
            [
                'code' => 'SKW',
                'name' => 'Surat Keterangan Waris',
                'classification_code' => '600',
                'description' => 'Surat keterangan ahli waris untuk keperluan pembagian harta warisan.',
                'requirements' => json_encode([
                    'Fotokopi KTP Pewaris (almarhum)',
                    'Fotokopi Kartu Keluarga',
                    'Fotokopi Akta Kematian',
                    'Fotokopi KTP Semua Ahli Waris',
                    'Surat Pernyataan Ahli Waris bermaterai',
                    'Surat Pengantar RT/RW',
                ]),
                'template_view' => 'pdf.letters.skw',
                'is_active' => true,
            ],
            [
                'code' => 'SK-UMUM',
                'name' => 'Surat Keterangan Umum',
                'classification_code' => '400',
                'description' => 'Surat keterangan untuk keperluan umum lainnya yang tidak termasuk dalam kategori khusus.',
                'requirements' => json_encode([
                    'Fotokopi KTP',
                    'Fotokopi Kartu Keluarga',
                    'Surat Pengantar RT/RW',
                    'Surat Pernyataan (jika diperlukan)',
                ]),
                'template_view' => 'pdf.letters.sk-umum',
                'is_active' => true,
            ],
        ];

        foreach ($letterTypes as $type) {
            LetterType::updateOrCreate(
                ['code' => $type['code']],
                $type
            );
        }
    }
}
