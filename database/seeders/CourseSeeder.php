<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            ['name' => 'Introduction to Programming', 'available' => true],
            ['name' => 'Data Structures', 'available' => true],
            ['name' => 'Algorithms', 'available' => true],
            ['name' => 'Web Development', 'available' => true],
            ['name' => 'Database Systems', 'available' => true],
        ]);
    }
}