<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin1232@gmail.com',
            'password' => bcrypt('admin1232'),
            'role_id' => 1, // Assuming 1 is the ID for the admin role
            'status' => 'submitted',
        ]);
    }
}
