<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Blog\Repositories\Category\CategoryInterface;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'string|min:3',
        ];
    }

    public function category()
    {
        //route model binding
        return $this->route('category');
    }

    public function process()
    {
        return $this->repo->update($this->validated(), $this->category());
    }
}
