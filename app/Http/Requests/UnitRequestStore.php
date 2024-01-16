<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnitRequestStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'initial' => 'required|unique:units|string|max:3',
            'name' => 'required|string|max:30',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response([
            'status' => 'failed',
            'error' => $validator->getMessageBag()
        ], 400));
    }
}
