<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\Module;
use App\Models\Enrollment;

class TeacherDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserRoleSeeder::class);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function teacher_can_access_teacher_dashboard()
    {
        $teacher = User::factory()->create(['user_role_id' => 2]);
        
        $this->actingAs($teacher)
            ->get('/teacher')
            ->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function teacher_sees_assigned_modules()
    {
        $teacher = User::factory()->create(['user_role_id' => 2]);
        $module = Module::create(['module' => 'Assigned Module', 'active' => true]);
        $module->teachers()->attach($teacher->id);
        
        Livewire::actingAs($teacher)
            ->test('teacher-dashboard')
            ->assertSee('Assigned Module');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function teacher_can_grade_student_pass()
    {
        $teacher = User::factory()->create(['user_role_id' => 2]);
        $student = User::factory()->create(['user_role_id' => 3]);
        $module = Module::create(['module' => 'Test Module', 'active' => true]);
        $module->teachers()->attach($teacher->id);
        
        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);
        
        Livewire::actingAs($teacher)
            ->test('teacher-dashboard')
            ->set('selectedModule', $module->id)
            ->call('gradeStudent', $enrollment->id, 'PASS');
        
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'completed',
            'grade' => 'PASS',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function teacher_can_grade_student_fail()
    {
        $teacher = User::factory()->create(['user_role_id' => 2]);
        $student = User::factory()->create(['user_role_id' => 3]);
        $module = Module::create(['module' => 'Test Module', 'active' => true]);
        $module->teachers()->attach($teacher->id);
        
        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);
        
        Livewire::actingAs($teacher)
            ->test('teacher-dashboard')
            ->set('selectedModule', $module->id)
            ->call('gradeStudent', $enrollment->id, 'FAIL');
        
        $this->assertDatabaseHas('enrollments', [
            'id' => $enrollment->id,
            'status' => 'completed',
            'grade' => 'FAIL',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function graded_student_enrollment_has_completed_at_timestamp()
    {
        $teacher = User::factory()->create(['user_role_id' => 2]);
        $student = User::factory()->create(['user_role_id' => 3]);
        $module = Module::create(['module' => 'Test Module', 'active' => true]);
        $module->teachers()->attach($teacher->id);
        
        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);
        
        Livewire::actingAs($teacher)
            ->test('teacher-dashboard')
            ->set('selectedModule', $module->id)
            ->call('gradeStudent', $enrollment->id, 'PASS');
        
        // Enrollment should have completed_at timestamp
        $enrollment->refresh();
        $this->assertNotNull($enrollment->completed_at);
    }
}
