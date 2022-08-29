<?php

namespace App\Http\Controllers;

use App\Enums\CarriageCategoryEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\SeatTypeEnum;
use App\Enums\StatusBillEnum;
use App\Models\Route;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{

    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Ticket())->query();
        $this->table = (new Ticket())->getTable();
        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');
        View::share([
            'title' => ucwords($this->table),
            'route' => $route,
        ]);
    }

    public function index()
    {
        $breadcumbs = Breadcrumbs::render('ticket');
        return view('admin.ticket.index', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function api()
    {
        $arr =  $this->model
            ->selectRaw('tickets.*,tickets.code as code_ticket,tickets.id as id_ticket,bill_details.*,bills.*,
            bills.code as code_bill,buses.departure_time,locations.*,routes.name as route_name,routes.time,cities.name as city_name_end')
            ->join('bill_details','bill_details.id','bill_detail_id')
            ->join('buses','buses.id','buses_id')
            ->join('bills','bills.id','bill_id')
            ->join('locations','locations.id','address_passenger_id')
            ->join('route_driver_cars','route_driver_cars.id','route_driver_car_id')
            ->join('routes','routes.id','route_id')
            ->join('cities','cities.id','city_end_id');
//        dd($arr);
        return DataTables::of($arr)
            ->editColumn('payment_method', function ($object) {
                return PaymentMethodEnum::getKeyByValue($object->payment_method);
            })
            ->editColumn('status', function ($object) {
                return StatusBillEnum::getKeyByValue($object->status);
            })
            ->editColumn('price', function ($object) {
                return number_shorten($object->price);
            })
            ->addColumn('show', function ($object) {
                return route('admin.tickets.show', $object->id_ticket);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.tickets.edit', $object);
            })
            ->make(true);
    }

    public function apiPhonePassenger(Request $request)
    {
        return $this->model->where('phone_passenger', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function apiCodeTickets(Request $request)
    {
        return $this->model->where('code', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function create()
    {
        $breadcumbs = Breadcrumbs::render('create_ticket');
        return view('admin.ticket.create', [
            'breadcumbs' => $breadcumbs,
        ]);
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

    public function show(Ticket $ticket)
    {
//        dd($ticket);
        $breadcumbs = Breadcrumbs::render('edit_ticket',$ticket);
//        if($ticket->isEmpty()){
//            return redirect()->back()->with('errors','Không tồn tại vé xe này');
//        }
        $ticket_tmp = Ticket::query()
            ->selectRaw('tickets.*,tickets.code as code_ticket,bill_details.*,bills.*,
            bills.code as code_bill,buses.departure_time,locations.*,
            routes.name as route_name,routes.time,
            users.name as user_name,users.phone as user_phone,
            carriages.license_plate as license_plate,
            cities.name as city_name_end')
            ->join('bill_details','bill_details.id','bill_detail_id')
            ->join('buses','buses.id','buses_id')
            ->join('bills','bills.id','bill_id')
            ->join('locations','locations.id','address_passenger_id')
            ->join('route_driver_cars','route_driver_cars.id','route_driver_car_id')
            ->join('users','route_driver_cars.driver_id','users.id')
            ->join('carriages','route_driver_cars.car_id','carriages.id')
            ->join('routes','routes.id','route_id')
            ->join('cities','cities.id','city_end_id')
            ->where('tickets.id',$ticket->id)->first();
        $ticket_tmp->location = $ticket_tmp->name.', '?? '';
        $ticket_tmp->location .= $ticket_tmp->address .', '.$ticket_tmp->district;
        $departure_time = \DateTime::createFromFormat('Y-m-d H:i:s', $ticket_tmp->departure_time);
        $departure_time = $departure_time->format('H:i:s d-m-Y');
        $ticket_tmp->departure_time = $departure_time;
        $ticket_tmp->price = number_shorten($ticket_tmp->price);
        $ticket_tmp->payment_method = PaymentMethodEnum::getKeyByValue($ticket_tmp->payment_method);
//        dd($ticket_tmp);
        $level = Auth::user()->level;
        return view('admin.ticket.show',[
            'breadcumbs'=>$breadcumbs,
            'ticket'=>$ticket_tmp,
            'level'=>$level
        ]);
    }

    public function edit(Ticket $ticket)
    {
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
