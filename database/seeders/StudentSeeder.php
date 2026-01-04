<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Create 20 test students for testing enrollment limits.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            User::firstOrCreate(
                ['email' => "student{$i}@test.com"],
                [
                    'name' => "Test Student {$i}",
                    'email_verified_at' => now(),
                    'password' => bcrypt('1234'),
                    'user_role_id' => 3, // student role
                ]
            );
        }
    }
}
