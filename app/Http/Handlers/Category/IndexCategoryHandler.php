<?php

namespace App\Http\Handlers\Category;

use App\Http\Resources\CategoryResource;
use App\Blog\Repositories\Category\CategoryInterface;

class IndexCategoryHandler
{
    protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function __invoke()
    {
        return CategoryResource::collection($this->category->all());
    }
}
