<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function accessDashboardWithoutLogin(): void
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
    public function insertUser(): void
    {
        $response = $this->post('/user/store', ['email' => 'test@test.tesss', 'password' => '123456789', 'nickname' => 'test']);
        Mail::fake();
        Mail::assertSent(OrderShipped::class, function ($mail) {
            return $mail->hasTo('s0952785388@gmail.com');
        });
        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('請至註冊的信箱收信，預計5-10分鐘內會收到');

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.tesss',
            'password' => '123456789',
            'nickname' => 'test'
        ]);
        $response->assertStatus(200);
    }
}
