<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Resident;
use App\Models\Village;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $village1 = Village::where('village_code', 'DSA001')->first();
        $village2 = Village::where('village_code', 'DSA002')->first();

        $families = [
            // Families for Desa Sukamaju
            [
                'family_card_number' => '7301012501200001',
                'head_name' => 'Ahmad Subarjo',
                'address' => 'Jl. Mawar No. 12, RT 001/RW 001',
                'village_id' => $village1?->id,
            ],
            [
                'family_card_number' => '7301012501200002',
                'head_name' => 'Budi Santoso',
                'address' => 'Jl. Melati No. 25, RT 002/RW 001',
                'village_id' => $village1?->id,
            ],
            [
                'family_card_number' => '7301012501200003',
                'head_name' => 'Siti Aminah',
                'address' => 'Jl. Anggrek No. 8, RT 003/RW 002',
                'village_id' => $village1?->id,
            ],
            [
                'family_card_number' => '7301012501200004',
                'head_name' => 'Dewi Lestari',
                'address' => 'Jl. Dahlia No. 15, RT 004/RW 002',
                'village_id' => $village1?->id,
            ],
            [
                'family_card_number' => '7301012501200005',
                'head_name' => 'Eko Prasetyo',
                'address' => 'Jl. Kenanga No. 20, RT 005/RW 003',
                'village_id' => $village1?->id,
            ],
            
            // Families for Desa Makmur Jaya
            [
                'family_card_number' => '7301022501200001',
                'head_name' => 'Hasan Basri',
                'address' => 'Jl. Merdeka No. 10, RT 001/RW 001',
                'village_id' => $village2?->id,
            ],
            [
                'family_card_number' => '7301022501200002',
                'head_name' => 'Indah Permata',
                'address' => 'Jl. Kemerdekaan No. 22, RT 002/RW 001',
                'village_id' => $village2?->id,
            ],
            [
                'family_card_number' => '7301022501200003',
                'head_name' => 'Joko Widodo',
                'address' => 'Jl. Pancasila No. 5, RT 003/RW 002',
                'village_id' => $village2?->id,
            ],
        ];

        foreach ($families as $familyData) {
            Family::updateOrCreate(
                ['family_card_number' => $familyData['family_card_number']],
                $familyData
            );
        }
    }
}
