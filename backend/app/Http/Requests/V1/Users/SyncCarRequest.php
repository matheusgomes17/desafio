<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Users;

use Anik\Form\FormRequest;

class SyncCarRequest extends FormRequest
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
            'cars' => 'required|array',
            'cars.*' => 'required|exists:cars,id',
        ];
    }
}
