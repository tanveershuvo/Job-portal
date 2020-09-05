<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class RegisterEmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*' => 'bail',
            'email' => ['required', 'string', 'max:150', 'unique:users'],
            'password' => ['required', 'string', 'min:8', new StrongPassword, 'confirmed'],
            'company_name' => ['required', 'string', 'max:50', 'unique:recruiter_details'],
            'category' => ['required'],
            'division' => ['required'],
            'district' => ['required'],
            'address' => ['required', 'string', 'max:200'],
            'trade_license' => ['required', 'string', 'max:50'],
            'rl_no' => ['max:50'],
            'description' => ['required', 'string', 'max:250'],
            'website_url' => ['max:250'],
            'contact_name' => ['required', 'string', 'max:80'],
            'phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
        ];
    }


    public function attributes()
    {
        return [
            'company_name' => 'Company name',
            'trade_license' => 'Trade license',
            'phone' => 'Contact number',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Please select a Category',
            'division.required' => 'Please select a Division',
            'district.required' => 'Please select a District',
        ];
    }
}
