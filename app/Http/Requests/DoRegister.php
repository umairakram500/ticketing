<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoRegister extends FormRequest
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

            'name' => 'required|alpha|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'sometimes|required|min:6|alpha_num',
            'repass' => 'sometimes|required|same:password',
            'phone' => 'required|size:11|regex:/(03)[0-9+]{2}-[0-9+]{7}/',
            'cnic' => 'nullable|size:15|regex:^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$',

        ];
    }

    public function attributes()
    {
        return [

            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'repass' => 'Repeat Password',

        ];
    }
}
