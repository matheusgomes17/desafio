<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Users;

use Anik\Form\FormRequest;

class ProfileRequest extends FormRequest
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
        $id = $this->segment(4);

        return [
            'email' => "required|string|email|max:255|unique:users,email,{$id},id",
            'password' => 'required|string|min:6',
        ];
    }
}
