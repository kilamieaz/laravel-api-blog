<?php

namespace App\Http\Handlers\Category;

use App\Category;
use App\Blog\Repositories\Category\CategoryInterface;

class DestroyCategoryHandler
{
    protected $repo;

    public function __construct(CategoryInterface $category)
    {
        $this->repo = $category;
    }

    public function __invoke(Category $category)
    {
        $this->repo->delete($category);
        return response()->json(['message' => 'successfully remove category'], 204);
    }
}
