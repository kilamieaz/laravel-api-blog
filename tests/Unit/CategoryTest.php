<?php

namespace Tests\Unit;

use App\Category;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test  */
    public function categories_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('categories', [
                'id', 'name', 'parent_id', 'created_at', 'updated_at', 'deleted_at'
            ]),
            1
        );
    }

    /** @test */
    public function it_has_many_subcategories()
    {
        $parent = new Category;

        $this->assertHasManyUsing(Category::class, $parent->subcategories(), 'parent_id');
    }

    /** @test */
    public function category_with_a_parent_id_are_null()
    {
        $categoryA = factory(Category::class)->create();
        $categoryB = factory(Category::class)->create();
        $subcategory = factory(Category::class)->create([
            'parent_id' => $categoryA->id
        ]);

        $onlyParentCategory = Category::parentCategory()->get();

        $this->assertCount(2, $onlyParentCategory);
        $this->assertTrue($onlyParentCategory->contains($categoryA));
        $this->assertTrue($onlyParentCategory->contains($categoryB));
        $this->assertFalse($onlyParentCategory->contains($subcategory));
    }
}
