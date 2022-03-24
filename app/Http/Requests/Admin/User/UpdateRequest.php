<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (auth()->user()->can('user.all.update')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string[]", 'display_name' => "array", 'email' => "array", 'bio' => "string[]", 'twitter' => "string[]", 'goodreads' => "string[]", 'discord' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'display_name' => ['required', Rule::unique('users')->ignore($this->user()->id), 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'bio' => ['string', 'max:500', 'nullable'],
            'twitter' => ['string', 'max:32', 'nullable'],
            'goodreads' => ['string', 'max:256', 'nullable'],
            'discord' => ['string', 'max:12', 'nullable'],
        ];
    }
}
