<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class LoginPageTest
 * @package Tests\Feature
 */
class AdminPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_should_open_admin_page_as_admin()
    {
        $this->be($this->getAdmin());
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
}
