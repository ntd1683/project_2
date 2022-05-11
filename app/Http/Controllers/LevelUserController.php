<?php

namespace App\Http\Controllers;

use App\Models\Level_user;
use App\Http\Requests\StoreLevel_userRequest;
use App\Http\Requests\UpdateLevel_userRequest;

class LevelUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreLevel_userRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLevel_userRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level_user  $level_user
     * @return \Illuminate\Http\Response
     */
    public function show(Level_user $level_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level_user  $level_user
     * @return \Illuminate\Http\Response
     */
    public function edit(Level_user $level_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLevel_userRequest  $request
     * @param  \App\Models\Level_user  $level_user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLevel_userRequest $request, Level_user $level_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level_user  $level_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level_user $level_user)
    {
        //
    }
}
