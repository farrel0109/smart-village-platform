<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $village1 = Village::where('village_code', 'DSA001')->first();
        $admin1 = User::where('email', 'admin@sukamaju.desa.id')->first();
        
        $announcements = [
            [
                'title' => 'Pembagian Bantuan Pangan',
                'content' => '<p>Dengan hormat, kami sampaikan kepada seluruh warga desa bahwa akan dilaksanakan pembagian bantuan pangan pada:</p><ul><li>Hari/Tanggal: Minggu, 25 Desember 2024</li><li>Waktu: 08.00 - 12.00 WITA</li><li>Tempat: Kantor Kepala Desa</li></ul><p>Warga diharapkan membawa Kartu Keluarga asli sebagai syarat pengambilan.</p>',
                'published_at' => now()->subDays(2),
                'is_published' => true,
                'village_id' => $village1?->id,
                'created_by' => $admin1?->id,
            ],
            [
                'title' => 'Musyawarah Desa 2024',
                'content' => '<p>Kepada seluruh warga desa,</p><p>Akan diselenggarakan Musyawarah Desa (Musdes) untuk membahas Rencana Kerja Pemerintah Desa (RKPDes) tahun 2025.</p><ul><li>Hari/Tanggal: Sabtu, 30 Desember 2024</li><li>Waktu: 13.00 WITA - selesai</li><li>Tempat: Balai Desa</li></ul><p>Kehadiran Bapak/Ibu sangat kami harapkan.</p>',
                'published_at' => now()->subDays(5),
                'is_published' => true,
                'village_id' => $village1?->id,
                'created_by' => $admin1?->id,
            ],
            [
                'title' => 'Jadwal Posyandu Januari 2025',
                'content' => '<p>Kepada para Ibu yang memiliki balita,</p><p>Kegiatan Posyandu bulan Januari 2025 akan dilaksanakan pada:</p><ul><li>Posyandu Mawar (RT 01-03): 10 Januari 2025</li><li>Posyandu Melati (RT 04-06): 15 Januari 2025</li><li>Posyandu Anggrek (RT 07-10): 20 Januari 2025</li></ul><p>Dimohon membawa KMS (Kartu Menuju Sehat) dan buku KIA.</p>',
                'published_at' => now()->subDays(1),
                'is_published' => true,
                'village_id' => $village1?->id,
                'created_by' => $admin1?->id,
            ],
            [
                'title' => 'Gotong Royong Bersih Desa',
                'content' => '<p>Dalam rangka menyambut tahun baru 2025, kami mengajak seluruh warga untuk bergotong royong membersihkan lingkungan desa.</p><ul><li>Hari/Tanggal: Minggu, 29 Desember 2024</li><li>Waktu: 06.00 - 10.00 WITA</li><li>Perlengkapan: Sapu, cangkul, karung sampah (bawa sendiri)</li></ul><p>Mari kita jaga kebersihan desa kita bersama-sama!</p>',
                'published_at' => now()->subHours(6),
                'is_published' => true,
                'village_id' => $village1?->id,
                'created_by' => $admin1?->id,
            ],
            [
                'title' => 'Draft: Peraturan Desa Baru',
                'content' => '<p>Ini adalah draft pengumuman tentang peraturan desa yang baru. Masih dalam tahap penyusunan.</p>',
                'published_at' => null,
                'is_published' => false,
                'village_id' => $village1?->id,
                'created_by' => $admin1?->id,
            ],
        ];

        foreach ($announcements as $announcementData) {
            Announcement::create($announcementData);
        }
    }
}
