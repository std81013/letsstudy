<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * @test
     */
    public function accessListView(): void
    {
        $response = $this->get('/event/list');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function accessView(): void
    {
        $response = $this->get('/event/view/1');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function accessJoinView(): void
    {
        $response = $this->get('/event/join/1');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function saveJoinEvent(): void
    {
        $response = $this->post('/event/join', ['email' => 'test@test.tesss', 'password' => '123456789', 'nickname' => 'test']);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function accessAddView(): void
    {
        $response = $this->get('/event/add');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function accessEditView(): void
    {
        $response = $this->get('/event/edit/:id');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function insertEvent(): void
    {
        $response = $this->post('/event/store');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function updateEvent(): void
    {
        $response = $this->post('/event/store');

        $response->assertStatus(200);
    }
}
