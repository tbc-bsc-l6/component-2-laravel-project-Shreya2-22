<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Livewire\Livewire;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \App\Models\UserRole::create(['id' => 1, 'name' => 'Admin']);
        \App\Models\UserRole::create(['id' => 2, 'name' => 'Teacher']);
        \App\Models\UserRole::create(['id' => 3, 'name' => 'Student']);
        \App\Models\UserRole::create(['id' => 4, 'name' => 'Old Student']);
    }

    public function test_user_can_register()
    {
        Livewire::test(\App\Livewire\Auth\Register::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'user_role_id' => 3, // Student
        ]);
    }

    public function test_registration_requires_valid_data()
    {
        Livewire::test(\App\Livewire\Auth\Register::class)
            ->set('name', '')
            ->set('email', 'invalid-email')
            ->set('password', 'short')
            ->call('register')
            ->assertHasErrors(['name', 'email', 'password']);
    }
}