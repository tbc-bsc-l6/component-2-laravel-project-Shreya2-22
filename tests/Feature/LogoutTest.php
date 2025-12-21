<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/login');

        $this->assertGuest(); // Ensure user is logged out
    }
}