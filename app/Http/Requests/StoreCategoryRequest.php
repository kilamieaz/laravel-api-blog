<?php

namespace App\Http\Requests;

use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    protected $category = null;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
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
        $category = $this->category->create($this->validated());
        return $category->first();
    }
}
