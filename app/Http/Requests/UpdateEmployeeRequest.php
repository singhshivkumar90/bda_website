<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:employees,email,'.$this->route('employee'),
            'companyId' => 'required|integer|exists:companies,id',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.CheckFieldForUpdate'  => 'The :attribute is already taken by another employee.',
        ];
    }
}
