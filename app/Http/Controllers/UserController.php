<?php

namespace App\Http\Controllers;

use App\Enums\UserLevelEnum;
use App\Events\UserCreateEvent;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Bill;
use App\Models\Carriage;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new User())->query();
        $this->table = (new User())->getTable();
        // Làm sidebar - để biết mình đag ở tab nào
        $current_path = Route::getFacadeRoot()->current()->uri();
        $current_path_1 = Str::after($current_path, 'admin/');
        $route = Str::before($current_path_1, '/');
        //        dd($route);
        $levels_us = UserLevelEnum::asArray();
        $levels = [];
        foreach ($levels_us as $value) {
            $level = UserLevelEnum::getKeyByValue($value);
            $levels[$level] = $value;
        }
        //        dd($levels);
        View::share([
            'title' => ucwords($this->table),
            'levels' => $levels,
            'route' => $route,
        ]);
    }

    public function index()
    {
        $level_user = Auth::user()->level;
        $user = UserLevelEnum::getKeyByValue($level_user);
        $customer_counters = Customer::query()->count();
        $driver_counters = $this->model->where('level','0')->count();
        $car_counters = Carriage::query()->count();
        $price = Bill::query()->sum('price');
        // @todo Nhớ chạy lệnh nha Composer dump-autoload
        $revenue = number_shorten($price);
        $title ='Chào ' . $user .', chúc bạn một ngày tốt lành !!!';
        // chỉ riêng trang này ko có title
        return view('admin.index',[
            'breadcumbs'=>null,
            'title'=>NULL,
            'title_index' =>$title,
            'customer_counters'=>$customer_counters,
            'driver_counters'=>$driver_counters,
            'car_counters'=>$car_counters,
            'revenue'=>$revenue,
        ]);
    }

    public function api()
    {
        return DataTables::of($this->model)
            ->editColumn('gender', function ($object) {
                return $object->gender_name;
            })
            ->editColumn('birthdate', function ($object) {
                return $object->date_VN;
            })
            ->editColumn('address', function ($object) {
                return $object->provinces;
            })
            ->editColumn('level', function ($object) {
                return UserLevelEnum::getKeyByValue($object->level);
            })
            ->editColumn('name', function ($object) {
                return [
                    'name' => $object->name,
                    'src'  => $object->src_image_level,
                ];
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.users.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.users.edit', $object);
            })
            ->filterColumn('level', function ($query, $keyword) {
                if ($keyword !== '-1') {
                    $query->where('level', $keyword);
                }
            })
            ->filterColumn('name', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->where('name', $keyword);
                }
            })
            ->make(true);
    }

    public function apiNameUsers(Request $request)
    {
        return $this->model->where('name', 'like', '%' . $request->get('q') . '%')->get();
    }
    public function apiNameDrivers(Request $request)
    {
        if ($request->get('route_id') != null && $request->get('car_id') == null) {
            return $this->model->join('route_driver_cars', 'route_driver_cars.driver_id', '=', 'users.id')
                ->where('route_driver_cars.route_id', $request->get('route_id'))
                ->where('users.name', 'like', '%' . $request->get('q') . '%')
                ->where('users.level', UserLevelEnum::DRIVER)
                ->get();
        } else if ($request->get('route_id') != null && $request->get('car_id') != null) {
            return $this->model->join('route_driver_cars', 'route_driver_cars.driver_id', '=', 'users.id')
                ->where('route_driver_cars.route_id', $request->get('route_id'))
                ->where('route_driver_cars.car_id', $request->get('car_id'))
                ->where('users.name', 'like', '%' . $request->get('q') . '%')
                ->where('users.level', UserLevelEnum::DRIVER)
                ->get();
        }
        return $this->model->where('name', 'like', '%' . $request->get('q') . '%')->where('level', UserLevelEnum::DRIVER)->get();
    }

    public function apiProvinces(Request $request)
    {
        return $this->model->where('address', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function show_users()
    {
        $breadcumbs = Breadcrumbs::render('user');
        return view('admin.staff.users', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function create()
    {
        $breadcumbs = Breadcrumbs::render('create_user');
        return view('admin.staff.create', [
            'breadcumbs' => $breadcumbs,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $district = $request->get('district');
            $province = $request->get('province');
            $address = $request->get('address');
            $address1 = $address . ',' . $district . ',' . $province;
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
            return redirect()->route('admin.users.show_users')->with('success', 'Bạn thêm thành công !!!');
        } catch (Throwable $e) {
            //            dd();
            return redirect()->route('admin.users.create')->with('error', 'Bạn thêm thất bại rồi, vui lòng thử lại sau !!!');
        }
    }

    //    profile
    public function show()
    {
        $id = Auth::id();
        $user = $this->model->find($id);
        $src = $user->src_image_level;
        $address_user = explode(',', $user->address);
        $breadcumbs = Breadcrumbs::render('show_user');
        return view('admin.profile', [
            'user' => $user,
            'breadcumbs' => $breadcumbs,
            'address_user' => $address_user,
            'src' => $src,
        ]);
    }

    public function edit(User $user)
    // @todo Cài breadcumbs nha ô : composer require diglactic/laravel-breadcrumbs
    {
        $breadcumbs = Breadcrumbs::render('edit_user', $user);
        $address_user = explode(',', $user->address);
        return view('admin.staff.edit', [
            'user' => $user,
            'address_user' => $address_user,
            'breadcumbs' => $breadcumbs,
        ]);
    }

    //    profile
    public function updateProfile(UpdateProfileRequest $request, $user)
    {
        try {
            $district = $request->get('district');
            $province = $request->get('province');
            $address = $request->get('address');
            $address1 = $address . ',' . $district . ',' . $province;
            $arr = $request->only([
                "name",
                "phone",
                "gender",
                "birthdate",
                "email",
            ]);
            $arr['address'] = $address1;
            $object = $this->model->find($user);
            $object->fill($arr);
            $object->save();
            return redirect()->route('admin.profile')->with('success', 'Bạn sửa thành công !!!');
        } catch (Throwable $e) {
            return redirect()->route('admin.users.create')->with('error', 'Bạn sửa thất bại rồi,vui lòng thử lại sau !!!');
        }
    }
    //    profile
    public function changePassword(Request $request)
    {
        $id = Auth::id();
        $user = $this->model->find($id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Mật khẩu cũ không được bỏ trống',
            'new_password.required' => 'Mật khẩu cũ không được bỏ trống',
            'confirm_password.required' => 'Mật khẩu mới nhập không được bỏ trống',
            'confirm_password.same' => 'Mật khẩu nhập không giống nhau',
        ]);
        $password_old = $request->get('old_password');
        if (Hash::check($password_old, $user->password)) {
            $password_new = Hash::make($request->get('new_password'));
            User::where(['id' => $id])->update([
                'password' => $password_new,
            ]);
            return redirect()->route('admin.profile')->with('success', 'Đổi mật khẩu thành công !!!');
        }
        return redirect()->route('admin.profile')->with('error', 'Đổi mật khẩu thất bại !!!');
    }

    public function update(UpdateUserRequest $request, $user)
    {
        try {
            $district = $request->get('district');
            $province = $request->get('province');
            $address = $request->get('address');
            $address1 = $address . ',' . $district . ',' . $province;
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
            $object = $this->model->find($user);
            $object->fill($arr);
            $object->save();
            return redirect()->route('admin.users.show_users')->with('success', 'Bạn sửa thành công !!!');
        } catch (Throwable $e) {
            return redirect()->route('admin.users.create')->with('error', 'Bạn sửa thất bại rồi,vui lòng thử lại sau !!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $arr = [];
        $arr['status'] = true;
        $arr['messages'] = '';
        $user_get = $this->model->where('id', $user)->firstOrFail();
        if ($user_get->level == 2) {
            $arr['status'] = false;
        } else {
            User::destroy($user);
        }
        return response($arr, 200);
    }
}
