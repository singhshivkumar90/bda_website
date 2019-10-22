<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComapanyRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:companies,email,'.$this->route('company'),
            'website' => 'required|unique:companies',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=100,height=100'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.CheckFieldForUpdate'  => 'The :attribute is already taken by another company.',
        ];
    }
}
