<?php

namespace App\Blog\Repositories\Category;

use App\Category;
use App\Blog\Traits\EloquentRepository;

class EloquentCategory implements CategoryInterface
{
    use EloquentRepository;

    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
