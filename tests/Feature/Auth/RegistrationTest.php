<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->markTestSkipped('skipped because it requires a working mail server');
    }
}
