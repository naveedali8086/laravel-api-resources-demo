<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // for simplicity just returning true, otherwise proper authorization logic should be handled here
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
            'title' => 'required|string|max:255', /* making sure that data length do not exceed DB column's limit */
            'isbn' => 'required|string|max:10|digits_between:0,10|unique:books,isbn,' . $this->route('id'),
            'description' => 'required|string',
            'authors' => 'required|array',
        ];

    }
}
