<?php

namespace App\Blog\Repositories\Category;

abstract class AbstractCategoryDecorator implements CategoryInterface
{
    protected $nextCategory;

    public function __construct(CategoryInterface $nextCategory)
    {
        $this->nextCategory = $nextCategory;
    }

    public function all()
    {
        return $this->nextCategory->all();
    }

    public function create(array $data)
    {
        return $this->nextCategory->create($data);
    }

    public function show($record)
    {
        return $this->nextCategory->show($record);
    }

    public function update(array $data, $record)
    {
        return $this->nextCategory->update($data, $record);
    }

    public function delete($record)
    {
        return $this->nextCategory->delete($record);
    }
}
