<?php

namespace App\Http\Requests\Admin;

use App\Http\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // dd($request->category->id);
        return [
            'name' => 'required|max:100|unique:categories,name,' . $request->category->id,
            'parent_id' => 'required',
            'is_active' => 'required|in:0,1'
        ];
    }

    public function attributes()
    {
        return [
            'parent_id' => 'category',
            'is_active' => 'status'
        ];
    }
}
