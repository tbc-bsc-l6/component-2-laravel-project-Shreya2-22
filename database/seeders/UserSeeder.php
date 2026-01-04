<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'a@user.com'],
            [
                'name' => 'Another User',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'user_role_id' => 1,
            ]
        );
    }
}
