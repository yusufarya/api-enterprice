<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnitRequestUpdate extends FormRequest
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
        $id_unit = $this->route('id_unit');
        $data = Unit::find($id_unit);
        if(!$data) {
            throw new HttpResponseException(response([
                'status' => 'failed',
                'error' => 'Data not found.'
            ], 404));
        }
        // dd($data->initial);
        return [
            'initial' => [
                'required',
                'max:3',
                Rule::unique('units')->ignore($data->initial, 'initial'),
            ],
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
