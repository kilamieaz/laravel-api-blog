<?php

namespace App\Http\Handlers\Category;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Blog\Repositories\Category\CategoryInterface;

class IndexCategoryHandler
{
    protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function __invoke(Request $request)
    {
        return CategoryResource::collection($this->category->all());
    }
}
