<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusesRequest extends FormRequest
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
            'route' => 'required',
            'car' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'route.required' => 'Bạn chưa chọn tuyến xe',
            'car.required' => 'Bạn chưa chọn xe',
            'date.required' => 'Bạn chưa chọn ngày',
            'time.required' => 'Bạn chưa chọn giờ',
            'price.required' => 'Bạn chưa nhập giá',
        ];
    }
}
