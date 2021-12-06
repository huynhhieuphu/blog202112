<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|max:100|unique:posts',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'content' => 'required',
            'published' => 'required|boolean'
        ];
    }
}
