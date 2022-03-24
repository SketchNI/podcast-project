<?php

namespace App\Http\Requests\Admin\Episode;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if(auth()->user()->can('admin.view') && auth()->user()->can('podcast.all.create')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'unique:episodes', 'max:255', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:Draft,Published,Archived,Removed'],
        ];
    }
}
