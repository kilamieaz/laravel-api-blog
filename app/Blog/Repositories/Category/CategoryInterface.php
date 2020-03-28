<?php

namespace App\Blog\Repositories\Category;

interface CategoryInterface
{
    public function all();

    public function create(array $data);

    public function show($record);

    public function update(array $data, $record);

    public function delete($record);
}
