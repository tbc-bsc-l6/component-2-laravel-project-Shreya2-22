<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Module;
use App\Models\Enrollment;

class OldStudentSeeder extends Seeder
{
    /**
     * Create an old student with completed enrollments for testing.
     */
    public function run(): void
    {
        // Create old student user (or get existing)
        $oldStudent = User::firstOrCreate(
            ['email' => 'oldstudent@demo.com'],
            [
                'name' => 'Old Student Demo',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'user_role_id' => 4, // old_student role
            ]
        );

        // Get modules
        $modules = Module::take(3)->get();

        // Create completed enrollments with different grades (skip if already exists)
        if ($modules->count() >= 1) {
            Enrollment::firstOrCreate(
                ['user_id' => $oldStudent->id, 'module_id' => $modules[0]->id],
                [
                    'status' => 'completed',
                    'grade' => 'PASS',
                    'enrolled_at' => now()->subMonths(6),
                    'completed_at' => now()->subMonths(3),
                ]
            );
        }

        if ($modules->count() >= 2) {
            Enrollment::firstOrCreate(
                ['user_id' => $oldStudent->id, 'module_id' => $modules[1]->id],
                [
                    'status' => 'completed',
                    'grade' => 'FAIL',
                    'enrolled_at' => now()->subMonths(5),
                    'completed_at' => now()->subMonths(2),
                ]
            );
        }

        if ($modules->count() >= 3) {
            Enrollment::firstOrCreate(
                ['user_id' => $oldStudent->id, 'module_id' => $modules[2]->id],
                [
                    'status' => 'completed',
                    'grade' => 'PASS',
                    'enrolled_at' => now()->subMonths(4),
                    'completed_at' => now()->subMonth(),
                ]
            );
        }
    }
}
