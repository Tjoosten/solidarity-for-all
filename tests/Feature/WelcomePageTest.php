<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class WelcomePageTest
 *
 * @package Tests\Feature
 */
class WelcomePageTest extends TestCase
{
    /**
     * @testdox The user sees the login page as welcome page from the project
     */
    public function testUserSeesTheLoginPageAsWelcomePage(): void
    {
        $response = $this->get(route('welcome'));
        $response->isSuccessful();
        $response->assertViewIs('auth.login');
    }
}
