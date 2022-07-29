<?php

namespace App\Http\Controllers\Applicant;

use App\Enums\CarriageCategoryEnum;
use App\Enums\SeatTypeEnum;
use App\Events\UserCreateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfoCustomerRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Buses;
use App\Models\Location;
use App\Models\Route;
use App\Models\Route_driver_car;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    public function index()
    {
        $routes = Route::query()->with('city_start')->with('city_end')
            ->selectRaw("routes.*,sum(route_driver_cars.pin) as pin")
            ->leftJoin('route_driver_cars','routes.id','=','route_driver_cars.route_id')
            ->groupBy("id")
            ->orderBy("pin","desc")
        ->get()
        ->map(function ($each) {
            $each->city_start_name = $each->city_start->pluck('name')[0];
            $each->city_end_name = $each->city_end->pluck('name')[0];
            $each->img = "upload/" . $each->images;
            if(isset($each->pin)){
                $price = Route_driver_car::query()
                    ->selectRaw("route_id,MIN(price) as price")
                    ->where('route_id','=',$each->id)
                    ->groupBy('route_id')
                    ->pluck('price')
                    ->toArray();
                $each->price = number_shorten($price[0]);
            }else{
                $each->price = null;
            }
            unset($each->city_start);
            unset($each->city_end);
            unset($each->images);
            return $each;
        });
        $i = 0;
        foreach ($routes as $each){
            $arr['city_start'][$each->city_start_id] = $each->city_start_name;
            $arr['city_end'][$each->city_end_id] = $each->city_end_name;
            if($each->pin == 0||$each->pin===null){
                unset($routes[$i]);
            }
            $i ++;
        }

        $array['city_start'] = array_unique($arr['city_start']);
        $array['city_end'] = array_unique($arr['city_end']);
        return view('index',[
            'city_start' => $array['city_start'],
            'city_end' => $array['city_end'],
            'routes' => $routes,
        ]);
    }

    public function book_ticket(Request $request)
    {
        $arr_bus =[];
        $arr_route =[];
        $array =[];
        $arr_routes = [];
        $arr_location = [];
        if(!isset($request->city_start)||!isset($request->city_end)||!isset($request->departure_time)||$request->city_start==-1||$request->city_end ==-1){
            $request->step = 1;
            //        step 1
            $routes = Route::query()->with('city_start')->with('city_end')
                ->selectRaw("routes.*,sum(route_driver_cars.pin) as pin")
                ->leftJoin('route_driver_cars','routes.id','=','route_driver_cars.route_id')
                ->groupBy("id")
                ->orderBy("pin","desc")
                ->get()
                ->map(function ($each) {
                    $each->city_start_name = $each->city_start->pluck('name')[0];
                    $each->city_end_name = $each->city_end->pluck('name')[0];
                    $each->img = "upload/" . $each->images;
                    if(isset($each->pin)){
                        $price = Route_driver_car::query()
                            ->selectRaw("route_id,MIN(price) as price")
                            ->where('route_id','=',$each->id)
                            ->groupBy('route_id')
                            ->pluck('price')
                            ->toArray();
                        $each->price = number_shorten($price[0]);
                    }else{
                        $each->price = null;
                    }
                    unset($each->city_start);
                    unset($each->city_end);
                    unset($each->images);
                    return $each;
                });
            $i = 0;
            foreach ($routes as $each){
                $arr['city_start'][$each->city_start_id] = $each->city_start_name;
                $arr['city_end'][$each->city_end_id] = $each->city_end_name;
                if($each->pin == 0||$each->pin===null){
                    unset($routes[$i]);
                }
                $i ++;
            }

            for($i =0 ; $i<=2;$i++){
                $arr_routes[$i] = $routes[$i];
            }

            $array['city_start'] = array_unique($arr['city_start']);
            $array['city_end'] = array_unique($arr['city_end']);
        }else if($request->step == 2){
//        step2
            $request->step = 2;
            $city_start = (int)$request->city_start;
            $city_end = (int)$request->city_end;
            $departure_time = $request->departure_time;
            $departure_time = date("Y-m-d", strtotime($departure_time));
            try{
                $route_id = Route::query()->where('city_start_id',$city_start)->where('city_end_id',$city_end)->pluck('id')[0];
//            dd($route_id);
                $arr_route = Route::query()->where('id',$route_id)->get()->toArray()[0];
//            dd($arr_route['name']);
                $arr_bus = Buses::query()->join('route_driver_cars', 'route_driver_cars.id', '=', 'buses.route_driver_car_id')
                    ->join('routes', 'routes.id', '=', 'route_driver_cars.route_id')
                    ->join('carriages', 'carriages.id', '=', 'route_driver_cars.car_id')
                    ->whereDate('departure_time','=',$departure_time)
                    ->where('routes.city_start_id','=',$city_start)
                    ->where('routes.city_end_id','=',$city_end)
                    ->get()->map(function($each){
                        $each->category_car = CarriageCategoryEnum::getKeyByValue(($each->category));
                        $each->seat_type_car = SeatTypeEnum::getKeyByValue(($each->seat_type));
                        $each->number_seat = $each ->default_number_seat;
                        $each->license_plate_car = $each ->license_plate;
                        $each->route_name = $each ->name;
                        unset($each->category, $each->seat_type,$each->deleted_at,$each -> pin,$each ->default_number_seat,$each ->license_plate,$each->name);
                        return $each;
                    });
                $select_locations = Location::query()->where('city_id',$city_start)->get()->toArray();
//            dd($select_locations);
                foreach($select_locations as $each){
                    if($each['name'] == null){
                        $arr_location[$each['id']] ='';
                    }else{
                        $arr_location[$each['id']] = $each['name'] . ' - ';
                    }
                    $arr_location[$each['id']] .= $each['address'].' - '.$each['district'];
                }
            }
            catch(\Throwable $e){
                $request->step = 1;
                $routes = Route::query()->with('city_start')->with('city_end')
                    ->selectRaw("routes.*,sum(route_driver_cars.pin) as pin")
                    ->leftJoin('route_driver_cars','routes.id','=','route_driver_cars.route_id')
                    ->groupBy("id")
                    ->orderBy("pin","desc")
                    ->get()
                    ->map(function ($each) {
                        $each->city_start_name = $each->city_start->pluck('name')[0];
                        $each->city_end_name = $each->city_end->pluck('name')[0];
                        $each->img = "upload/" . $each->images;
                        if(isset($each->pin)){
                            $price = Route_driver_car::query()
                                ->selectRaw("route_id,MIN(price) as price")
                                ->where('route_id','=',$each->id)
                                ->groupBy('route_id')
                                ->pluck('price')
                                ->toArray();
                            $each->price = number_shorten($price[0]);
                        }else{
                            $each->price = null;
                        }
                        unset($each->city_start);
                        unset($each->city_end);
                        unset($each->images);
                        return $each;
                    });
                $i = 0;
                foreach ($routes as $each){
                    $arr['city_start'][$each->city_start_id] = $each->city_start_name;
                    $arr['city_end'][$each->city_end_id] = $each->city_end_name;
                    if($each->pin == 0||$each->pin===null){
                        unset($routes[$i]);
                    }
                    $i ++;
                }

                for($i =0 ; $i<=2;$i++){
                    $arr_routes[$i] = $routes[$i];
                }

                $array['city_start'] = array_unique($arr['city_start']);
                $array['city_end'] = array_unique($arr['city_end']);
                $request->session()->flash('error', 'Không tim thấy tuyến xe hoặc nhà xe không có chuyến');
            }

        }
        $array = New Fluent($array);
        return view('applicant/book_ticket',[
            'city_start' => $array['city_start'],
            'city_end' => $array['city_end'],
            'request'=>$request,
            'routes'=>$arr_routes,
            'arr_bus'=>$arr_bus,
            'arr_route'=>$arr_route,
            'arr_location'=>$arr_location,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store_info_customer(StoreInfoCustomerRequest $request)
    {
//        bill
        $arr_bill = $request->only([
            "price",
            "payment_method",
            "birthdate",
            "email",
            "password",
            "level"
        ]);
        dd($request);
        try{
            $district = $request->get('district');
            $province = $request->get('city');
            $address = $request->get('city');
            $address1 = $address .','. $district. ',' . $province;
            $arr = $request->only([
                "name",
                "phone",
                "gender",
                "birthdate",
                "email",
                "password",
                "level"
            ]);
            $arr['address'] = $address1;
            $arr['password'] = Hash::make('nhaxethuduc');
//            dd($arr);
            $this->model->create($arr);
            $user = (object) $arr;
            UserCreateEvent::dispatch($user);
            return redirect()->route('admin.users.show_users')->with('success','Bạn thêm thành công !!!');
        }
        catch(Throwable $e){
//            dd();
            return redirect()->route('admin.users.create')->with('error','Bạn thêm thất bại rồi, vui lòng thử lại sau !!!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
