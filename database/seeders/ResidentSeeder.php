<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\Village;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $village1 = Village::where('code', 'DSA001')->first();
        $village2 = Village::where('code', 'DSA002')->first();

        $residents = [
            // Desa Sukamaju residents
            [
                'nik' => '3201234567890001',
                'name' => 'Ahmad Subarjo',
                'gender' => 'male',
                'birth_date' => '1985-03-15',
                'birth_place' => 'Bone',
                'address' => 'Jl. Merdeka No. 1, RT 01/RW 01',
                'religion' => 'Islam',
                'marital_status' => 'married',
                'occupation' => 'Petani',
                'phone' => '081234567890',
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
            [
                'nik' => '3201234567890002',
                'name' => 'Siti Aminah',
                'gender' => 'female',
                'birth_date' => '1988-07-22',
                'birth_place' => 'Makassar',
                'address' => 'Jl. Merdeka No. 1, RT 01/RW 01',
                'religion' => 'Islam',
                'marital_status' => 'married',
                'occupation' => 'Ibu Rumah Tangga',
                'phone' => '081234567891',
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
            [
                'nik' => '3201234567890003',
                'name' => 'Budi Santoso',
                'gender' => 'male',
                'birth_date' => '1990-11-30',
                'birth_place' => 'Gowa',
                'address' => 'Jl. Kenanga No. 10, RT 02/RW 01',
                'religion' => 'Islam',
                'marital_status' => 'single',
                'occupation' => 'Pedagang',
                'phone' => '081234567892',
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
            [
                'nik' => '3201234567890004',
                'name' => 'Dewi Lestari',
                'gender' => 'female',
                'birth_date' => '1975-05-10',
                'birth_place' => 'Bone',
                'address' => 'Jl. Melati No. 5, RT 03/RW 02',
                'religion' => 'Kristen',
                'marital_status' => 'widowed',
                'occupation' => 'Guru',
                'phone' => '081234567893',
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
            [
                'nik' => '3201234567890005',
                'name' => 'Rudi Hartono',
                'gender' => 'male',
                'birth_date' => '1982-09-05',
                'birth_place' => 'Wajo',
                'address' => 'Jl. Anggrek No. 15, RT 01/RW 02',
                'religion' => 'Islam',
                'marital_status' => 'married',
                'occupation' => 'Wiraswasta',
                'phone' => '081234567894',
                'status' => 'active',
                'village_id' => $village1?->id,
            ],
            // Desa Makmur Jaya residents
            [
                'nik' => '3201234567890006',
                'name' => 'Sri Wahyuni',
                'gender' => 'female',
                'birth_date' => '1995-12-20',
                'birth_place' => 'Bone',
                'address' => 'Jl. Mawar No. 8, RT 02/RW 03',
                'religion' => 'Islam',
                'marital_status' => 'single',
                'occupation' => 'Pegawai Swasta',
                'phone' => '081234567895',
                'status' => 'active',
                'village_id' => $village2?->id,
            ],
            [
                'nik' => '3201234567890007',
                'name' => 'Hendra Gunawan',
                'gender' => 'male',
                'birth_date' => '1970-01-25',
                'birth_place' => 'Makassar',
                'address' => 'Jl. Dahlia No. 3, RT 04/RW 01',
                'religion' => 'Islam',
                'marital_status' => 'married',
                'occupation' => 'Kepala Desa',
                'phone' => '081234567896',
                'status' => 'active',
                'village_id' => $village2?->id,
            ],
            [
                'nik' => '3201234567890008',
                'name' => 'Maria Christina',
                'gender' => 'female',
                'birth_date' => '1992-08-14',
                'birth_place' => 'Pinrang',
                'address' => 'Jl. Tulip No. 12, RT 01/RW 04',
                'religion' => 'Katolik',
                'marital_status' => 'married',
                'occupation' => 'Bidan',
                'phone' => '081234567897',
                'status' => 'active',
                'village_id' => $village2?->id,
            ],
            [
                'nik' => '3201234567890009',
                'name' => 'Agus Setiawan',
                'gender' => 'male',
                'birth_date' => '1965-04-08',
                'birth_place' => 'Bone',
                'address' => 'Jl. Flamboyan No. 7, RT 03/RW 01',
                'religion' => 'Islam',
                'marital_status' => 'divorced',
                'occupation' => 'Pensiunan',
                'phone' => '081234567898',
                'status' => 'active',
                'village_id' => $village2?->id,
            ],
            [
                'nik' => '3201234567890010',
                'name' => 'Rina Kusuma',
                'gender' => 'female',
                'birth_date' => '1998-02-28',
                'birth_place' => 'Soppeng',
                'address' => 'Jl. Cempaka No. 20, RT 02/RW 02',
                'religion' => 'Islam',
                'marital_status' => 'single',
                'occupation' => 'Mahasiswa',
                'phone' => '081234567899',
                'status' => 'active',
                'village_id' => $village2?->id,
            ],
        ];

        foreach ($residents as $resident) {
            Resident::create($resident);
        }
    }
}
