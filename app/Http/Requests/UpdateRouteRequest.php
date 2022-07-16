<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
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
            'city_start_id'=>[
                'required',
            ],
            'city_end_id'=>[
                'required',
            ],
            'time'=>[
                'numeric',
                'required',
            ],
            'distance' =>[
                'required',
                'numeric',
            ],
            'images'=>[
                'nullable',
                'file',
            ],
            'name'=>[
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn đang bỏ trống ô nào đó',
            'numeric' =>'Phải là chữ số',
            'unique'=>'Bị trùng rồi',
        ];
    }
}
