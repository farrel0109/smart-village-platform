<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Village;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $village1 = Village::where('village_code', 'DSA001')->first();
        
        $settings = [
            [
                'key' => 'village_name',
                'value' => 'Desa Sukamaju',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_head',
                'value' => 'H. Muhammad Yusuf, S.Sos',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_secretary',
                'value' => 'Drs. Ahmad Fauzi',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_address',
                'value' => 'Jl. Desa Sukamaju No. 1, Kec. Tanete Riattang, Kab. Bone, Sulawesi Selatan',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_phone',
                'value' => '(0481) 123456',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_email',
                'value' => 'admin@sukamaju.desa.id',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_website',
                'value' => 'https://sukamaju.desa.id',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'village_logo',
                'value' => 'img/logo-desa.png',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'letter_header',
                'value' => 'PEMERINTAH KABUPATEN BONE\nKECAMATAN TANETE RIATTANG\nDESA SUKAMAJU',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'letter_footer',
                'value' => 'Sekretariat: Jl. Desa Sukamaju No. 1, Telp. (0481) 123456',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'max_letter_per_day',
                'value' => '50',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'enable_notifications',
                'value' => 'true',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'auto_approve_users',
                'value' => 'false',
                'village_id' => $village1?->id,
            ],
            [
                'key' => 'backup_schedule',
                'value' => 'daily',
                'village_id' => $village1?->id,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                [
                    'key' => $setting['key'],
                    'village_id' => $setting['village_id']
                ],
                $setting
            );
        }
    }
}
