<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            VillageSeeder::class,
            UserSeeder::class,
            ResidentSeeder::class,
            FamilySeeder::class,
            LetterTypeSeeder::class,
            SettingSeeder::class,
            LetterTemplateSeeder::class,
            AnnouncementSeeder::class,
            LetterRequestSeeder::class,
        ]);
    }
}
