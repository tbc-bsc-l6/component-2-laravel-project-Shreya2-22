<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\Module;
use App\Models\Enrollment;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserRoleSeeder::class);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function student_can_access_student_dashboard()
    {
        $student = User::factory()->create(['user_role_id' => 3]);
        
        $this->actingAs($student)
            ->get('/student')
            ->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function student_can_enroll_in_module()
    {
        $student = User::factory()->create(['user_role_id' => 3]);
        $module = Module::create(['module' => 'Test Module', 'active' => true]);
        
        Livewire::actingAs($student)
            ->test('student-dashboard')
            ->call('enroll', $module->id);
        
        $this->assertDatabaseHas('enrollments', [
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function student_cannot_enroll_in_more_than_4_modules()
    {
        $student = User::factory()->create(['user_role_id' => 3]);
        
        // Create 4 modules and enroll student in all
        for ($i = 1; $i <= 4; $i++) {
            $module = Module::create(['module' => "Module $i", 'active' => true]);
            Enrollment::create([
                'user_id' => $student->id,
                'module_id' => $module->id,
                'status' => 'enrolled',
                'enrolled_at' => now(),
            ]);
        }
        
        // Try to enroll in 5th module
        $fifthModule = Module::create(['module' => 'Fifth Module', 'active' => true]);
        
        Livewire::actingAs($student)
            ->test('student-dashboard')
            ->call('enroll', $fifthModule->id);
        
        $this->assertDatabaseMissing('enrollments', [
            'user_id' => $student->id,
            'module_id' => $fifthModule->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function module_cannot_have_more_than_10_students()
    {
        $module = Module::create(['module' => 'Popular Module', 'active' => true]);
        
        // Create 10 students and enroll them all
        for ($i = 1; $i <= 10; $i++) {
            $student = User::factory()->create(['user_role_id' => 3]);
            Enrollment::create([
                'user_id' => $student->id,
                'module_id' => $module->id,
                'status' => 'enrolled',
                'enrolled_at' => now(),
            ]);
        }
        
        // 11th student tries to enroll
        $newStudent = User::factory()->create(['user_role_id' => 3]);
        
        Livewire::actingAs($newStudent)
            ->test('student-dashboard')
            ->call('enroll', $module->id);
        
        $this->assertDatabaseMissing('enrollments', [
            'user_id' => $newStudent->id,
            'module_id' => $module->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function old_student_sees_only_completed_modules()
    {
        $oldStudent = User::factory()->create(['user_role_id' => 4]);
        $module = Module::create(['module' => 'Completed Module', 'active' => true]);
        
        Enrollment::create([
            'user_id' => $oldStudent->id,
            'module_id' => $module->id,
            'status' => 'completed',
            'grade' => 'PASS',
            'enrolled_at' => now()->subMonths(3),
            'completed_at' => now(),
        ]);
        
        Livewire::actingAs($oldStudent)
            ->test('student-dashboard')
            ->assertSee('Completed Modules History')
            ->assertSee('Completed Module')
            ->assertSee('PASS');
    }
}
