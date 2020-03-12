<?php

namespace App\Http\Handlers\Category;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;

class IndexCategoryHandler
{
    protected $category = null;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function __invoke(Request $request)
    {
        return CategoryResource::collection($this->category->all());
    }
}
