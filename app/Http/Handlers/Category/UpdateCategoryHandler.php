<?php

namespace App\Http\Handlers\Category;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\UpdateCategoryRequest;

class UpdateCategoryHandler
{
    public function __invoke(UpdateCategoryRequest $formRequest, Category $category)
    {
        return new CategoryResource($formRequest->process());
    }
}
