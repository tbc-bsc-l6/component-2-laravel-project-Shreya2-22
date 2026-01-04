<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\Module;
use App\Models\Enrollment;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserRoleSeeder::class);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['user_role_id' => 1]);
        
        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function non_admin_cannot_access_admin_dashboard()
    {
        $student = User::factory()->create(['user_role_id' => 3]);
        
        $this->actingAs($student)
            ->get('/admin')
            ->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_add_a_module()
    {
        $admin = User::factory()->create(['user_role_id' => 1]);
        
        Livewire::actingAs($admin)
            ->test('admin-dashboard')
            ->set('newModule', 'New Test Module')
            ->call('addModule');
        
        $this->assertDatabaseHas('modules', [
            'module' => 'New Test Module',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_toggle_module_status()
    {
        $admin = User::factory()->create(['user_role_id' => 1]);
        $module = Module::create(['module' => 'Test Module', 'active' => true]);
        
        Livewire::actingAs($admin)
            ->test('admin-dashboard')
            ->call('toggleModule', $module->id);
        
        $this->assertDatabaseHas('modules', [
            'id' => $module->id,
            'active' => false,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_change_user_role()
    {
        $admin = User::factory()->create(['user_role_id' => 1]);
        $student = User::factory()->create(['user_role_id' => 3]);
        
        Livewire::actingAs($admin)
            ->test('admin-dashboard')
            ->call('changeRole', $student->id, 2); // Change to teacher
        
        $this->assertDatabaseHas('users', [
            'id' => $student->id,
            'user_role_id' => 2,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function admin_can_remove_enrollment()
    {
        $admin = User::factory()->create(['user_role_id' => 1]);
        $student = User::factory()->create(['user_role_id' => 3]);
        $module = Module::create(['module' => 'Test Module', 'active' => true]);
        $enrollment = Enrollment::create([
            'user_id' => $student->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);
        
        Livewire::actingAs($admin)
            ->test('admin-dashboard')
            ->call('removeStudentFromModule', $enrollment->id);
        
        $this->assertDatabaseMissing('enrollments', [
            'id' => $enrollment->id,
        ]);
    }
}
