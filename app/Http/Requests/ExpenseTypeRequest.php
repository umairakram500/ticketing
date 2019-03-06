<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseTypeRequest extends FormRequest
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
            'title' => 'required|max:255|unique:buses,title',
            'status' => 'boolean',
            'amount' => 'integer|nullable',
            'night_diff' => 'boolean|nullable',
            'terminal_deduct' => 'boolean',
            'changeable' => 'boolean',
            'nightfrom' => 'required_with:night_diff|nullable|date_format:h:i a',
            'nightto' => 'required_with:night_diff|nullable|date_format:h:i a|after:nightfrom',
            'nightamount' => 'required_with:night_diff|integer|nullable'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'status' => 'Status',
            'amount' => 'Amount',
            'night_diff' => 'Different Night Deduction',
            'terminal_deduct' => 'Terminal Deduction',
            'changeable' => 'Changeable',
            'nightfrom' => 'Trim From',
            'nightto' => 'Time to',
            'nightamount' => 'Night Deduction Amount'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }


}
