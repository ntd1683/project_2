<?php

namespace App\Http\Controllers;

use App\Enums\UserLevelEnum;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
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

    public function __construct(){
        $this->model = (new User())->query();
        $this->table = (New User())->getTable();
        $route = Str::afterLast(Route::getFacadeRoot()->current()->uri(), '/');
//        $route = '/';
//        dd(Str::afterLast(Route::getFacadeRoot()->current()->uri(), '/'));
        $levels_us = UserLevelEnum::asArray();
        $levels=[];
        foreach ($levels_us as $level=>$value) {
            $level = UserLevelEnum::getKeyByValue($value);
            $levels[$level]=$value;
        }
        View::share([
            'title'=> ucwords($this->table),
            'route'=>$route,
            'levels' => $levels,
        ]);
    }

    public function index()
    {
        $level_user = Auth::user()->level;
        $user = UserLevelEnum::getKeyByValue($level_user);
        $title ='Chào ' . $user .', chúc bạn một ngày tốt lành !!!';
        return view('admin.index',[
            'title' => NULL,
            'title_index' =>$title,
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
                return route('admin.users.edit',$object);
            })
            ->filterColumn('level', function($query, $keyword) {
                if($keyword !=='-1'){
                    $query->where('level',$keyword);
                }
            })
            ->filterColumn('name', function($query, $keyword) {
                if($keyword !=='null'){
                    $query->where('name',$keyword);
                }
            })
            ->make(true);
    }

    public function apiNameUsers(Request $request)
    {
        return $this->model->where('name','like','%'.$request->get('q') .'%')->get();
    }

    public function apiProvinces(Request $request)
    {
        return $this->model->where('address','like','%'.$request->get('q') .'%')->get();
    }

    public function show_users()
    {

        return view('admin.staff.users');
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(StoreUserRequest $request)
    {
        try{
            $district = $request->get('district');
            $province = $request->get('province');
            $address = $request->get('address');
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
//            dd($arr);
            $this->model->create($arr);
            return redirect()->route('admin.users.show_users')->with('success','Bạn thêm thành công !!!');
        }
        catch(Throwable $e){
//            dd();
            return redirect()->route('admin.users.create')->with('error','Bạn thêm thất bại rồi, vui lòng thử lại sau !!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\User $user)
    {
//        dd($user);
//        dd($user);
//        $user = $this->model->find($id);
        $address_user = explode(',', $user->address);
        return view('admin.staff.edit',[
            'user'=> $user,
            'address_user'=> $address_user,
        ]);
    }

    public function update(UpdateUserRequest $request,$user)
    {
        try{
            $district = $request->get('district');
            $province = $request->get('province');
            $address = $request->get('address');
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
            $object = $this->model->find($user);
            $object -> fill($arr);
            $object->save();
            return redirect()->route('admin.users.show_users')->with('success','Bạn sửa thành công !!!');
        }
        catch(Throwable $e){
            return redirect()->route('admin.users.create')->with('error','Bạn sửa thất bại rồi,vui lòng thử lại sau !!!');
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
        $arr=[];
        $arr['status'] = true;
        $arr['messages'] ='';
        $user_get = $this->model->where('id',$user)->firstOrFail();
        if($user_get->level == 2){
            $arr['status'] = false;
        }
        else{
            User::destroy($user);
        }
        return response($arr,200);
    }
}
