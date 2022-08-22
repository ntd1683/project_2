<?php

namespace App\Http\Requests;

use App\Enums\UserLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingTicketRequest extends FormRequest
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
            'code_ticket'=>[
                'required',
                'exists:App\Models\Ticket,code'
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn đang bỏ trống ô nào đó',
            'phone.exists' =>'Chúng tôi kiểm tra các vé không thấy số này tồn tại',
            'code_ticket.exists' =>'Chúng tôi kiểm tra các vé không thấy mã vé này tồn tại',
        ];
    }
}
