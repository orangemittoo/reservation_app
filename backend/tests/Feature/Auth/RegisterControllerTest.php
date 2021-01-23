<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @runInSeparateProcess
     * @return void
     */
    public function ユーザー登録()
    {
        $response = $this->json('POST', '/api/register', [
            'name' => 'taro',
            'email' => 'a@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password1234'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => [
                'name',
                'email',
                'api_token'
            ]
        ]);
    }
}
