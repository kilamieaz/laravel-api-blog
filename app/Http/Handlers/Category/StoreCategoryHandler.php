<?php

namespace App\Http\Handlers\Category;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;

class StoreCategoryHandler
{
    public function __invoke(StoreCategoryRequest $formRequest)
    {
        return (new CategoryResource($formRequest->process()))->response()->setStatusCode(201);
    }
}
