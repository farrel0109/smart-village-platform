<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get role IDs
        $superadminRoleId = Role::where('name', 'superadmin')->value('id') ?? 1;
        $adminRoleId = Role::where('name', 'admin')->value('id') ?? 2;
        $userRoleId = Role::where('name', 'user')->value('id') ?? 3;

        // Get village IDs
        $village1 = Village::where('code', 'DSA001')->first();
        $village2 = Village::where('code', 'DSA002')->first();

        $users = [
            // Super Admin - no village (manages all)
            [
                'name' => 'Super Administrator',
                'email' => 'superadmin@desapintar.id',
                'password' => Hash::make('superadmin123'),
                'role_id' => $superadminRoleId,
                'village_id' => null,
                'status' => 'approved',
            ],
            // Admin Desa Sukamaju
            [
                'name' => 'Admin Desa Sukamaju',
                'email' => 'admin@sukamaju.desa.id',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRoleId,
                'village_id' => $village1?->id,
                'status' => 'approved',
            ],
            // Admin Desa Makmur Jaya
            [
                'name' => 'Admin Desa Makmur Jaya',
                'email' => 'admin@makmurjaya.desa.id',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRoleId,
                'village_id' => $village2?->id,
                'status' => 'approved',
            ],
            // Regular users - Desa Sukamaju
            [
                'name' => 'Ahmad Subarjo',
                'email' => 'ahmad.subarjo@gmail.com',
                'password' => Hash::make('user123'),
                'role_id' => $userRoleId,
                'village_id' => $village1?->id,
                'status' => 'approved',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@gmail.com',
                'password' => Hash::make('user123'),
                'role_id' => $userRoleId,
                'village_id' => $village1?->id,
                'status' => 'approved',
            ],
            // Pending users
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'password' => Hash::make('user123'),
                'role_id' => $userRoleId,
                'village_id' => $village1?->id,
                'status' => 'submitted',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'password' => Hash::make('user123'),
                'role_id' => $userRoleId,
                'village_id' => $village2?->id,
                'status' => 'submitted',
            ],
            // Rejected user
            [
                'name' => 'Test Rejected',
                'email' => 'rejected@test.com',
                'password' => Hash::make('user123'),
                'role_id' => $userRoleId,
                'village_id' => $village1?->id,
                'status' => 'rejected',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
