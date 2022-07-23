<?php

namespace App\Http\Requests;

use App\Enums\UserLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInfoCustomerRequest extends FormRequest
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
            'name'=>[
                'string',
                'required',
            ],
            'gender'=>[
                'required',
            ],
            'phone'=>[
                'required',
            ],
            'email' =>[
                'email',
                'required',
            ],
            'birthdate'=>[
                'required',
            ],
            'address' =>[
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn đang bỏ trống ô nào đó',
            'email.unique' =>'Email bị trùng',
        ];
    }
}
