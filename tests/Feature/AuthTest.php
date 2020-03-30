<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_login()
    {
        // $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ], ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonStructure(['data' => ['id', 'name', 'email', 'created_at', 'updated_at', 'accessToken']]);
    }

    /** @test */
    public function a_user_can_logout()
    {
        $this->signIn();
        $response = $this->postJson(route('auth.logout'));
        $response->assertStatus(200)
        ->assertJsonStructure(['message']);
    }

    /** @test */
    public function a_user_can_register()
    {
        $data = factory(User::class)->raw();
        $this->postJson(route('auth.register'), $data, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJsonStructure(['data' => ['id', 'name', 'email', 'created_at', 'updated_at', 'accessToken']]);
    }
}
