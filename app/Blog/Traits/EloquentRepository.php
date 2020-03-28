<?php

namespace App\Blog\Traits;

trait EloquentRepository
{
    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // show the record with the given id
    public function show($record)
    {
        return $record;
    }

    // update record in the database
    public function update(array $data, $record)
    {
        return tap($record->fresh())->update($data);
    }

    // remove record from the database
    public function delete($record)
    {
        // return $this->model->destroy($id);
        return $record->delete();
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
