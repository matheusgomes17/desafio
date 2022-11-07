<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Cars;

use Anik\Form\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
