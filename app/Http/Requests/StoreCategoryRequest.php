<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Blog\Repositories\Category\CategoryInterface;

class StoreCategoryRequest extends FormRequest
{
    protected $repo;

    public function __construct(CategoryInterface $category)
    {
        $this->repo = $category;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'parent_id' => 'integer|number'
        ];
    }

    public function process()
    {
        $category = $this->repo->create($this->validated());
        return $category->fresh();
    }
}
