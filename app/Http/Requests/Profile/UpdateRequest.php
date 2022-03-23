<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
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
        if(auth()->user()->can('user.self.bio.update')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['bio' => "string[]", 'twitter' => "string[]", 'goodreads' => "string[]", 'discord' => "string[]"])]
    public function rules(): array
    {
        return [
            'bio' => ['string', 'max:500', 'nullable'],
            'twitter' => ['string', 'max:32', 'nullable'],
            'goodreads' => ['string', 'max:256', 'nullable'],
            'discord' => ['string', 'max:12', 'nullable'],
        ];
    }
}
