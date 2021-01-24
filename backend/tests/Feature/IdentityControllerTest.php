<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdentityControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @runInSeparateProcess
     * @return void
     */
    public function identity()
    {
        $user = factory(User::class)->create([
            'email' => 'a@example.com'
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept' => 'application/json',
        ])->json('GET', '/api/identity');
        $response->assertStatus(200);
        $response->assertJson([
            'user' => [
                'name' => $user->name
            ]
        ]);
    }
}
