<?php

namespace App\Blog\Repositories\Category;

use App\Blog\Traits\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class EloquentCategory implements CategoryInterface
{
    use EloquentRepository;

    protected $model;

    public function __construct(Model $category)
    {
        $this->model = $category;
    }
}
