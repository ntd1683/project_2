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
            'to' => 'required',
            'from' => 'required',
            'driver' => 'required',
            'car' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'to.required' => 'Bạn chưa chọn điểm đi',
            'from.required' => 'Bạn chưa chọn điểm đến',
            'driver.required' => 'Bạn chưa chọn tài xế',
            'car.required' => 'Bạn chưa chọn xe',
            'date.required' => 'Bạn chưa chọn ngày',
            'time.required' => 'Bạn chưa chọn giờ',
            'price.required' => 'Bạn chưa nhập giá',
        ];
    }
}
