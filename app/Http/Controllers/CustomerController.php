<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->model = (new Customer())->query();
        $this->table = (new Customer())->getTable();

        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');


        View::share([
            'title' => ucwords($this->table),
            'route' => $route,
        ]);
    }

    public function api()
    {
        $data = $this->model;
        return DataTables::of($data)
            ->editColumn('address', function ($object) {
                return $object->provinces;
            })
            ->addColumn('show', function ($object) {
                return route('admin.customers.show', $object);
            })
            ->make(true);
    }

    public function nameCustomers(Request $request)
    {
        return $this->model->where('name', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function emailCustomers(Request $request)
    {
        return $this->model->where('email', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function phoneCustomers(Request $request)
    {
        return $this->model->where('phone', 'like', '%' . $request->get('q') . '%')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcumbs = Breadcrumbs::render('customers');
        return view('admin.' . $this->table . '.index',[
            'breadcumbs' => $breadcumbs,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $breadcumbs = Breadcrumbs::render('show', $customer);
        return view('admin.' . $this->table . '.show',[
            'customer' => $customer,
            'breadcumbs' => $breadcumbs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
