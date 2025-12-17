<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villages = [
            [
                'name' => 'Desa Sukamaju',
                'code' => 'DSA001',
                'province' => 'Sulawesi Selatan',
                'regency' => 'Kabupaten Bone',
                'district' => 'Kecamatan Tanete Riattang',
                'address' => 'Jl. Desa Sukamaju No. 1',
                'phone' => '081234567001',
                'email' => 'admin@sukamaju.desa.id',
                'is_active' => true,
            ],
            [
                'name' => 'Desa Makmur Jaya',
                'code' => 'DSA002',
                'province' => 'Sulawesi Selatan',
                'regency' => 'Kabupaten Bone',
                'district' => 'Kecamatan Tanete Riattang Barat',
                'address' => 'Jl. Desa Makmur Jaya No. 5',
                'phone' => '081234567002',
                'email' => 'admin@makmurjaya.desa.id',
                'is_active' => true,
            ],
            [
                'name' => 'Desa Harapan Baru',
                'code' => 'DSA003',
                'province' => 'Sulawesi Selatan',
                'regency' => 'Kabupaten Gowa',
                'district' => 'Kecamatan Somba Opu',
                'address' => 'Jl. Desa Harapan Baru No. 10',
                'phone' => '081234567003',
                'email' => 'admin@harapanbaru.desa.id',
                'is_active' => true,
            ],
            [
                'name' => 'Desa Sejahtera',
                'code' => 'DSA004',
                'province' => 'Sulawesi Selatan',
                'regency' => 'Kota Makassar',
                'district' => 'Kecamatan Tamalate',
                'address' => 'Jl. Desa Sejahtera No. 15',
                'phone' => '081234567004',
                'email' => 'admin@sejahtera.desa.id',
                'is_active' => true,
            ],
        ];

        foreach ($villages as $village) {
            Village::updateOrCreate(
                ['code' => $village['code']],
                $village
            );
        }
    }
}
