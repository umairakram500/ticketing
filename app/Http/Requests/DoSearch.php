<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoSearch extends FormRequest
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
            'depts' => 'required',
            'arrive' => 'required',
            //'g-recaptcha-response' => 'required|captcha'

        ];
    }

    public function messages()
    {
        return [
            'depts' => 'please select :attribute',
            'arrive' => 'please select :attribute',
            //'g-recaptcha-response' => 'please solve captcha',
        ];
    }

    public function attributes()
    {
        return [
            'depts' => 'Departure From',
            'arrive' => 'Arrival Destination',
            //'g-recaptcha-response' => ' Captcha'

        ];
    }
}
