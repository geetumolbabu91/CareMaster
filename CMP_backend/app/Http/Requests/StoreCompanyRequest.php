<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:50',
            'email_address'         => 'required|email|unique:companies',
            'website_address'       => 'required|url',
            'logo'                  =>'required|dimensions:min_width=100,min_height=100'

        ];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ]));

    }

    public function messages(){
        
        return [
            'name.required'     => 'Company Name is required',
            'email.required'    => 'Email is required',
            'logo.dimensions'   => 'Minimum dimension of 100x100 is required for logo'
        ];
    }
}
