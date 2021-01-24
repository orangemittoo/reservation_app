<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @runInSeparateProcess
     * @return void
     */
    public function ログイン()
    {
        $user = factory(User::class)->create([
            'email' => 'a@example.com'
        ]);
        $response = $this->json('POST', '/api/login', [
            'email' => 'a@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $response->assertJSON([
            'user' => [
                'api_token' => $user->api_token
            ]
        ]);
    }
}
