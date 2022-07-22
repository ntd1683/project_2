<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CityController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new City())->query();
        $this->table = (new City())->getTable();
    }

    public function check($cityName): JsonResponse
    {
        $check = $this->model
            ->where('name', $cityName)
            ->exists();

        return $this->successResponse($check);
    }

    public function apiCity(Request $request)
    {
        $city_id = $request->get('city_id');
        if ($city_id == null) {
            return $this->model->where('name', 'like', '%' . $request->get('q') . '%')->get();
        }
        return $this->model->where('name', 'like', '%' . $request->get('q') . '%')->where('id', $request->get('city_id'))->get();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    'unique:App\Models\City,name'
                ]
            ]);
            $arr = $request->only('name');
            City::create($arr);
            //            dd($arr);
            //            $messages = $request->only('name');
            return $this->successResponse();
        } catch (Throwable $e) {
            $message = '';
            if ($e->getCode() === '23000') {
                $message = 'Lỗi không xác định vui lòng thử lại';
            }
            //            dd('arr');
            return $this->errorResponse($message);
        }
    }
}
