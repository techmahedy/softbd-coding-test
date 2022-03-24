<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'title' => 'required|unique:books',
            'author_id' => 'required|numeric',
            'publisher_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'short_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'pdf' => 'required|mimes:pdf'
        ];
    }
}
