<?php

namespace Tests\Feature;

use App\Category;
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

        factory(Category::class)->create([
            'name' => 'Category 1',
        ]);
        $response = $this->getJson(route('categories.index'))->assertStatus(200);

        $this->assertEquals('Category 1', $response->json()['data'][0]['name']);
    }

    /** @test */
    public function a_user_can_create_a_category()
    {
        $this->signIn();

        $data = factory(Category::class)->raw();

        $this->postJson(route('categories.store'), $data)
        ->assertStatus(201)
        ->assertJsonStructure(['data' => ['id', 'name', 'parent_id', 'deleted_at', 'created_at', 'updated_at']]);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function a_user_can_update_a_category()
    {
        $this->signIn();

        $attributes = ['name' => 'category changed'];

        $category = factory(Category::class)->create();

        $response = $this->putJson(route('categories.update', $category->id), $attributes)
        ->assertStatus(200)
        ->assertJsonStructure(['data' => ['id', 'name', 'parent_id', 'deleted_at', 'created_at', 'updated_at']]);

        $this->assertDatabaseHas('categories', $attributes);

        $this->assertEquals('category changed', $response->json()['data']['name']);
    }

    /** @test */
    public function a_user_can_delete_a_category()
    {
        $this->signIn();

        $category = factory(Category::class)->create([
            'name' => 'Category 1',
        ]);

        $this->deleteJson(route('categories.destroy', $category->id))->assertStatus(204);

        $category->refresh();

        $this->assertDatabaseHas('categories', $category->only('deleted_at'));
    }
}
