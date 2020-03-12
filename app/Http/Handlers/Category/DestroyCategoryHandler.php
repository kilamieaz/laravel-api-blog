<?php

namespace App\Http\Handlers\Category;

use App\Category;
use Illuminate\Http\Request;

class DestroyCategoryHandler
{
    public function __invoke(Request $request, Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'successfully remove category'], 204);
    }
}
