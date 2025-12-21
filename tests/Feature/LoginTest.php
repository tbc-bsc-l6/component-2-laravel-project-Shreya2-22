<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Livewire\Livewire;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'user_role_id' => 3, // Student
        ]);

        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard'); // Adjust redirect as needed
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', 'invalid@example.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors('email');
    }
}