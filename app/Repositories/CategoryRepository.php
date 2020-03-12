<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends Model
{
    use Repository;

    /**
     * The model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    protected $table = 'categories';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = app(Category::class);
    }
}
