<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // siapapun bisa registrasi //
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['required', 'max:50'],
            'username' => ['required', 'max:20'],
            'phone' => ['required', 'numeric'],
            'gender' => ['required'],
            'role_id' => ['required'],
            'is_active' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response([
            'message' => 'failed',
            'error' => $validator->getMessageBag()
        ], 400));
    }
}
