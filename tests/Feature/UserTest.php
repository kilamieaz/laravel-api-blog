<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function a_user_can_get_their_profile()
    {
        $user = $this->signIn();

        $this->get('/api/user')
            ->assertStatus(200)
            ->assertJson($user->toArray());
    }
}
