<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'province_id' => 35,
                'district_id' => 3508,
                'subdistrict_id' => 3508090,
                'username' => 'admin',
                'name' => 'admin',
                'gender' => 'male',
                'address' => 'Lahore Pakistan',
                'place_of_birth' => 'Rajanpur',
                'date_of_birth' => '18-11-2003',
                'email' => 'admin@gmail.com',
                'phone' => '1234567890',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
            ],
        ];

        foreach ($userData as $data) {
            User::create($data);
        }
    }
}
