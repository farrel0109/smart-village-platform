<?php

namespace Database\Seeders;

use App\Models\LetterRequest;
use App\Models\User;
use App\Models\Village;
use App\Models\LetterType;
use Illuminate\Database\Seeder;

class LetterRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $village1 = Village::where('village_code', 'DSA001')->first();
        $user1 = User::where('email', 'ahmad.subarjo@gmail.com')->first();
        $user2 = User::where('email', 'siti.aminah@gmail.com')->first();
        $admin = User::where('email', 'admin@sukamaju.desa.id')->first();
        
        $letterTypeSkd = LetterType::where('code', 'SKD')->first();
        $letterTypeSku = LetterType::where('code', 'SKU')->first();

        $requests = [
            // Completed letter
            [
                'request_number' => 'REQ202412180001',
                'letter_number' => '470/001/DS-SJM/XII/2024',
                'user_id' => $user1?->id,
                'village_id' => $village1?->id,
                'letter_type_id' => $letterTypeSkd?->id,
                'purpose' => 'Pengurusan KTP',
                'notes' => 'Mohon diproses segera',
                'dynamic_data' => json_encode([
                    'name' => 'Ahmad Subarjo',
                    'nik' => '7301012501850001',
                    'birth_place' => 'Watampone',
                    'birth_date' => '25 Januari 1985',
                    'gender' => 'Laki-laki',
                    'occupation' => 'Wiraswasta',
                    'address' => 'Jl. Mawar No. 12, RT 001/RW 001',
                    'domicile_since' => '1 Januari 2010',
                ]),
                'attachments' => json_encode([]),
                'signed_by' => 'head',
                'status' => 'completed',
                'rejection_reason' => null,
                'document_path' => 'letters/2024/12/SKD-202412180001.pdf',
                'processed_by' => $admin?->id,
                'processed_at' => now()->subDays(2),
                'created_at' => now()->subDays(3),
            ],
            // Processing letter
            [
                'request_number' => 'REQ202412180002',
                'letter_number' => null,
                'user_id' => $user2?->id,
                'village_id' => $village1?->id,
                'letter_type_id' => $letterTypeSku?->id,
                'purpose' => 'Pengajuan kredit bank',
                'notes' => null,
                'dynamic_data' => json_encode([
                    'name' => 'Siti Aminah',
                    'nik' => '7301012501900002',
                    'birth_place' => 'Watampone',
                    'birth_date' => '15 Mei 1990',
                    'gender' => 'Perempuan',
                    'address' => 'Jl. Anggrek No. 8, RT 003/RW 002',
                    'business_type' => 'Warung Kelontong',
                    'business_name' => 'Toko Aminah',
                    'business_address' => 'Jl. Anggrek No. 8',
                    'business_since' => 'Januari 2015',
                ]),
                'attachments' => json_encode([]),
                'signed_by' => null,
                'status' => 'processing',
                'rejection_reason' => null,
                'document_path' => null,
                'processed_by' => $admin?->id,
                'processed_at' => now()->subHours(5),
                'created_at' => now()->subDays(1),
            ],
            // Pending letter
            [
                'request_number' => 'REQ202412180003',
                'letter_number' => null,
                'user_id' => $user1?->id,
                'village_id' => $village1?->id,
                'letter_type_id' => $letterTypeSkd?->id,
                'purpose' => 'Keperluan sekolah anak',
                'notes' => 'Untuk pendaftaran sekolah',
                'dynamic_data' => json_encode([
                    'name' => 'Ahmad Subarjo',
                    'nik' => '7301012501850001',
                    'birth_place' => 'Watampone',
                    'birth_date' => '25 Januari 1985',
                    'gender' => 'Laki-laki',
                    'occupation' => 'Wiraswasta',
                    'address' => 'Jl. Mawar No. 12, RT 001/RW 001',
                    'domicile_since' => '1 Januari 2010',
                ]),
                'attachments' => json_encode([]),
                'signed_by' => null,
                'status' => 'pending',
                'rejection_reason' => null,
                'document_path' => null,
                'processed_by' => null,
                'processed_at' => null,
                'created_at' => now()->subHours(3),
            ],
            // Rejected letter
            [
                'request_number' => 'REQ202412180004',
                'letter_number' => null,
                'user_id' => $user2?->id,
                'village_id' => $village1?->id,
                'letter_type_id' => $letterTypeSku?->id,
                'purpose' => 'Test rejection',
                'notes' => 'Data tidak lengkap',
                'dynamic_data' => json_encode([
                    'name' => 'Siti Aminah',
                    'nik' => '7301012501900002',
                ]),
                'attachments' => json_encode([]),
                'signed_by' => null,
                'status' => 'rejected',
                'rejection_reason' => 'Data yang dilampirkan tidak lengkap. Mohon lengkapi data usaha dan lampirkan foto tempat usaha.',
                'document_path' => null,
                'processed_by' => $admin?->id,
                'processed_at' => now()->subDays(1),
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($requests as $requestData) {
            LetterRequest::create($requestData);
        }
    }
}
