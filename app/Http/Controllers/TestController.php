<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {

    }

    public function test()
    {
        session()->flash('error123','1234');
        return redirect()->route('test1');
    }
    public function test1()
    {
        dd(session()->get('error123'));
    }

    public function get_test(Request $request){
    }
}
