<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Livewire\Livewire;

class LoginTest extends TestCase
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

    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'user_role_id' => 1, // Use existing role
        ]);

        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'invalid@example.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_requires_email()
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', '')
            ->set('password', 'password')
            ->call('login')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_login_requires_valid_email_format()
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'invalid-email')
            ->set('password', 'password')
            ->call('login')
            ->assertHasErrors(['email' => 'email']);
    }

    public function test_login_requires_password()
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'test@example.com')
            ->set('password', '')
            ->call('login')
            ->assertHasErrors(['password' => 'required']);
    }

    public function test_user_cannot_login_with_correct_email_but_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'user_role_id' => 1,
        ]);

        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'test@example.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertGuest();
    }

    public function test_user_can_login_with_remember_me()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'user_role_id' => 1,
        ]);

        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('remember', true)
            ->call('login')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }
}