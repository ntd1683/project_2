<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuickDestroyBusesRequest extends FormRequest
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
            'year' => 'required',
            'week_start' => 'required',
            'week_end' => 'required',
            'route_from' => 'required',
            'route_to' => 'required',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
