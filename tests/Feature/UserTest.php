<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function access_dashboard_without_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function login(): void
    {
        $response = $this->post('/login', ['email' => 'test@test.test', 'password' => '123456789']);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store(): void
    {
        $response = $this->post('/store', ['email' => 'test@test.test', 'password' => '123456789', 'nickname' => 'test']);

        $response->assertStatus(302);
    }
}
