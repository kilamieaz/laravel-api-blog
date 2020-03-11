<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageCategory extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_see_all_categories()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $category = factory('App\Category')->create([
            'name' => 'Category 1',
        ]);
        $response = $this->getJson('categories')->assertStatus(200);

        $this->assertEquals('Category 1', $response->json()['data'][0]['name']);
    }

    /** @test */
    public function a_user_can_create_a_category()
    {
        $this->signIn();

        $data = factory('App\Category')->raw();
        $response = $this->postJson('categories', $data)
        ->assertStatus(200)
        ->assertJsonStructure(['data' => ['id', 'name', 'created_at', 'updated_at']]);
    }

    /** @test */
    public function a_user_can_update_a_category()
    {
        $this->signIn();

        $attributes = ['name' => 'category changed'];

        $category = factory('App\Category')->create();

        $response = $this->putJson("categories/$category->id", $attributes)
        ->assertStatus(200)
        ->assertJsonStructure(['data' => ['id', 'name', 'created_at', 'updated_at']]);

        $this->assertDatabaseHas('categories', $attributes);

        $this->assertEquals('category changed', $response->json()['data']['name']);
    }

    /** @test */
    public function a_user_can_delete_a_category()
    {
        $this->signIn();

        $category = factory('App\Category')->create([
            'name' => 'Category 1',
        ]);

        $this->deleteJson("categories/$category->id")->assertStatus(204);

        $this->assertDatabaseMissing('categories', $category->only('id'));
    }
}
