<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
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
            's_name' => 'required|string|max:191',
            's_cnic' => 'required',
            's_phone' => 'required',
            's_email' => 'email|nullable',
            's_address' => 'nullable|string|max:191',

            'r_name' => 'required|alpha|max:191',
            'r_cnic' => 'required',
            'r_phone' => 'required',
            'r_email' => 'email|nullable',
            'r_address' => 'nullable|string|max:191',
            'r_city' => 'required|integer|exists:cities,id',
            'r_terminal' => 'required|integer|exists:terminals,id',

            'weight' => 'required|numeric',
            'qty' => 'required|integer',
            'charges' => 'required|numeric',

            'items' => 'array',
            'items.*.category' => 'required|integer|exists:cargo_categories,id',
            'items.*.goods_type' => 'required|integer|exists:cargo_categories,id',
            'items.*.packing' => 'required|integer|exists:cargo_categories,id',
            'items.*.qty' => 'required|integer',
            'items.*.weight' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            's_name' => 'Sender Name',
            's_email' => 'Sender Email',
            's_phone' => 'Sender Phone',
            's_cnic' => 'Sender CNIC',
            's_address' => 'Sender Address',

            'r_name' => 'Receiver Name',
            'r_email' => 'Receiver Email',
            'r_phone' => 'Receiver Phone',
            'r_cnic' => 'Receiver CNIC',
            'r_address' => 'Receiver Address',
            'r_city' => 'Receiver City',
            'r_terminal' => 'Receiver Terminal',

            'weight' => 'Total Weight',
            'qty' => 'Total QTY',
            'charges' => 'Charges'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }


}
