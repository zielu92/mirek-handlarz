<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class LoginPageTest
 * @package Tests\Feature
 */
class LoginPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_should_open_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
