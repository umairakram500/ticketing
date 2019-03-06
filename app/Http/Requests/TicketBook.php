<?php

namespace App\Http\Requests;

use App\Models\Staff\Staff;
use Illuminate\Foundation\Http\FormRequest;

class TicketBook extends FormRequest
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
            'p_phone' => 'required',
            'p_name' => 'required|alpha_space|max:191',
            'p_cnic' => 'required',
            'total_seats' => 'required|integer|min:1',
            'remarks' => 'string|nullable',
            'from_stop' => 'required|integer',
            'to_stop' => 'required|integer',
            'route_id' => 'required'
            //'seat' => 'array|required'
        ];
    }

    public function messages()
    {
        return [
            'total_seats' => 'Select at least one seat',
        ];
    }



}
