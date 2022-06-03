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

class UserController extends Controller
{

    private object $model;
    private string $table;

    public function __construct(){
        $this->model = User::query();
        $this->table = (New User())->getTable();
        $route = Str::afterLast(Route::getFacadeRoot()->current()->uri(), '/');
        View::share([
            'title'=> ucwords($this->table),
            'route'=>$route,
        ]);
    }

    public function index()
    {
        $level_user = Auth::user()->level;
        $user = UserLevelEnum::getKeyByValue($level_user);
        $title ='Chào ' . $user .', chúc bạn một ngày tốt lành !!!';
        return view('admin.index',[
            'title' =>$title,
        ]);
    }

    public function show_user()
    {
        $data = $this->model->paginate(15);
        return view('admin.user',[
            'data' => $data,
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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
