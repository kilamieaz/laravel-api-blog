<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeParentCategory($query)
    {
        return $query->whereParentId(null);
    }
}
