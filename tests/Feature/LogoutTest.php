<?php

namespace Tests\Feature;

use Tests\TestCase;  // Fixed import
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\UserRole;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        UserRole::create(['id' => 1, 'name' => 'Admin']);
        UserRole::create(['id' => 2, 'name' => 'Teacher']);
        UserRole::create(['id' => 3, 'name' => 'Student']);
        UserRole::create(['id' => 4, 'name' => 'Old Student']);
    }

    public function test_user_can_logout()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_logout_without_being_authenticated()
    {
        $this->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_logout_with_admin_role()
    {
        /** @var User $user */
        $user = User::factory()->create(['user_role_id' => 1]);

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_logout_with_teacher_role()
    {
        /** @var User $user */
        $user = User::factory()->create(['user_role_id' => 2]);

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_logout_with_student_role()
    {
        /** @var User $user */
        $user = User::factory()->create(['user_role_id' => 3]);

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_logout_with_old_student_role()
    {
        /** @var User $user */
        $user = User::factory()->create(['user_role_id' => 4]);

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest();
    }
}