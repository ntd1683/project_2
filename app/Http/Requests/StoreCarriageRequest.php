<?php

namespace App\Http\Requests;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarriageRequest extends FormRequest
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
            'license_plate' => [
                'required',
                'unique:carriages',
                'regex:/^[0-9]{1,2}-[A-Z0-9]{1,2}-[0-9]{4,5}$/',
            ],
            'category' => [
                'required',
                Rule::in(CarriageCategoryEnum::asArray()),
            ],
            'seat_type' => [
                'required',
                Rule::in(SeatTypeEnum::asArray()),
            ],
            'default_number_seat' => [
                'required',
                'integer',
                'min:10',
                'max:100',
            ],
            'route_from' => [
                'required',
                'integer',
            ],
            'route_to' => [
                'required',
                'integer',
            ],
            'driver' => [
                'required',
                'integer',
            ],
            'price' => [
                'required',
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return [
            'license_plate.regex' => 'Biển số xe không hợp lệ',
            'license_plate.unique' => 'Biển số xe đã tồn tại',
            'default_number_seat.min' => 'Số lượng ghế tối thiểu 10',
            'default_number_seat.max' => 'Số lượng ghế tối đa 100',
        ];
    }
}
