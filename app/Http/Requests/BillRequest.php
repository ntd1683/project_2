<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'phone'=>[
                'required',
                'exists:App\Models\Ticket,phone_passenger'
            ],
            'code_bill'=>[
                'required',
                'exists:App\Models\Bill,code'
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn đang bỏ trống ô nào đó',
            'phone.exists' =>'Chúng tôi kiểm tra các vé không thấy số này tồn tại',
            'code_bill.exists' =>'Chúng tôi kiểm tra hoá đơn không thấy mã hoá đơn này tồn tại',
        ];
    }
}
