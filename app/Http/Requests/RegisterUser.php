<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterUser extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',

            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'birthplace' => 'nullable',
            'born_on' => 'nullable',
            'gender' => 'nullable',
            'gender_preference' => 'nullable',
            'country' => 'nullable',
            'phone_number' => 'nullable',
            'matrimonial_status' => 'nullable',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'Validation error',
            'errorList' => $validator->errors()
        ]));
    }

    public function messages(){
        return [
            'name.required' => 'A name must be provided',
            'email.required' => 'A email must be provided',
            'email.unique' => 'This email already exists',
            'password.required' => 'A password must be provided',
        ];
    }
}
