<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'title' => 'required|string', // |unique:routes,title,'.$route->id
            'from_city_id' => 'required|integer|exists:cities,id',
            'to_city_id' => 'required|integer|different:from_city_id|exists:cities,id',
            'from_terminal_id' => 'required|integer|exists:terminals,id',
            'to_terminal_id' => 'required|integer|different:from_terminal_id|exists:terminals,id',
            'status' => 'boolean',
            //'hrs' => 'required|integer',
            //'mins' => 'required|integer',
            //'stations' => 'array|exists:cities,id',
            //'kms' => 'required|integer',
            'stops' => 'array|required',
            //'stops.*.title' => 'required|title',
            //'fares' => 'array',
            //'fares.*' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
