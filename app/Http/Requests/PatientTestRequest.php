<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PatientTestRequest extends Request
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
            'name'          => 'required',
            'date_of_birth' => 'required',
            'email'         => 'required|max:255|unique:patients,email',
            'phone_number'  => 'required|min:11',
        ];
    }
}
