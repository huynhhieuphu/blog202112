<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
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
            'name' => 'required|max:100|unique:categories',
            'parent_id' => 'required',
            'is_active' => 'required|in:0,1'
        ];
    }

    // public function messages()
    // {
        
    // }

    public function attributes()
    {
        return [
            'parent_id' => 'category',
            'is_active' => 'status'
        ];
    }
}
