<?php

namespace Tests\Unit;

use App\Category;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_has_many_subcategories()
    {
        $parent = new Category;

        $this->assertHasManyUsing(Category::class, $parent->subcategories(), 'parent_id');
    }
}
