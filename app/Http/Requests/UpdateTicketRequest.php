<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'name_passenger'=>[
                'required',
            ],
            'phone_passenger'=>[
                'required',
            ],
            'email_passenger'=>[
                'required',
            ],
            'price'=>[
                'required',
            ],
            'location'=>[
                'required',
            ],
            'payment_method'=>[
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn đang bỏ trống ô nào đó',
        ];
    }
}
